<?php

namespace App\Http\Controllers;

use App\Models\ConvenienceStore;
use App\Models\ConvenienceStoreCategory;
use Illuminate\Http\Request;
use App\Http\Requests\ConvenienceStoreRequest;

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
}
