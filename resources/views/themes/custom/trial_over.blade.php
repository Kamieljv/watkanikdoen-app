@extends('theme::layouts.app')

@section('content')

    <div class="pt-20 mx-auto prose text-center max-w-6xl">
		<h2>Your trial has ended</h2>
		<p>Please <a href="{{ route('settings', 'plans') }}">Subscribe to a Plan</a> to continue using {{ setting('site.title') }}. Thanks!</p>
		<a href="{{ route('settings', 'plans') }}">View Plans</a>
	</div>

@endsection
