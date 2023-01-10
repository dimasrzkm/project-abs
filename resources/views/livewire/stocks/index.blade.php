<div class="py-12" x-data="{
    open: false,
    openDelete: false,
    openPerPage: false,
}">
    <!-- component Table -->
    <x-data-table>
        <x-slot:title>Stocks</x-slot>
            <x-slot:tbHead>
                <th wire:click="sortBy('name_stock')"
                    class="sticky top-0 px-6 py-2 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-200 border-b border-gray-200 cursor-pointer">
                    <div class="flex items-center">
                        Name
                        <x-partials.sort-icon field="name_stock" />
                    </div>
                </th>

                <th wire:click="sortBy('amount')"
                    class="sticky top-0 px-6 py-2 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-200 border-b border-gray-200 cursor-pointer">
                    <div class="flex items-center">
                        Amount
                        <x-partials.sort-icon field="amount" />
                    </div>
                </th>

                <th wire:click="sortBy('quantity')"
                    class="sticky top-0 px-6 py-2 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-200 border-b border-gray-200 cursor-pointer">
                    <div class="flex items-center">
                        Quantity
                        <x-partials.sort-icon field="quantity" />
                    </div>
                </th>

                <th wire:click="sortBy('price')"
                    class="sticky top-0 px-6 py-2 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-200 border-b border-gray-200 cursor-pointer">
                    <div class="flex items-center">
                        Price
                        <x-partials.sort-icon field="price" />
                    </div>
                </th>

                <th wire:click="sortBy('date_buy')"
                    class="sticky top-0 px-6 py-2 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-200 border-b border-gray-200 cursor-pointer">
                    <div class="flex items-center">
                        Date Buy
                        <x-partials.sort-icon field="date_buy" />
                    </div>
                </th>

                <th
                    class="sticky top-0 px-6 py-2 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-200 border-b border-gray-200 cursor-pointer">
                    Author
                </th>
                </x-slot>
                <x-slot:tbBody>
                    @forelse ($stocks as $index => $stock)
                        <tr>
                            <td class="px-3 border-t border-gray-200 border-dashed">
                                <label
                                    class="inline-flex items-center justify-between px-2 py-2 text-teal-500 rounded-lg cursor-pointer hover:bg-gray-200">
                                    <input type="checkbox" id="checkbox-table-{{ $stock['id'] }}"
                                        class="form-checkbox rowCheckbox focus:outline-none focus:shadow-outline"
                                        name="1" />
                                </label>
                            </td>
                            <td class="border-t border-gray-200 border-dashed">
                                @if ($editedStockIndex !== $index)
                                    <span class="flex items-center px-6 py-3 text-gray-700">
                                        {{ $stock['name_stock'] }}
                                    </span>
                                @else
                                    <input type="text" wire:model.defer="stocks.{{ $index }}.name_stock"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @endif
                            </td>
                            <td class="border-t border-gray-200 border-dashed firstName">
                                <span class="flex items-center px-6 py-3 text-gray-700">
                                    {{ $stock['amount'] }}
                                </span>
                            </td>
                            <td class="border-t border-gray-200 border-dashed">
                                @if ($editedStockIndex !== $index)
                                    <span class="flex items-center px-6 py-3 text-gray-700">
                                        {{ $stock['quantity'] }}
                                    </span>
                                @else
                                    <input type="number" wire:model.defer="stocks.{{ $index }}.quantity"
                                        step="0.1"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @endif
                            </td>
                            <td class="border-t border-gray-200 border-dashed">
                                @if ($editedStockIndex !== $index)
                                    <span class="flex items-center px-6 py-3 text-gray-700">
                                        Rp. {{ number_format($stock['price'], 0, ',', '.') }}
                                    </span>
                                @else
                                    <input type="text" wire:model.defer="stocks.{{ $index }}.price"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @endif
                            </td>
                            <td class="border-t border-gray-200 border-dashed">
                                @if ($editedStockIndex !== $index)
                                    <span class="flex items-center px-6 py-3 text-gray-700">
                                        {{ date('d / M /Y', strtotime($stock['date_buy'])) }}
                                    </span>
                                @else
                                    <input type="date" wire:model.defer="stocks.{{ $index }}.date_buy"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @endif
                            </td>
                            <td class="border-t border-gray-200 border-dashed">
                                <span class="flex items-center px-6 py-3 text-gray-700">
                                    {{ $stock['user']['name'] }}
                                </span>
                            </td>
                            @can('isAdmin')
                                <td class="border-t border-gray-200 border-dashed phoneNumber">
                                    <span class="flex items-center gap-2 px-6 py-3 text-gray-700">
                                        @if ($editedStockIndex !== $index)
                                            <button type="button"
                                                wire:click.prevent="getIdStock('edit', {{ $index }})"
                                                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Edit</button>
                                            <button type="button"
                                                wire:click.prevent="getIdStock('delete', {{ $index }})"
                                                @click="openDelete = true"
                                                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Delete</button>
                                        @else
                                            <button type="button" wire:click.prevent="actionModal('edit')"
                                                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Save</button>
                                            <button type="button" wire:click.prevent="actionCancel('edit')"
                                                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Cancel</button>
                                        @endif
                                    </span>
                                </td>
                            @endcan
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-3 border-t border-gray-200 border-dashed">
                                <span class="flex items-center justify-center px-6 py-3 text-gray-700">Data
                                    tidak
                                    ditemukan!</span>
                            </td>
                        </tr>
                    @endforelse
                    </x-slot>
                    {{-- links --}}
                    @if ($links->lastPage() > 1)
                        <div class="px-4 py-3 bg-white rounded-b-lg sm:px-6">
                            @if ($links->links())
                                {{ $links->links() }}
                            @endif
                        </div>
                    @endif
    </x-data-table>

    <x-modal-input>
        <x-slot:form>
            <form wire:submit.prevent="store" class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Tambah Stocks
                    </h3>
                    <button type="button" @click="open = false" wire:click="resetNewStock"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="editUserModal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6 overflow-y-auto lg:h-auto lg:max-h-[460px] h-[460px]">
                    @for ($i = 0; $i < count($storeStocks); $i++)
                        <div class="flex flex-col md:flex-row md:justify-between">
                            <div>
                                <label for="name-product-{{ $i }}"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Item</label>
                                <input type="text" id="name-product-{{ $i }}"
                                    wire:model.defer="storeStocks.{{ $i }}.name_stock"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Daging Ayam">
                                @if ($errors->has('storeStocks.' . $i . '.name_stock'))
                                    <span class="text-red-700 ">
                                        {{ $errors->first('storeStocks.' . $i . '.name_stock') }}
                                    </span>
                                @endif
                            </div>
                            <div>
                                <label for="price-product-{{ $i }}"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga
                                    Product</label>
                                <input type="number" id="price-product-{{ $i }}"
                                    wire:model.defer="storeStocks.{{ $i }}.price"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="10.000">
                                @if ($errors->has('storeStocks.' . $i . '.price'))
                                    <span class="text-red-700 ">
                                        {{ $errors->first('storeStocks.' . $i . '.price') }}
                                    </span>
                                @endif

                            </div>
                            <div>
                                <label for="total-belanja-{{ $i }}"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah
                                    Belanja</label>
                                <input type="number" id="total-belanja-{{ $i }}" step="0.1"
                                    wire:model.defer="storeStocks.{{ $i }}.quantity"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="5 kg">
                                @if ($errors->has('storeStocks.' . $i . '.quantity'))
                                    <span class="text-red-700 ">
                                        {{ $errors->first('storeStocks.' . $i . '.quantity') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endfor
                    <button type="button" wire:click="addNewStock"
                        class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-1.5 mt-3 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Add
                        Stock</button>
                </div>
                <!-- Modal footer -->
                <div
                    class="flex items-center justify-end p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit" @click="open = !open"
                        class="text-white bg-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Tambah</button>
                </div>
            </form>
            </x-slot>
    </x-modal-input>

    {{-- modal delete --}}
    <x-modal-delete>
        <x-slot:action>
            actionModal('delete')
            </x-slot>
    </x-modal-delete>
</div>
