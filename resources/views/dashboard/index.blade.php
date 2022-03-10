@extends('layouts.app')


@section('content')
	<div class="max-w-4xl mx-auto mt-10 px-5 lg:px-0 flex">
		<a href="{{ route('home') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
			<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
			{{ __("acties.back_to_acties") }}
		</a>
	</div>
	<div id="app" class="max-w-4xl mx-auto flex flex-col px-5 my-6 lg:px-0">
		{{-- Reports --}}
	    @include('dashboard.partials.reports')
		<div class="grid grid-cols-1 md:grid-cols-2">
			{{-- Notifications --}}
			<div class="col-span-1">
				<notifications
					id="notifications"
					:notifications="{{ $notifications }}"
					read-route="{{ route('notification.read', '') }}"
				/>
			</div>
			{{-- Something --}}
			<div class="col-span-1">
				{{-- something --}}
			</div>
	</div>

@endsection

@push('scripts')
    <script type="application/javascript">
        var app = new Vue({
            el: '#app',
        });
    </script>
@endpush
