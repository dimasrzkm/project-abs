<div class="py-12" x-data="{
    open: false,
    openDelete: false
}">
    <!-- component Table -->
    <div class="overflow-x-auto">
        <div class="bg-gray-100 flex items-center justify-center font-sans">
            <div class="w-full max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <div class="flex justify-between items-center py-2">
                    <button
                        class="inline-flex items-center text-white bg-[#212121] hover:bg-[#515151]/90 border border-white focus:outline-none hover:bg-gray-100  font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                        type="button" @click="open = !open">
                        Tambah Product
                    </button>
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input type="text" id="table-search"
                            class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search for items">
                    </div>
                </div>

                <div class="bg-white shadow-md rounded my-6">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400">
                            <tr class="border-b border-b-gray-300">
                                <th scope="col" class="p-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-all" type="checkbox"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-all" class="sr-only">checkbox</label>
                                    </div>
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Name Stock
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Amount
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Quantity
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Price
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Date Buy
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Author
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="p-4 w-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-table-" type="checkbox"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-table-"
                                            class="sr-only">checkbox</label>
                                    </div>
                                </td>
                                <th scope="row"
                                    class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Daging Ayam
                                </th>
                                <td class="py-4 px-6">
                                    4
                                </td>
                                <td class="py-4 px-6">
                                    4
                                </td>
                                <td class="py-4 px-6">
                                   45.000
                                </td>
                                <td class="py-4 px-6">
                                    12 Nov 2022
                                </td>
                                <td class="py-4 px-6">
                                    Anan
                                </td>
                                <td class="py-4 px-6">
                                    <button type="button"
                                        class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Edit</button>
                                    <button type="button" @click="openDelete = true"
                                        class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div x-cloak x-show="open" @click.outside="open = false"
        class="flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center py-6 px-4 w-full md:inset-0 h-modal md:h-ful bg-gray-300 bg-opacity-40">
        <div class="relative w-full max-w-2xl h-full md:h-aut">
            <!-- Modal content -->
            <form class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Tambah Stocks
                    </h3>
                    <button type="button" @click="open = false"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="editUserModal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6 overflow-y-auto lg:h-auto h-[460px]">
                    <div class="flex justify-between">
                        <div>
                            <label for="name-product-"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Item</label>
                            <input type="text" id="name-product-"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Daging Ayam">
                        </div>
                        <div>
                            <label for="price-product-"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga
                                Product</label>
                            <input type="number" id="price-product-"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="10.000" required="">
                        </div>
                        <div>
                            <label for="total-belanja-"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah
                                Belanja</label>
                            <input type="number" id="total-belanja-" step="0.1"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="5" required>
                        </div>
                    </div>
                    <button type="button"
                        class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-1.5 mt-3 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Add
                        Stock</button>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                    <button type="submit" @click="open = false"
                        class="text-white bg-[#212121] hover:bg-[#515151]  font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah</button>
                </div>
            </form>
        </div>
    </div>

    {{-- modal delete --}}
    <div  x-cloak x-show="openDelete" @click.outside="openDelete = false"
        class="flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center py-6 px-4 w-full md:inset-0 h-modal md:h-ful bg-gray-300 bg-opacity-40">
        <div class="relative w-full max-w-2xl h-full md:h-auto flex justify-center items-center">
            <div class="md:w-2/3 sm:w-full rounded-lg shadow-lg bg-white my-3">
                <div class="flex justify-between border-b border-gray-100 px-5 py-4">
                    <div>
                        <div class="flex justify-center items-center gap-1">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="#D84315" d="M13 14H11V9H13M13 18H11V16H13M1 21H23L12 2L1 21Z" /></svg>
                            <i class="fa fa-exclamation-triangle text-orange-500"></i>
                            <span class="font-bold text-gray-700 text-lg">Warning</span>
                        </div>
                    </div>
                    <div>
                        <svg class="h-5 w-5 cursor-pointer" @click="openDelete = false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path fill="#D84315" d="M12,2C17.53,2 22,6.47 22,12C22,17.53 17.53,22 12,22C6.47,22 2,17.53 2,12C2,6.47 6.47,2 12,2M15.59,7L12,10.59L8.41,7L7,8.41L10.59,12L7,15.59L8.41,17L12,13.41L15.59,17L17,15.59L13.41,12L17,8.41L15.59,7Z" />
                         </svg>
                    </div>
                </div>

                <div class="px-10 py-5 text-gray-600">
                    Anda yakin ingin mengahapus data?
                </div>

                <div class="px-5 py-4 flex justify-end">
                    <button
                        class="bg-[#212121] mr-1 rounded text-sm py-2 px-3 text-white hover:bg-orange-600 transition duration-150" @click="openDelete = false">Cancel</button>
                    <button
                        class="text-sm py-2 px-3 text-gray-500 hover:text-gray-600 transition duration-150" @click="openDelete = false">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>
