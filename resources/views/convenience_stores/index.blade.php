@extends('layouts.common')

@section('title', 'Index')

@section('content')
    <div class="container">
        @if (!empty($stores))
            <ul>
                @foreach ($stores as $store)
                    <li class="list-unstyled border mb-5 pl-3 shadow">
                        @include('partial.store')
                    </li>
                @endforeach
            </ul>
            <div class="d-flex justify-content-center">
                {{ $stores->links() }}
            </div>
        @endif
    </div>
@endsection
