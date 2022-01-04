@extends('theme::layouts.app')

@section('content')
    <div class="row">
        <div id="colored-banner" class="h-[200px] bg-gradient-to-br from-[var(--wkid-red)] to-[var(--wkid-blue)] flex items-bottom pb-[50px] justify-center">
            
        </div>
    </div>
    <div id="app">
        <actie-agenda
            :routes="{{ $routes }}"
            :themes="{{ $themes }}"
        >
        </actie-agenda>
    </div>
@endsection

@push('scripts')
    <script type="application/javascript">      
        var app = new Vue({
            el: '#app',
        });
    </script>
@endpush