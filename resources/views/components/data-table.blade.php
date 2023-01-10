<div class="relative overflow-x-auto sm:rounded-lg">
    <div class="w-full px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">

        @can('isAdmin')
            <button
                class="inline-flex items-center text-white bg-gray-800 hover:bg-gray-900 border border-white focus:outline-none font-semibold rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 mb-5"
                type="button" @click="open = !open">
                Tambah {{ $title }}
            </button>
        @endcan

        {{-- search and page --}}
        <div class="flex items-center justify-between mb-4">
            <div class="flex-1 pr-4">
                <div class="relative md:w-1/3">
                    <input type="search" wire:model.debounce.500ms="search"
                        class="w-full py-2 pl-10 pr-4 font-medium text-gray-600 border-none rounded-lg shadow focus:outline-none focus:shadow-outline focus:ring-slate-300 focus:ring-2 focus:ring-"
                        placeholder="Search..." />
                    <div class="absolute top-0 left-0 inline-flex items-center p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                            <circle cx="10" cy="10" r="7"></circle>
                            <line x1="21" y1="21" x2="15" y2="15"></line>
                        </svg>
                    </div>
                </div>
            </div>
            <!--end of element search -->
            <div class="flex rounded-lg shadow relative lg:static @isset($datePicker) gap-2 @endisset">
                {{-- datepicker --}}
                @isset($datePicker)
                    <div class="lg:relative">
                        <button @click.prevent="openDatePicker = !openDatePicker"
                            class="inline-flex items-center px-2 py-2 font-semibold text-gray-500 bg-white rounded-lg hover:text-blue-500 focus:outline-none focus:shadow-outline md:px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 md:hidden" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <rect x="0" y="0" width="24" height="24" stroke="none">
                                </rect>
                                <path d="M5.5 5h13a1 1 0 0 1 0.5 1.5L14 12L14 19L10 16L10 12L5 6.5a1 1 0 0 1 0.5 -1.5">
                                </path>
                            </svg>
                            <span class="hidden md:block">Export Excel</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-1" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <rect x="0" y="0" width="24" height="24" stroke="none">
                                </rect>
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                        <div x-show="openDatePicker" x-cloak
                            class="absolute top-0 right-0 z-40 block py-1 mt-12 -mr-1 overflow-hidden bg-white rounded-lg shadow-lg min-w-fit lg:min-w-max ">
                            {{ $datePicker }}
                        </div>
                        <!--end of popup page-->
                    </div>
                @endisset
                {{-- Display --}}
                <div class="relative">
                    <button @click.prevent="openPerPage = !openPerPage"
                        class="inline-flex items-center px-2 py-2 font-semibold text-gray-500 bg-white rounded-lg hover:text-blue-500 focus:outline-none focus:shadow-outline md:px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 md:hidden" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <rect x="0" y="0" width="24" height="24" stroke="none">
                            </rect>
                            <path d="M5.5 5h13a1 1 0 0 1 0.5 1.5L14 12L14 19L10 16L10 12L5 6.5a1 1 0 0 1 0.5 -1.5">
                            </path>
                        </svg>
                        <span class="hidden md:block">Display</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-1" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="0" y="0" width="24" height="24" stroke="none">
                            </rect>
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div x-show="openPerPage" x-cloak
                        class="absolute top-0 right-0 z-40 block w-40 py-1 mt-12 -mr-1 overflow-hidden bg-white rounded-lg shadow-lg ">
                        <label
                            class="flex items-center justify-start px-4 py-2 cursor-pointer text-truncate hover:bg-gray-100"
                            wire:click="showPage(5)">
                            <div class="text-gray-700 select-none">5</div>
                        </label>
                        <label
                            class="flex items-center justify-start px-4 py-2 cursor-pointer text-truncate hover:bg-gray-100"
                            wire:click="showPage(10)">
                            <div class="text-gray-700 select-none">10</div>
                        </label>
                        <label
                            class="flex items-center justify-start px-4 py-2 cursor-pointer text-truncate hover:bg-gray-100"
                            wire:click="showPage(25)">
                            <div class="text-gray-700 select-none">25</div>
                        </label>
                        <label
                            class="flex items-center justify-start px-4 py-2 cursor-pointer text-truncate hover:bg-gray-100"
                            wire:click="showPage(50)">
                            <div class="text-gray-700 select-none">50</div>
                        </label>
                    </div>
                    <!--end of popup page-->
                </div>
            </div>
            <!--end of element per page-->
        </div>

        {{-- table --}}
        <div class="relative overflow-x-auto overflow-y-auto bg-white border-b rounded-t-lg">
            <table class="relative w-full whitespace-no-wrap bg-white border-collapse table-auto table-striped">
                <thead>
                    <tr class="text-left">
                        <th class="sticky top-0 px-3 py-2 bg-gray-200 border-b border-gray-200">
                            <label
                                class="inline-flex items-center justify-between px-2 py-2 text-teal-500 rounded-lg cursor-pointer hover:bg-gray-200">
                                <input type="checkbox"
                                    class="form-checkbox focus:outline-none focus:shadow-outline" />
                            </label>
                        </th>
                        {{ $tbHead }}
                        @can('isAdmin')
                            <th
                                class="sticky top-0 px-6 py-2 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-200 border-b border-gray-200 firstName">
                                Action
                            </th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    {{ $tbBody }}
                </tbody>
            </table>
        </div>
        {{ $slot }}
    </div>
</div>
