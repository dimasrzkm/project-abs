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
                    class="sticky top-0 px-6 py-2 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-200 border-b border-gray-200 cursor-pointer">
                    <div class="flex items-center">
                        Product name
                        <x-partials.sort-icon field="name_product" />
                    </div>
                </th>

                <th wire:click="sortBy('categorie_id')"
                    class="sticky top-0 px-6 py-2 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-200 border-b border-gray-200 cursor-pointer">
                    <div class="flex items-center">
                        Category
                        <x-partials.sort-icon field="categorie_id" />
                    </div>
                </th>

                <th wire:click="sortBy('price')"
                    class="sticky top-0 px-6 py-2 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-200 border-b border-gray-200 cursor-pointer">
                    <div class="flex items-center">
                        Price
                        <x-partials.sort-icon field="price" />
                    </div>
                </th>

                <th wire:click="sortBy('stock')"
                    class="sticky top-0 px-6 py-2 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-200 border-b border-gray-200 cursor-pointer">
                    <div class="flex items-center">
                        Stocks
                        <x-partials.sort-icon field="stock" />
                    </div>
                </th>
                </x-slot>
                <x-slot:tbBody>
                    @forelse ($products as $index => $product)
                        <tr>
                            <td class="px-3 border-t border-gray-200 border-dashed">
                                <label
                                    class="inline-flex items-center justify-between px-2 py-2 text-teal-500 rounded-lg cursor-pointer hover:bg-gray-200">
                                    <input type="checkbox" id="checkbox-table-{{ $product['id'] }}"
                                        class="form-checkbox rowCheckbox focus:outline-none focus:shadow-outline"
                                        name="1" />
                                </label>
                            </td>
                            <td class="border-t border-gray-200 border-dashed">
                                <span
                                    class="flex items-center px-6 py-3 text-gray-700">{{ $product['name_product'] }}</span>
                            </td>
                            <td class="border-t border-gray-200 border-dashed firstName">
                                <span
                                    class="flex items-center px-6 py-3 text-gray-700">{{ $product['categorie']['categorie'] }}</span>
                            </td>
                            <td class="border-t border-gray-200 border-dashed firstName">
                                <span class="flex items-center px-6 py-3 text-gray-700">Rp.
                                    {{ number_format($product['price'], 0, ',', '.') }}</span>
                            </td>
                            <td class="border-t border-gray-200 border-dashed firstName">
                                <span class="flex items-center px-6 py-3 text-gray-700">{{ $product['stock'] }}</span>
                            </td>
                            @can('isAdmin')
                                <td class="border-t border-gray-200 border-dashed phoneNumber">
                                    <span class="flex items-center gap-2 px-6 py-3 text-gray-700">
                                        <button type="button" @click="open = true"
                                            wire:click.prevent="actionModal('edit', {{ $product['id'] }})"
                                            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Edit</button>
                                        <button type="button" {{-- wire:click.prevent="deleteProduct({{ $index }})" --}}
                                            wire:click.prevent="actionModal('hapus', {{ $index }})"
                                            @click="openDelete = true"
                                            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Delete</button>
                                    </span>
                                </td>
                            @endcan
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-3 border-t border-gray-200 border-dashed">
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

    {{-- Modal --}}
    <x-modal-input>
        <x-slot:form>
            <form
                wire:submit.prevent="{{ $actionForm == 'tambah' || $actionForm == 'hapus' ? 'store' : 'updateProduct' }}"
                class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ $actionForm == 'tambah' || $actionForm == 'hapus' ? 'Tambah Product' : 'Update Product' }}
                    </h3>
                    <button type="button" @click="open = false" wire:click="resetAttributes"
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
                    <div class="grid grid-cols-6 gap-6 ">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="name-product"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Product</label>
                            <input type="text" id="name-product" wire:model.defer="nameProduct"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Steak" autofocus>
                            @error('nameProduct')
                                <span class="text-red-700 ">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="price-product"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price
                                Product</label>
                            <input type="number" id="price-product" wire:model.defer="price"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="10.000">
                            @error('price')
                                <span class="text-red-700 ">
                                    {{ $message }}
                                </span>
                            @enderror
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
                            @error('idCategorie')
                                <span class="text-red-700 ">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="stocks-product"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stocks</label>
                            <input type="number" id="stocks-product" wire:model.defer="stock"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="1">
                            @error('stock')
                                <span class="text-red-700 ">
                                    {{ $message }}
                                </span>
                            @enderror
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
                                @if ($errors->has('recipeStocks.' . $i . '.stock_id'))
                                    <span class="text-red-700">
                                        {{ $errors->first('recipeStocks.' . $i . '.stock_id') }}
                                    </span>
                                @endif
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <input type="number" wire:model.defer="recipeStocks.{{ $i }}.amount"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="1" step="0.5">
                                @if ($errors->has('recipeStocks.' . $i . '.amount'))
                                    <span class="text-red-700">
                                        {{ $errors->first('recipeStocks.' . $i . '.amount') }}
                                    </span>
                                @endif
                                {{-- @if ($errors->has('recipeStocks.{{ $i }}.amount'))
                                    <span class="text-red-700 ">
                                        {{ $errors->first('recipeStocks.{{ $i }}.amount') }}
                                    </span>
                                @endif --}}
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
                    class="flex items-center justify-end p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
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
