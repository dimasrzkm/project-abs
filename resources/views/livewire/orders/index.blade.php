<div class="py-12" x-data="{
    open: false,
    openDelete: false,
    openQr: false,
    openPerPage: false,
}">
    <x-data-table>
        <x-slot:title>Orders</x-slot>
            <x-slot:tbHead>
                <th wire:click="sortBy('user_id')"
                    class="sticky top-0 px-6 py-2 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-200 border-b border-gray-200 cursor-pointer">
                    <div class="flex items-center">
                        Penerima Order
                        <x-partials.sort-icon field="user_id" />
                    </div>
                </th>

                <th wire:click="sortBy('id')"
                    class="sticky top-0 px-6 py-2 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-200 border-b border-gray-200 cursor-pointer">
                    <div class="flex items-center">
                        Nomor Order
                        <x-partials.sort-icon field="id" />
                    </div>
                </th>

                <th wire:click="sortBy('date_order')"
                    class="sticky top-0 px-6 py-2 text-xs font-bold text-gray-600 uppercase bg-gray-200 border-b border-gray-200 cursor-pointer tracking-wdate_orderer">
                    <div class="flex items-center">
                        Tanggal Transaksi
                        <x-partials.sort-icon field="date_order" />
                    </div>
                </th>

                <th
                    class="sticky top-0 px-6 py-2 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-200 border-b border-gray-200 firstName">
                    Status
                </th>
                </x-slot>
                <x-slot:tbBody>
                    @forelse ($orders as $index => $order)
                        <tr>
                            <td class="px-3 border-t border-gray-200 border-dashed">
                                <label
                                    class="inline-flex items-center justify-between px-2 py-2 text-teal-500 rounded-lg cursor-pointer hover:bg-gray-200">
                                    <input type="checkbox"
                                        class="form-checkbox rowCheckbox focus:outline-none focus:shadow-outline"
                                        name="1" />
                                </label>
                            </td>
                            <td class="border-t border-gray-200 border-dashed">
                                <span class="flex items-center px-6 py-3 text-gray-700">
                                    {{ $order->user->name }}
                                </span>
                            </td>
                            <td class="border-t border-gray-200 border-dashed cursor-pointer hover:underline"
                                wire:click.prevent="actionModal('edit', {{ $order->id }})" @click="open = true">
                                <span class="flex items-center px-6 py-3 text-gray-700">
                                    {{ 'OD' }}-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>
                            <td class="border-t border-gray-200 border-dashed">
                                <span class="flex items-center px-6 py-3 text-gray-700">
                                    {{ $order->date_order->format('d / M / Y') }}
                                </span>
                            </td>
                            <td class="border-t border-gray-200 border-dashed">
                                <span class="flex items-center px-6 py-3 text-gray-700">
                                    <label class="relative inline-flex items-center mt-3 mb-5 cursor-pointer">
                                        <input type="checkbox" value=""
                                            wire:click="changeStatus({{ $order->id }})" class="sr-only peer"
                                            {{ $order->status == 'waiting' ? '' : 'checked disabled' }}>
                                        <div
                                            class="w-9 h-5 bg-rose-500 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-emerald-400">
                                        </div>

                                    </label>
                                </span>
                            </td>
                            @can('isAdmin')
                                <td class="border-t border-gray-200 border-dashed">
                                    <span class="flex items-center gap-2 px-6 py-3 text-gray-700">
                                        @if (empty($order->receipt->order_id))
                                            <button type="button"
                                                wire:click.prevent="actionModal('generatePDF', {{ $order->id }})"
                                                class="px-2 py-1 text-sm font-medium text-white bg-gray-800 rounded-lg hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                                </svg>
                                            </button>
                                        @endif
                                        <button type="button"
                                            wire:click.prevent="actionModal('generateQR', {{ $order->id }})"
                                            @click="openQr = true"
                                            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                class="w-5 h-5">
                                                <path fill-rule="evenodd"
                                                    d="M3 4.875C3 3.839 3.84 3 4.875 3h4.5c1.036 0 1.875.84 1.875 1.875v4.5c0 1.036-.84 1.875-1.875 1.875h-4.5A1.875 1.875 0 013 9.375v-4.5zM4.875 4.5a.375.375 0 00-.375.375v4.5c0 .207.168.375.375.375h4.5a.375.375 0 00.375-.375v-4.5a.375.375 0 00-.375-.375h-4.5zm7.875.375c0-1.036.84-1.875 1.875-1.875h4.5C20.16 3 21 3.84 21 4.875v4.5c0 1.036-.84 1.875-1.875 1.875h-4.5a1.875 1.875 0 01-1.875-1.875v-4.5zm1.875-.375a.375.375 0 00-.375.375v4.5c0 .207.168.375.375.375h4.5a.375.375 0 00.375-.375v-4.5a.375.375 0 00-.375-.375h-4.5zM6 6.75A.75.75 0 016.75 6h.75a.75.75 0 01.75.75v.75a.75.75 0 01-.75.75h-.75A.75.75 0 016 7.5v-.75zm9.75 0A.75.75 0 0116.5 6h.75a.75.75 0 01.75.75v.75a.75.75 0 01-.75.75h-.75a.75.75 0 01-.75-.75v-.75zM3 14.625c0-1.036.84-1.875 1.875-1.875h4.5c1.036 0 1.875.84 1.875 1.875v4.5c0 1.035-.84 1.875-1.875 1.875h-4.5A1.875 1.875 0 013 19.125v-4.5zm1.875-.375a.375.375 0 00-.375.375v4.5c0 .207.168.375.375.375h4.5a.375.375 0 00.375-.375v-4.5a.375.375 0 00-.375-.375h-4.5zm7.875-.75a.75.75 0 01.75-.75h.75a.75.75 0 01.75.75v.75a.75.75 0 01-.75.75h-.75a.75.75 0 01-.75-.75v-.75zm6 0a.75.75 0 01.75-.75h.75a.75.75 0 01.75.75v.75a.75.75 0 01-.75.75h-.75a.75.75 0 01-.75-.75v-.75zM6 16.5a.75.75 0 01.75-.75h.75a.75.75 0 01.75.75v.75a.75.75 0 01-.75.75h-.75a.75.75 0 01-.75-.75v-.75zm9.75 0a.75.75 0 01.75-.75h.75a.75.75 0 01.75.75v.75a.75.75 0 01-.75.75h-.75a.75.75 0 01-.75-.75v-.75zm-3 3a.75.75 0 01.75-.75h.75a.75.75 0 01.75.75v.75a.75.75 0 01-.75.75h-.75a.75.75 0 01-.75-.75v-.75zm6 0a.75.75 0 01.75-.75h.75a.75.75 0 01.75.75v.75a.75.75 0 01-.75.75h-.75a.75.75 0 01-.75-.75v-.75z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                        <button type="button"
                                            wire:click.prevent="actionModal('hapus', {{ $order->id }})"
                                            @click="openDelete = true"
                                            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </span>
                                </td>
                            @endcan
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-3 border-t border-gray-200 border-dashed">
                                <span class="flex items-center justify-center px-6 py-3 text-gray-700">Data tidak
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


    {{-- Modal Input --}}
    <x-modal-input>
        <x-slot:form>
            <form
                wire:submit.prevent="{{ $actionForm == 'tambah' || $actionForm == 'hapus' ? 'store' : 'updateOrder' }}"
                class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ $actionForm == 'tambah' || $actionForm == 'hapus' ? 'Tambah Order' : 'Update Order' }}
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
                    <div class="grid gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="name-categorie"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penerima
                                Pesanan</label>
                            <input type="text"
                                value="{{ $actionForm == 'tambah' || $actionForm == 'hapus' ? Auth::user()->name : $namaPenerima }}"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                disabled>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="name-categorie"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                Transaksi</label>
                            <input type="date" wire:model.defer="tanggalTransaksi"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('tanggalTransaksi')
                                <span class="text-red-700 ">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <table
                                class="w-full mx-auto text-sm text-left text-gray-500 sm:px-6 lg:px-8 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Product
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Amount
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < count($productStore); $i++)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            @if (empty($productStore[$i]))
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <select
                                                        wire:model.defer="productStore.{{ $i }}.product_id"
                                                        class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                        <option selected>-Menu-</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}">
                                                                {{ $product->name_product }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('productStore.' . $i . '.product_id'))
                                                        <span class="text-red-700">
                                                            {{ $errors->first('productStore.' . $i . '.product_id') }}
                                                        </span>
                                                    @endif
                                                </th>
                                            @else
                                                <td class="px-6 py-4">
                                                    {{ $productStore[$i]['name_product'] }}
                                                </td>
                                            @endif
                                            <td class="px-6 py-4">
                                                @if (empty($productStore[$i]))
                                                    <input type="text"
                                                        wire:model.defer="productStore.{{ $i }}.amount"
                                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    @if ($errors->has('productStore.' . $i . '.amount'))
                                                        <span class="text-red-700">
                                                            {{ $errors->first('productStore.' . $i . '.amount') }}
                                                        </span>
                                                    @endif
                                                @else
                                                    {{ $productStore[$i]['amount'] }}
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                @if (empty($productStore[$i]))
                                                    <button type="button" wire:click.prevent="confirmItem"
                                                        wire:model.defer="productStore.{{ $i }}.is_confirm"
                                                        class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                                                        Confirm
                                                    </button>
                                                @endif
                                                <button type="button"
                                                    wire:click.prevent="deleteItem({{ $i }})"
                                                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Delete</button>
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                            <button type="button" wire:click="addNewItems"
                                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-1.5 mt-3 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Add
                                Product</button>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <table>
                                <tbody>
                                    <tr
                                        class="w-2 h-0 bg-white border-b-2 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                                        <td scope="row"
                                            class="pr-6 text-sm font-extrabold text-gray-900 whitespace-nowrap dark:text-white">
                                            SubTotal</td>
                                        <td class="px-6 py-4 text-sm"> Rp. {{ number_format($total, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr
                                        class="w-2 h-0 bg-white border-b-2 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                                        <td scope="row"
                                            class="pr-6 text-sm font-extrabold text-gray-900 whitespace-nowrap dark:text-white">
                                            Pajak</td>
                                        <td class="px-6 py-4 text-sm">Rp. {{ number_format($tax, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr
                                        class="w-2 h-0 bg-white border-b-2 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">
                                        <td scope="row"
                                            class="pr-6 text-sm font-extrabold text-gray-900 whitespace-nowrap dark:text-white">
                                            Total</td>
                                        <td class="px-6 py-4 text-sm">Rp. {{ number_format($subTotal, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div
                    class="flex items-center justify-end p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit" @click="open = false"
                        class="text-white bg-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        {{ $actionForm == 'tambah' || $actionForm == 'hapus' ? 'Tambah' : 'Update' }}
                    </button>
                </div>
            </form>
            </x-slot>
    </x-modal-input>

    {{-- <div x-cloak x-show="openDelete" @click.outside="openDelete = false"
        class="fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full h-full px-4 py-6 overflow-x-hidden overflow-y-auto bg-gray-400 md:inset-0 bg-opacity-40">
        <div class="relative flex items-center justify-center w-full h-full max-w-2xl md:h-auto">
            <div class="my-3 bg-white rounded-lg shadow-lg md:w-2/3 sm:w-full">
                <div class="flex justify-between px-5 py-4 border-b border-gray-100">
                    <div>
                        <div class="flex items-center justify-center gap-1">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path fill="#b91c1c" d="M13 14H11V9H13M13 18H11V16H13M1 21H23L12 2L1 21Z" />
                            </svg>
                            <i class="text-orange-500 fa fa-exclamation-triangle"></i>
                            <span class="text-lg font-bold text-gray-700">Warning</span>
                        </div>
                    </div>
                    <div>
                        <svg class="w-5 h-5 cursor-pointer" wire:click="actionCancel('edit')"  @click="openDelete = false"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path fill="#D84315"
                                d="M12,2C17.53,2 22,6.47 22,12C22,17.53 17.53,22 12,22C6.47,22 2,17.53 2,12C2,6.47 6.47,2 12,2M15.59,7L12,10.59L8.41,7L7,8.41L10.59,12L7,15.59L8.41,17L12,13.41L15.59,17L17,15.59L13.41,12L17,8.41L15.59,7Z" />
                        </svg>
                    </div>
                </div>

                <div class="px-10 py-5 text-gray-600">
                    Anda yakin ingin mengahapus data?
                </div>

                <div class="flex justify-end px-5 py-4">
                    <button
                        class="px-3 py-2 mr-1 text-sm text-white transition duration-150 bg-gray-800 rounded hover:bg-gray-900"
                        wire:click="actionCancel('edit')"   @click="openDelete = false">Cancel</button>
                    <button class="px-3 py-2 text-sm text-white transition duration-150 bg-red-600 rounded hover:bg-red-700"
                        wire:click.prevent="deleteOrder" @click="openDelete = false">OK</button>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- modal delete --}}
    <x-modal-delete>
        <x-slot:action>deleteOrder</x-slot>
    </x-modal-delete>

    {{-- Modal Qr --}}
    <div x-cloak x-show="openQr" class="relative z-10" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <!--
          Background backdrop, show/hide based on modal state.
      
          Entering: "ease-out duration-300"
            From: "opacity-0"
            To: "opacity-100"
          Leaving: "ease-in duration-200"
            From: "opacity-100"
            To: "opacity-0"
        -->
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" @click.outside="openQr = false"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex items-end justify-center min-h-full p-4 text-center sm:items-center sm:p-0">
                <!--
              Modal panel, show/hide based on modal state.
      
              Entering: "ease-out duration-300"
                From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                To: "opacity-100 translate-y-0 sm:scale-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100 translate-y-0 sm:scale-100"
                To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            -->
                <div class="relative overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl">
                    <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                        <div class="flex items-start sm:block">
                            {!! QrCode::size(100)->generate(url('receipts/' . $qrUrl)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
