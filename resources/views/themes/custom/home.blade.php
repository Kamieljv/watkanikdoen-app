@extends('theme::layouts.app')

@section('content')
    <div class="row">
        <div id="colored-banner" class="h-20 md:h-[200px] bg-gradient-to-br from-[var(--wkid-red)] to-[var(--wkid-blue)] flex items-bottom pb-[50px] justify-center">
            
        </div>
    </div>
    <div id="app" class="px-8 xl:px-5">
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