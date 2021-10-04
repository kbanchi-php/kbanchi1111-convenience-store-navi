<?php

namespace App\Http\Controllers;

use App\Models\ConvenienceStore;
use App\Models\ConvenienceStoreCategory;
use Illuminate\Http\Request;
use App\Http\Requests\ConvenienceStoreRequest;
use GuzzleHttp\Client;

class ConvenienceStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $query = ConvenienceStore::query();
        if (!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
            $query->orWhere('address', 'like', '%' . $keyword . '%');
            $query->orWhere('pr', 'like', '%' . $keyword . '%');
            $query->orWhereHas('convenience_store_category', function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
            });
        }
        // $stores = ConvenienceStore::all();
        // $stores = ConvenienceStore::paginate(5);
        $stores = $query->paginate(5);
        $stores->appends(compact('keyword'));
        $data = [
            'stores' => $stores,
        ];
        return view('convenience_stores.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $store = new ConvenienceStore();
        $store->latitude = 39.91402764039571;
        $store->longitude = 141.1007601246386;
        $zoom = 15;
        $categories = ConvenienceStoreCategory::all();
        $data = [
            'store' => $store,
            'zoom' => $zoom,
            'categories' => $categories,
        ];
        return view('convenience_stores.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConvenienceStoreRequest $request)
    {

        $store = new ConvenienceStore();

        if (!empty($request->file('image'))) {
            $path = $request->file('image')->store('images', 'public');
            $store->img_path = $path;
        }

        $store->name = $request->name;
        $store->convenience_store_category_id = $request->category;
        $store->address = $request->address;
        $store->pr = $request->pr;
        $store->toilet = $request->toilet;
        $store->parking = $request->parking;
        $store->latitude = $request->latitude;
        $store->longitude = $request->longitude;

        $store->save();

        return redirect()->route('convenience_stores.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ConvenienceStore  $convenienceStore
     * @return \Illuminate\Http\Response
     */
    public function show(ConvenienceStore $convenienceStore)
    {
        $zoom = 15;
        $data = [
            'store' => $convenienceStore,
            'zoom' => $zoom,
        ];
        return view('convenience_stores.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ConvenienceStore  $convenienceStore
     * @return \Illuminate\Http\Response
     */
    public function edit(ConvenienceStore $convenienceStore)
    {
        $categories = ConvenienceStoreCategory::all();
        $zoom = 15;
        $data = [
            'store' => $convenienceStore,
            'zoom' => $zoom,
            'categories' => $categories,
        ];
        return view('convenience_stores.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConvenienceStore  $convenienceStore
     * @return \Illuminate\Http\Response
     */
    public function update(ConvenienceStoreRequest $request, ConvenienceStore $convenienceStore)
    {

        if (!empty($request->file('image'))) {
            $path = $request->file('image')->store('images', 'public');
            $convenienceStore->img_path = $path;
        }

        $convenienceStore->name = $request->name;
        $convenienceStore->convenience_store_category_id = $request->category;
        $convenienceStore->address = $request->address;
        $convenienceStore->pr = $request->pr;
        $convenienceStore->toilet = $request->toilet;
        $convenienceStore->parking = $request->parking;
        $convenienceStore->latitude = $request->latitude;
        $convenienceStore->longitude = $request->longitude;

        $convenienceStore->save();

        return redirect()->route('convenience_stores.show', $convenienceStore);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConvenienceStore  $convenienceStore
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConvenienceStore $convenienceStore)
    {
        $convenienceStore->delete();
        return redirect()->route('convenience_stores.index');
    }

    public function nearest(Request $request)
    {
        // 現在地の緯度経度を取得
        $latitude1 = $request->cur_lat;
        $longitude1 = $request->cur_lng;

        // 緯度経度の距離を計算するためのAPI定義
        $method = 'GET';
        $base_url = 'http://vldb.gsi.go.jp/sokuchi/surveycalc/surveycalc/bl2st_calc.pl?outputType=json&ellipsoid=GRS80';
        $options = [];

        // 登録されているコンビニの数だけ、現在地との距離をAPIで取得
        $stores = ConvenienceStore::all();
        $distances = [];
        foreach ($stores as $store) {
            $client = new Client();
            $url = $base_url
                . '&latitude1=' . $latitude1
                . '&longitude1=' . $longitude1
                . '&latitude2=' . $store->latitude
                . '&longitude2=' . $store->longitude;
            try {
                $response = $client->request($method, $url, $options);
                $body = $response->getBody();
                $data = json_decode($body, false);
                $distances[] = [
                    'id' => $store->id,
                    'distance' => $data->OutputData->geoLength,
                ];
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                return back();
            }
            // APIが10秒間に10リクエストが制限のため、1リクエストごとに1秒sleep
            sleep(1);
        }

        // 最も距離が近いコンビニを取得
        $min = $distances[0];
        foreach ($distances as $distance) {
            if ($min["distance"] > $distance["distance"]) {
                $min = $distance;
            }
        }

        // 最も距離が近いコンビニの詳細画面を表示
        $store = ConvenienceStore::find($min["id"]);
        return redirect()->route('convenience_stores.show', $store);
    }
}
