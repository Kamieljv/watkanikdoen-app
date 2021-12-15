@extends('theme::layouts.app')

@section('header')
    @include('theme::partials.home-header')
@stop

@section('content')
    <div class="row">
        <div id="search-banner" class="h-[400px] bg-gradient-to-br from-wkid-pink to-wkid-blue flex items-center justify-center">
            <div id="search-container" class="h-[50px] w-[500px]">
                <div id="search-module" class="flex rounded-full h-full bg-white drop-shadow-lg hover:drop-shadow-xl">
                    <input type="text" name="query" class="h-full w-full p-0 mx-[22px] border-none focus:ring-0 focus:filter-none" placeholder="Zoeken..." />
                </div>
            </div>
        </div>
    </div>

    <div class="row px-8 mx-auto xl:px-5 max-w-6xl" id="app">
        <div class="col" style="width: 100%">
            <actie-agenda
                :routes="routes"
            ></actie-agenda>
        </div>
    </div>

    {{-- <div class="flex justify-center my-10">
        {{ $acties->links('theme::partials.pagination') }}
    </div> --}}
@endsection

@push('scripts')
    <script type="application/javascript">
        var app = new Vue({
            el: '#app',
            components: {},
            data: {
                routes: @json($routes)
            }
        });
    </script>
@endpush