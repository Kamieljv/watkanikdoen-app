@extends('layouts.app')

@section('content')

	<div class="grid grid-cols-4 gap-3 px-8 mx-auto mt-6 max-w-6xl xl:px-5 mb-40">

		<!-- Left Settings Menu -->
		<div class="w-full mr-6 col-span-4 md:col-span-1">

			<div class="relative grid grid-cols-2 items-center justify-center w-full py-1 md:py-0 bg-white border shadow-md rounded-lg border-gray-200">
				<h3 class="col-span-2 px-6 py-3 md:pb-3 text-xs font-semibold leading-4 tracking-wider text-gray-500 uppercase">{{ __("menus.account") }}</h3>

				<a href="{{ route('settings', 'profile') }}" class="block col-span-1 md:col-span-2 relative w-full flex items-center px-6 py-3 text-sm font-medium leading-5 @if(Request::is('auth/settings/profile')){{ 'text-gray-900 bg-gray-50' }}@else{{ 'text-gray-600' }}@endif transition duration-150 ease-in-out rounded-md group hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50">
					@svg('antdesign-user-o', ['style' => 'width: 20px; height: 20px;']) &nbsp;
					<span class="truncate">{{ __("Profile") }}</span>
					<span class="absolute left-0 block w-1 transition-all duration-300 ease-out rounded-full @if(Request::is('auth/settings/profile')){{ 'bg-blue-500 h-full top-0' }}@else{{ 'top-1/2 bg-gray-300 group-hover:top-0 h-0 group-hover:h-full' }}@endif "></span>
				</a>
				<a href="{{ route('settings', 'security') }}" class="block col-span-1 md:col-span-2 relative w-full flex items-center px-6 py-3 text-sm font-medium leading-5 @if(Request::is('auth/settings/security')){{ 'text-gray-900 bg-gray-50' }}@else{{ 'text-gray-600' }}@endif transition duration-150 ease-in-out rounded-md group hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50">
					@svg('antdesign-lock-o', ['style' => 'width: 20px; height: 20px;']) &nbsp;
					<span class="truncate">{{ __("menus.security") }}</span>
					<span class="absolute left-0 block w-1 transition-all duration-300 ease-out rounded-full @if(Request::is('auth/settings/security')){{ 'bg-blue-500 h-full top-0' }}@else{{ 'top-1/2 bg-gray-300 group-hover:top-0 h-0 group-hover:h-full' }}@endif "></span>
				</a>
			</div>

		</div>
		<!-- End Settings Menu -->

		<div class="flex flex-col w-full bg-white border shadow-md rounded-lg col-span-4 md:col-span-3 border-gray-200">
			<div class="flex flex-wrap items-center justify-between border-b border-gray-200 sm:flex-no-wrap">
	            <div class="relative p-6">
	                <h3 class="flex text-lg font-medium leading-6 text-gray-600">
						@if (Request::is('auth/settings/profile'))
							@svg('antdesign-user-o', ['style' => 'width: 20px; height: 20px;']) &nbsp;
						@elseif (Request::is('auth/settings/security'))
							@svg('antdesign-lock-o', ['style' => 'width: 20px; height: 20px;']) &nbsp;
						@endif
						{{ __("menus." . (str_replace('-', ' ', Request::segment(3)) ?? 'profile') . '_settings') }}
	                </h3>
	            </div>
	        </div>
			<div class="uk-card-body">
				@include('settings.partials.' . $section)
			</div>
		</div>
	</div>

@endsection
