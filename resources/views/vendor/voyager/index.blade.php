@extends('voyager::master')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-boat"></i>
        {{ __('voyager::generic.dashboard')}}
    </h1>
@stop

@section('content')

    <div class="page-content container-fluid">
        @include('voyager::alerts')

        <div id="app" class="stats-container">
            <stats-dashboard
                umami-username="{{config('umami.username')}}"
                umami-password="{{config('umami.password')}}"
                stats-url="{{config('umami.url')}}"
                platform-stats-route="{{route('dashboard.stats')}}"
            />
        </div>
    </div>
@stop

@push('javascript')
    <script type="application/javascript">
        var app = new Vue({
            el: '#app',
        });
    </script>
@endpush