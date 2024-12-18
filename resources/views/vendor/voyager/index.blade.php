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

        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <div class="flex border-0">
                        <h2>Quick links</h2>
                    </div>
                    <div class="flex border-0">
                        <a href="{{ route('voyager.acties.create') }}" class="quick-link">
                            <button class="btn btn-primary" style="margin-right: 5px">
                                <span style="font-size: 21px; font-weight: bold; line-height: 9px; margin-right: 2px;">+</span><i class="voyager-exclamation"></i>
                                <span>Actie toevoegen</span>
                            </button>
                        </a>
                        <a href="{{ route('voyager.organizers.create') }}" class="quick-link">
                            <button class="btn btn-primary" style="margin-right: 5px">
                                <span style="font-size: 21px; font-weight: bold; line-height: 9px; margin-right: 2px;">+</span><i class="voyager-pirate"></i>
                                <span>Organizer toevoegen</span>
                            </button>
                        </a>
                    </div>                    
                </div>
            </div>
        </div>

        <div id="app" class="stats-container">
            <stats-dashboard
                umami-username="{{config('umami.username')}}"
                umami-password="{{config('umami.password')}}"
                umami-url="{{config('umami.url')}}"
                umami-website-id="{{config('umami.websiteId')}}"
                platform-stats-route="{{route('dashboard.stats')}}"
            />
        </div>
    </div>
@stop