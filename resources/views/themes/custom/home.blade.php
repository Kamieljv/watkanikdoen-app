@extends('theme::layouts.app')

@section('header')
    @include('theme::partials.home-header')
@stop

@section('content')
    <div id="app">
        <div class="row">
            <div id="search-banner" class="h-[400px] bg-gradient-to-br from-wkid-pink to-wkid-blue flex items-center justify-center">
                <div id="search-container" class="h-[50px] w-[500px]">
                    <div id="search-wrapper" class="h-full w-full rounded-full bg-white px-[22px]">
                        <form-field
                            x-cloak
                            type="text"
                            placeholder="Zoeken..."
                            classes="h-full w-full p-0 border-none focus:ring-0 focus:filter-none"
                            @input="processInput"
                        />
                    </div>
                </div>
            </div>
        </div>

        <div class="row px-8 mx-auto xl:px-5 max-w-6xl" >
            <div class="col" style="width: 100%">
                <actie-agenda
                    :routes="routes"
                    :query="query"
                ></actie-agenda>
            </div>
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
                routes: @json($routes),
                query: '',
            },
            methods: {
                processInput: _.debounce(function(input) {
                    this.query = input;
                }, 500),
            }
        });
    </script>
@endpush