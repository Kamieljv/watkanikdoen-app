@extends('theme::layouts.app')

@section('header')
    @include('theme::partials.home-header')
@stop

@section('content')
    <div class="row">
        <div id="search-container" class="h-[500px] bg-gradient-to-br from-wkid-pink to-wkid-blue">
        </div>
    </div>

    {{-- <div class="flex justify-center my-10">
        {{ $acties->links('theme::partials.pagination') }}
    </div> --}}
@endsection