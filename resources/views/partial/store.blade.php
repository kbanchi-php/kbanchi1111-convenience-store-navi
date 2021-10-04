<div class="row">
    <div>
        <img src="{{ Storage::disk('public')->url($store->convenience_store_category->img_path) }}"
            class="square-img">
    </div>
    <div class="ml-3">
        <div class="mt-3 mb-3">
            <h3>
                <a href="{{ route('convenience_stores.show', $store) }}">{{ $store->name }}</a>
            </h3>
        </div>
        <div>
            <p>{{ $store->address }}</p>
        </div>
    </div>
</div>
