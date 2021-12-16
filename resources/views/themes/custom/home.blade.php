@extends('theme::layouts.app')

@section('header')
    @include('theme::partials.home-header')
@stop

@section('content')
    <div id="app">
        <actie-agenda
            :routes="{{ $routes }}"
        >
        </actie-agenda>
    </div>

    {{-- <div class="flex justify-center my-10">
        {{ $acties->links('theme::partials.pagination') }}
    </div> --}}
@endsection