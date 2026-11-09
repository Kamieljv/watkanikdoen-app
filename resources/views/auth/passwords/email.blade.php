@extends('layouts.app')

@section('content')
    <div id="app">
        <forgot-password
            :routes="{{ json_encode($routes) }}"
            csrf="{{ csrf_token() }}"
        />
    </div>
@endsection
