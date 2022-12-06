<div class="overflow-x-auto relative sm:rounded-lg">
    <div class="w-full max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

        <button
            class="inline-flex items-center text-white bg-gray-800 hover:bg-gray-900 border border-white focus:outline-none font-semibold rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 mb-5"
            type="button" @click="open = !open">
            Tambah {{ $title }}
        </button>

        {{-- search and page --}}
        <div class="mb-4 flex justify-between items-center">
            <div class="flex-1 pr-4">
                <div class="relative md:w-1/3">
                    <input type="search" wire:model.debounce.500ms="search"
                        class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium border-none focus:ring-slate-300 focus:ring-2 focus:ring-"
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
            <div class="shadow rounded-lg flex">
                <div class="relative">
                    <button @click.prevent="openPerPage = !openPerPage"
                        class="rounded-lg inline-flex items-center bg-white hover:text-blue-500 focus:outline-none focus:shadow-outline text-gray-500 font-semibold py-2 px-2 md:px-4">
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
                        class=" z-40 absolute top-0 right-0 w-40 bg-white rounded-lg shadow-lg mt-12 -mr-1 block py-1 overflow-hidden">
                        <label
                            class="flex justify-start items-center text-truncate hover:bg-gray-100 px-4 py-2 cursor-pointer"
                            wire:click="showPage(5)">
                            <div class="select-none text-gray-700">5</div>
                        </label>
                        <label
                            class="flex justify-start items-center text-truncate hover:bg-gray-100 px-4 py-2 cursor-pointer"
                            wire:click="showPage(10)">
                            <div class="select-none text-gray-700">10</div>
                        </label>
                        <label
                            class="flex justify-start items-center text-truncate hover:bg-gray-100 px-4 py-2 cursor-pointer"
                            wire:click="showPage(25)">
                            <div class="select-none text-gray-700">25</div>
                        </label>
                        <label
                            class="flex justify-start items-center text-truncate hover:bg-gray-100 px-4 py-2 cursor-pointer"
                            wire:click="showPage(50)">
                            <div class="select-none text-gray-700">50</div>
                        </label>
                    </div>
                    <!--end of popup page-->
                </div>
            </div>
            <!--end of element per page-->
        </div>

        {{-- table --}}
        <div class="overflow-x-auto bg-white rounded-t-lg overflow-y-auto relative border-b">
            <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                <thead>
                    <tr class="text-left">
                        <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-200">
                            <label
                                class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
                                <input type="checkbox" class="form-checkbox focus:outline-none focus:shadow-outline" />
                            </label>
                        </th>
                        {{ $tbHead }}
                        <th
                            class="bg-gray-200 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs firstName">
                            Action
                        </th>
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
