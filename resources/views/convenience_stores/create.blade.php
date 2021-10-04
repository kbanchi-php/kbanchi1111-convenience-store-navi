@extends('layouts.common')

@section('title', 'Create')

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
        <form action="{{ route('convenience_stores.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name" class="visually-hidden">店名</label>
                <input class="form-control" type="text" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label for="category" class="visually-hidden">カテゴリー</label>
                <select class="form-control" name="category" id="category" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if (old('category') == $category->id) selected  @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="address" class="visually-hidden">住所</label>
                <input class="form-control" type="text" name="address" value="{{ old('address') }}" required>
            </div>
            <div class="form-group">
                <label for="pr" class="visually-hidden">PRポイント</label>
                <input class="form-control" type="text" name="pr" value="{{ old('pr') }}">
            </div>
            <div class="form-group">
                <label for="image" class="visually-hidden">店舗画像</label>
                <input type="file" name="image" id="image" class="form-control" placeholder="Image"
                    onchange="previewImage(this);" value="{{ old('image') }}">
                <img id="preview" style="max-width:200px;">
            </div>
            <div class="form-group">
                <label for="pr" class="visually-hidden">トイレ有無</label>
                <select class="form-control" name="toilet" id="toilet" required>
                    <option value="1" @if (old('toilet', $store->toilet) == '1') selected @endif>あり</option>
                    <option value="0" @if (old('toilet', $store->toilet) == '0') selected @endif>なし</option>
                </select>
            </div>
            <div class="form-group">
                <label for="parking" class="visually-hidden">駐車場キャパシティ</label>
                <input class="form-control" type="number" name="parking" value="{{ old('parking') }}" required>
            </div>
            <div class="form-group">
                <label for="map" class="visually-hidden">地図マップ</label>
                <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">
                <div id="map" style="height: 70vh"></div>
            </div>
            <input type="submit" value="登録" class="btn btn-success">
            <a href="{{ route('convenience_stores.index') }}" class="btn btn-secondary">戻る</a>
        </form>
    </div>
@endsection

@section('script')
    @include('partial.map')
    <script>
        const lat = document.getElementById('latitude');
        const lng = document.getElementById('longitude');
        let clicked;
        map.on('click', function(e) {
            if (clicked !== true) {
                clicked = true;
                const marker = L.marker([e.latlng['lat'], e.latlng['lng']], {
                    draggable: true
                }).addTo(map);
                lat.value = e.latlng['lat'];
                lng.value = e.latlng['lng'];
                marker.on('dragend', function(e) {
                    // 座標は、e.target.getLatLng()で取得
                    lat.value = e.target.getLatLng()['lat'];
                    lng.value = e.target.getLatLng()['lng'];
                });
            }
        });
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
