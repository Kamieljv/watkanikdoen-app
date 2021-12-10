@section('content')
    <div class="row" id="app">
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

@section('scripts')
    <script type="application/javascript">
        var app = new Vue({
            el: '#app',
            components: {},
            data: {
                routes: @json($routes)
            }
        });
    </script>
@endsection
