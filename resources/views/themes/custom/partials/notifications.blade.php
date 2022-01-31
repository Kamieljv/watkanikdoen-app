@php $notifications_count = auth()->user()->unreadNotifications->count(); @endphp

@if(!isset($show_all_notifications))
    @php $unreadNotifications = auth()->user()->unreadNotifications->take(3); @endphp
    <div id="notification-list" @click.away="open = false" class="header-icon flex items-center h-full" x-data="{ open: false }">
        <div id="notification-icon relative">
            <button @click="open = !open" class="relative p-1 ml-3 text-gray-500 transition duration-150 ease-in-out rounded-full hover:text-gray-700 focus:outline-none focus:text-gray-700 focus:bg-gray-100">
                <svg class="w-7 h-7" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                @if($unreadNotifications && $notifications_count > 0) <span id="notification-count" class="absolute top-0 right-0 flex items-center justify-center w-4 h-4 text-xs font-extrabold text-red-100 bg-red-500 rounded-full">{{ $notifications_count }}</span> @endif
            </button>
        </div>
@else
    @php $unreadNotifications = auth()->user()->unreadNotifications->all(); @endphp
@endif

    @if(!isset($show_all_notifications))
        <div x-show="open"
            x-transition:enter="duration-100 ease-out scale-95"
            x-transition:enter-start="opacity-50 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition duration-50 ease-in scale-100"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute top-0 left-2 sm:left-auto right-2 sm:right-0 max-w-lg mt-[70px] sm:mt-[50px] overflow-hidden origin-top-right transform rounded-xl shadow-lg max-w-7xl w-104" x-cloak>
    @else
        <div class="relative top-0 right-0 w-full my-8 overflow-hidden origin-top max-w-7xl">
    @endif
        <div class="bg-white rounded-md border border-gray-100 @if(!isset($show_all_notifications)){{ 'shadow-md' }}@endif" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
        @if(!isset($show_all_notifications))
            <div id="notification-header" class="w-[370px]">
                <div id="notification-head-content" class="flex items-center w-full px-3 py-3 text-gray-600 border-b border-gray-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    {{ __("notifications.notifications") }}
                </div>
            </div>
        @endif

            <div id="notifications-none" class="@if($notifications_count > 0){{ 'hidden' }}@endif @if(isset($show_all_notifications)){{ 'bg-gray-150' }}@endif flex items-center justify-center h-24 w-full text-gray-600 font-medium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                {{ __("notifications.caught_up") }}
            </div>

            <div class="relative">


                @foreach ($unreadNotifications as $index => $notification)
                    @php $notification_data = (object)$notification->data; @endphp
                    <div id="notification-li-{{ $index + 1 }}" class="flex flex-col border-b border-gray-200 @if(!isset($show_all_notifications)){{ 'hover:bg-gray-50' }}@endif">
                        <div class="flex items-start p-5">
                            <div class="flex items-center justify-center text-xl w-10 h-10 rounded-full text-gray-400 bg-gray-100">
                                @svg(@$notification_data->icon, ['style' => 'stroke: currentColor; height: 26px;'])
                            </div>
                            <div class="flex flex-col items-start flex-1 w-0 ml-3">
                                <a href="{{ @$notification_data->link }}">
                                    <div class="text-sm leading-5 text-gray-700">
                                        <span class="text-[15px] font-bold">{{ @$notification_data->title }}</span><br/>
                                        <span class="font-medium">{{ @$notification_data->body }}</span>
                                    </div>
                                </a>
                                <div class="flex space-x-3 w-full items-center justify-left mt-2 text-sm font-medium leading-5 text-gray-500">
                                    <span class="notification-datetime">{{ Date::parse(@$notification->created_at)->diffForHumans() }}</span>
                                    <span>•</span>
                                    <span data-id="{{ $notification->id }}" data-listid="{{ $index+1 }}" class="flex justify-start text-xs text-gray-500 cursor-pointer hover:text-gray-700 mark-as-read hover:underline">
                                        <svg class="absolute w-4 h-4 mt-1 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        {{ __("general.mark_as_read") }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        @if(!isset($show_all_notifications))
            <div id="notification-footer" class="flex items-center justify-center py-3 text-xs font-medium text-gray-600 bg-gray-100 border-t border-gray-200 ">
                <a href="{{ route('dashboard') }}">
                    <span uk-icon="icon: eye"></span>
                    {{ __("View") }} 
                    {{ __("notifications.all") }}
                </a>
            </div>
        @endif

        </div>
    </div>

@if(!isset($show_all_notifications))
    </div><!-- End of #notification-list -->
@endif
