<div class="flex flex-col justify-start flex-1 mb-5 overflow-hidden bg-white border shadow-md rounded-lg border-gray-150">
    <div class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap">
        <div class="relative flex-1">
            <h3 class="text-lg font-medium leading-6 text-gray-900">
                {{ __("dashboard.my_reported_actions") }}
            </h3>
            <p class="text-sm leading-5 text-gray-500 mt-2">
                {{ __("dashboard.my_reported_actions_description") }}
            </p>
        </div>
        <div>
            <a href="{{ route('aanmelding.form') }}" class="inline-flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-blue-500 hover:bg-blue-600">
                Actie toevoegen
            </a>
        </div>
    </div>
    <div id="reports-none" class="@if(count($aanmeldingen) > 0){{'hidden'}}@endif flex items-center justify-center h-24 w-full text-gray-600 font-medium">
        @svg('clarity-add-text-line', ['class' => 'w-5 h-5 mr-3'])
        {{ __("dashboard.no_reports") }}
    </div>
    @if(count($aanmeldingen) > 0)
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="pt-2 md:py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __("aanmeldingen.title") }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __("aanmeldingen.organizer") }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __("aanmeldingen.date_reported") }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __("aanmeldingen.status") }}
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($aanmeldingen as $aanmelding)
                                    <tr>
                                        {{-- Title --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $aanmelding->title }}
                                        </td>
                                        {{-- Organizer --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{-- <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                Jane Cooper
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                jane.cooper@example.com
                                                </div>
                                            </div>
                                            </div> --}}
                                            Organizer
                                        </td>
                                        {{-- Date Reported --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ Date::parse($aanmelding->created_at)->diffForHumans() }}
                                        </td>
                                        {{-- Status --}}
                                        @php
                                            $statusColorMap = array(
                                                'PENDING' => 'bg-blue-100 text-[color:var(--wkid-blue-dark)]',
                                                'APPROVED' => 'bg-green-100 text-green-800',
                                                'REJECTED' => 'bg-red-100 text-red-800',
                                            )
                                        @endphp
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span 
                                                class="px-2 inline-flex text-xs lowercase leading-5 font-semibold rounded-full {{ $statusColorMap[$aanmelding->status] }}"
                                                style=""
                                            >
                                                {{ __("aanmeldingen." . strtolower($aanmelding->status)) }}
                                            </span>
                                        </td>
                                        {{-- Editing/Viewing --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('aanmelding.view', $aanmelding->id) }}" class="text-[color:var(--wkid-blue)] hover:text-[color:var(--wkid-blue-dark)]">{{ __("aanmeldingen.view") }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>