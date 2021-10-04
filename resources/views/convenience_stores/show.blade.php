@extends('layouts.common')

@section('title', 'Show')

@section('content')
    <div class="container">
        @include('partial.store')
        <table class="table-bordered mb-5 mt-3">
            <colgroup span="1" style="width:200px;background-color:#efefef;"></colgroup>
            <tbody>
                <tr>
                    <th>店名</th>
                    <td>{{ $store->name }}</td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td>{{ $store->address }}</td>
                </tr>
                <tr>
                    <th>カテゴリー</th>
                    <td>{{ $store->convenience_store_category->name }}</td>
                </tr>
                <tr>
                    <th>PRポイント</th>
                    <td>{{ $store->pr }}</td>
                </tr>
                <tr>
                    <th>トイレ有無</th>
                    <td>
                        @if ($store->toilet)
                            あり
                        @else
                            なし
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>駐車場キャパシティ</th>
                    <td>{{ $store->parking }}</td>
                </tr>
            </tbody>
        </table>
        @if (!empty($store->img_path))
            <div>
                <img src="{{ Storage::disk('public')->url($store->img_path) }}" class="square-img-lg">
            </div>
        @endif
        <div id="map" style="height: 70vh"></div>
        <div class="d-flex">
            <a href="{{ route('convenience_stores.edit', $store) }}" class="btn btn-primary mr-2">編集</a>
            <a href="{{ route('convenience_stores.index') }}" class="btn btn-secondary mr-2">戻る</a>
            <form action="{{ route('convenience_stores.destroy', $store) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="削除" class="btn btn-danger" onclick="if(!confirm('削除しますか？')){return false;}">
            </form>
        </div>
    </div>
@endsection

@section('script')
    @include('partial.map')
    <script>
        L.marker([{{ $store->latitude }}, {{ $store->longitude }}])
            .bindPopup("{{ $store->name }}", {
                closeButton: false
            })
            .addTo(map);
    </script>
@endsection
