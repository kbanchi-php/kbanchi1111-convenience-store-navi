@extends('layouts.common')

@section('title', 'Edit')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="error">
                <p>
                    <b>{{ count($errors) }}件のエラーがあります。</b>
                </p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('convenience_stores.update', $store) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="name" class="visually-hidden">店名</label>
                <input class="form-control" type="text" name="name" value="{{ old('name', $store->name) }}">
            </div>
            <div class="form-group">
                <label for="category" class="visually-hidden">カテゴリー</label>
                <select class="form-control" name="category" id="category">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if (old('category') == $category->id) selected  @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="address" class="visually-hidden">住所</label>
                <input class="form-control" type="text" name="address" value="{{ old('address', $store->address) }}">
            </div>
            <div class="form-group">
                <label for="pr" class="visually-hidden">PRポイント</label>
                <input class="form-control" type="text" name="pr" value="{{ old('pr', $store->pr) }}">
            </div>
            <div class="form-group">
                <label for="image" class="visually-hidden">店舗画像</label>
                <input type="file" name="image" id="image" class="form-control" placeholder="Image"
                    onchange="previewImage(this);"
                    value="{{ old('image', Storage::disk('public')->url($store->img_path)) }}">
                <img id="preview" style="max-width:200px;" src="@if (!empty($store->img_path))
                    {{ Storage::disk('public')->url($store->img_path) }}
                @endif">
            </div>
            <div class="form-group">
                <label for="toilet" class="visually-hidden">トイレ有無</label>
                <select class="form-control" name="toilet" id="toilet">
                    <option value="1" @if (old('toilet', $store->toilet) == '1') selected @endif>あり</option>
                    <option value="0" @if (old('toilet', $store->toilet) == '0') selected @endif>なし</option>
                </select>
            </div>
            <div class="form-group">
                <label for="parking" class="visually-hidden">駐車場キャパシティ</label>
                <input class="form-control" type="number" name="parking" value="{{ old('parking', $store->parking) }}">
            </div>
            <div class="form-group">
                <label for="map" class="visually-hidden">地図マップ</label>
                <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $store->latitude) }}">
                <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $store->longitude) }}">
                <div id="map" style="height: 70vh"></div>
            </div>
            <input type="submit" value="更新" class="btn btn-success">
            <a href="{{ route('convenience_stores.show', $store) }}" class="btn btn-secondary">戻る</a>
        </form>
    </div>
@endsection

@section('script')
    @include('partial.map')
    <script>
        const lat = document.getElementById('latitude');
        const lng = document.getElementById('longitude');
        @if (!empty($store))
            const marker = L.marker([{{ $store->latitude }}, {{ $store->longitude }}], {
            draggable: true
            }).bindPopup("{{ $store->name }}", {closeButton: false}).addTo(map);
            lat.value = {{ $store->latitude }};
            lng.value = {{ $store->longitude }};
            marker.on('dragend', function(e) {
            // 座標は、e.target.getLatLng()で取得
            lat.value = e.target.getLatLng()['lat'];
            lng.value = e.target.getLatLng()['lng'];
            });
        @endif
    </script>
    <script>
        function previewImage(obj) {
            var fileReader = new FileReader();
            fileReader.onload = (function() {
                document.getElementById('preview').src = fileReader.result;
            });
            fileReader.readAsDataURL(obj.files[0]);
        }
    </script>
@endsection
