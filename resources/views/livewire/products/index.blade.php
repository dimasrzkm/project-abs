@inject('carbon', 'Carbon\Carbon')
<div class="py-12" x-data="{
    open: false,
    openDelete: false,
    openPerPage: false,
}">
    <!-- component Table -->
    <x-data-table>
        <x-slot:title>Products</x-slot>
        <x-slot:tbHead>
            <th wire:click="sortBy('name_product')"
                class="bg-gray-200 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs cursor-pointer">
                <div class="flex items-center">
                    Product name
                    <x-partials.sort-icon field="name_product" />
                </div>
            </th>

            <th wire:click="sortBy('categorie_id')"
                class="bg-gray-200 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs cursor-pointer">
                <div class="flex items-center">
                    Category
                    <x-partials.sort-icon field="categorie_id" />
                </div>
            </th>

            <th wire:click="sortBy('price')"
                class="bg-gray-200 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs cursor-pointer">
                <div class="flex items-center">
                    Price
                    <x-partials.sort-icon field="price" />
                </div>
            </th>

            <th wire:click="sortBy('stock')"
                class="bg-gray-200 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs cursor-pointer">
                <div class="flex items-center">
                    Stocks
                    <x-partials.sort-icon field="stock" />
                </div>
            </th>
        </x-slot>
        <x-slot:tbBody>
            @forelse ($products as $index => $product)
                <tr>
                    <td class="border-dashed border-t border-gray-200 px-3">
                        <label
                            class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
                            <input type="checkbox" id="checkbox-table-{{ $product['id'] }}"
                                class="form-checkbox rowCheckbox focus:outline-none focus:shadow-outline"
                                name="1" />
                        </label>
                    </td>
                    <td class="border-dashed border-t border-gray-200">
                        <span
                            class="text-gray-700 px-6 py-3 flex items-center">{{ $product['name_product'] }}</span>
                    </td>
                    <td class="border-dashed border-t border-gray-200 firstName">
                        <span
                            class="text-gray-700 px-6 py-3 flex items-center">{{ $product['categorie']['categorie'] }}</span>
                    </td>
                    <td class="border-dashed border-t border-gray-200 firstName">
                        <span
                            class="text-gray-700 px-6 py-3 flex items-center">Rp. {{ number_format($product['price'], 0, ',', '.') }}</span>
                    </td>
                    <td class="border-dashed border-t border-gray-200 firstName">
                        <span
                            class="text-gray-700 px-6 py-3 flex items-center">{{ $product['stock'] }}</span>
                    </td>
                    <td class="border-dashed border-t border-gray-200 phoneNumber">
                        <span class="text-gray-700 px-6 py-3 flex gap-2 items-center">
                            <button type="button" @click="open = true"
                                wire:click.prevent="actionModal('edit', {{ $product['id'] }})"
                                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Edit</button>
                            <button type="button" {{-- wire:click.prevent="deleteProduct({{ $index }})" --}}
                                wire:click.prevent="actionModal('hapus', {{ $index }})"
                                @click="openDelete = true"
                                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Delete</button>
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="border-dashed border-t border-gray-200 px-3">
                        <span class="text-gray-700 px-6 py-3 flex items-center justify-center">Data
                            tidak
                            ditemukan!</span>
                    </td>
                </tr>
            @endforelse
        </x-slot>
        {{-- links --}}
        @if ($links->lastPage() > 1)
            <div class="bg-white px-4 py-3 sm:px-6 rounded-b-lg">
                @if ($links->links())
                    {{ $links->links() }}
                @endif
            </div>
        @endif
    </x-data-table>

    {{-- Modal --}}
    <x-modal-input>
        <x-slot:form>
            <form
                wire:submit.prevent="{{ $actionForm == 'tambah' || $actionForm == 'hapus' ? 'store' : 'updateProduct' }}"
                class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ $actionForm == 'tambah' || $actionForm == 'hapus' ? 'Tambah Product' : 'Update Product' }}
                    </h3>
                    <button type="button" @click="open = false" wire:click="resetAttributes"
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
                <div class="p-6 space-y-6 overflow-y-auto lg:h-auto lg:max-h-[460px] h-[460px]">
                    <div class="grid grid-cols-6 gap-6 ">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="name-product"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Product</label>
                            <input type="text" id="name-product" wire:model.defer="nameProduct"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Steak" autofocus>
                            {{-- @error('nameProduct')
                                <p>{{ $message }}</p>
                            @enderror --}}
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="price-product"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price
                                Product</label>
                            <input type="number" id="price-product" wire:model.defer="price"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="10.000" required="">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="small"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Category
                                Product</label>
                            <select id="small" wire:model.defer="idCategorie"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Choose a Category</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->categorie }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="stocks-product"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stocks</label>
                            <input type="number" id="stocks-product" wire:model.defer="stock"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="1" required="">
                        </div>
                        <div class="col-span-6 sm:col-span-">
                            <h2>Recipes</h2>
                        </div>
                        @for ($i = 0; $i < count($recipeStocks); $i++)
                            <div class="col-span-6 sm:col-span-3">
                                <select wire:model.defer="recipeStocks.{{ $i }}.stock_id"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Choose a ingridients</option>
                                    @foreach ($recipes as $recipe)
                                        <option value="{{ $recipe->id }}">{{ $recipe->name_stock }},
                                            {{ $recipe->amount }}
                                            {{ $carbon::parse($recipe->date_buy)->diffForHumans() }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <input type="number" wire:model.defer="recipeStocks.{{ $i }}.amount"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="1" required="" step="0.5">
                            </div>
                        @endfor
                        <div class="col-span-6 sm:-col-span-3">
                            <button type="button" wire:click="addNewRecipe"
                                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-1.5 mt-3 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Add
                                Ingridient</button>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div
                    class="flex items-center justify-end p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                    <button type="submit" @click="open = false"
                        class="text-white bg-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        {{ $actionForm == 'tambah' || $actionForm == 'hapus' ? 'Tambah' : 'Ubah' }}
                </div>
            </form>
        </x-slot>
    </x-modal-input>

    {{-- modal delete --}}
    <x-modal-delete>
        <x-slot:action>deleteProduct</x-slot>
    </x-modal-delete>
</div>
