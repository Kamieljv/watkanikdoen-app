@extends('theme::layouts.app')

@section('content')
    <div id="app">
        <actie-agenda
            :routes="{{ $routes }}"
            :categories="{{ $categories }}"
        >
        </actie-agenda>
    </div>

    {{-- <div class="flex justify-center my-10">
        {{ $acties->links('theme::partials.pagination') }}
    </div> --}}
@endsection

@push('scripts')
    <script type="application/javascript">      
        var app = new Vue({
            el: '#app',
        });
    </script>
@endpush