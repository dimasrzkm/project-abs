<div class="py-12" x-data="{
    open: false,
    openDelete: false,
    openPerPage: false,
    openDatePicker: false,
}">
    <x-data-table>
        <x-slot:title>Pembukuan</x-slot>
            <x-slot:datePicker>
                <div class="flex flex-col items-center p-2 lg:flex-row">
                    <div class="relative">
                        <input type="date" wire:model="startDateFilter"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <span class="mx-4 text-gray-500">to</span>
                    <div class="relative">
                        <input type="date" wire:model="endDateFilter"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                </div>
                <div class="flex justify-end p-2">
                    <button type="button" wire:click="export"
                        class="text-white bg-gray-800 w-full lg:w-min hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Download</button>
                </div>
                </x-slot>
                <x-slot:tbHead>
                    <th wire:click="sortBy('jumlah')"
                        class="sticky top-0 px-6 py-2 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-200 border-b border-gray-200 cursor-pointer">
                        <div class="flex items-center">
                            Jumlah Product
                            <x-partials.sort-icon field="jumlah" />
                        </div>
                    </th>

                    <th wire:click="sortBy('nominal_masuk')"
                        class="sticky top-0 px-6 py-2 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-200 border-b border-gray-200 cursor-pointer">
                        <div class="flex items-center">
                            Nominal Masuk
                            <x-partials.sort-icon field="nominal_masuk" />
                        </div>
                    </th>

                    <th wire:click="sortBy('nominal_keluar')"
                        class="sticky top-0 px-6 py-2 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-200 border-b border-gray-200 cursor-pointer">
                        <div class="flex items-center">
                            Nominal Keluar
                            <x-partials.sort-icon field="nominal_keluar" />
                        </div>
                    </th>

                    <th wire:click="sortBy('keterangan')"
                        class="sticky top-0 px-6 py-2 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-200 border-b border-gray-200 cursor-pointer">
                        <div class="flex items-center">
                            Keterangan
                            <x-partials.sort-icon field="keterangan" />
                        </div>
                    </th>

                    <th wire:click="sortBy('tanggal')"
                        class="sticky top-0 px-6 py-2 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-200 border-b border-gray-200 cursor-pointer">
                        <div class="flex items-center">
                            Tanggal
                            <x-partials.sort-icon field="tanggal" />
                        </div>
                    </th>
                    </x-slot>
                    <x-slot:tbBody>
                        @forelse ($pembukuan as $index => $data)
                            <tr>
                                <td class="px-3 border-t border-gray-200 border-dashed">
                                    <label
                                        class="inline-flex items-center justify-between px-2 py-2 text-teal-500 rounded-lg cursor-pointer hover:bg-gray-200">
                                        <input type="checkbox" id="checkbox-table-{{ $data['id'] }}"
                                            class="form-checkbox rowCheckbox focus:outline-none focus:shadow-outline"
                                            name="1" />
                                    </label>
                                </td>
                                <td class="border-t border-gray-200 border-dashed">
                                    <span class="flex items-center px-6 py-3 text-gray-700">{{ $data['jumlah'] }}</span>
                                </td>
                                <td class="border-t border-gray-200 border-dashed firstName">
                                    <span class="flex items-center px-6 py-3 text-gray-700">Rp.
                                        {{ number_format($data['nominal_masuk'], 0, ',', '.') }}</span>
                                </td>
                                <td class="border-t border-gray-200 border-dashed firstName">
                                    <span class="flex items-center px-6 py-3 text-gray-700">Rp.
                                        {{ number_format($data['nominal_keluar'], 0, ',', '.') }}</span>
                                </td>
                                <td class="border-t border-gray-200 border-dashed firstName">
                                    <span
                                        class="flex items-center px-6 py-3 text-gray-700">{{ $data['keterangan'] }}</span>
                                </td>
                                <td class="border-t border-gray-200 border-dashed firstName">
                                    <span
                                        class="flex items-center px-6 py-3 text-gray-700">{{ $data['tanggal']->format('d / M / Y') }}</span>
                                </td>
                                <td class="border-t border-gray-200 border-dashed phoneNumber">
                                    <span class="flex items-center gap-2 px-6 py-3 text-gray-700">
                                        <button type="button" @click="open = true"
                                            wire:click.prevent="actionModal('edit', {{ $data['id'] }})"
                                            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Edit</button>
                                        <button type="button"
                                            wire:click.prevent="actionModal('hapus', {{ $data['id'] }})"
                                            @click="openDelete = true"
                                            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Delete</button>
                                    </span>
                                </td>
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

    {{-- Modal Input --}}
    <x-modal-input>
        <x-slot:form>
            <form
                wire:submit.prevent="{{ $actionForm == 'tambah' || $actionForm == 'hapus' ? 'store' : 'updatePembukuan' }}"
                class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ $actionForm == 'tambah' || $actionForm == 'hapus' ? 'Tambah Pembukuan' : 'Update Pembukuan' }}
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
                            <label for="tanggal"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                            </label>
                            <input type="date" wire:model.defer="tanggalPembukuan" id="tanggal"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('tanggalPembukuan')
                                <span class="text-red-700 ">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="jumlah-product"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah
                                Product</label>
                            <input type="number" wire:model.defer="jumlahProduct" step="1" id="jumlah-product"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="1">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <div x-data="{
                                chooseIncome: false
                            }">
                                <div>
                                    <label for="Toggle3"
                                        class="inline-flex items-center p-2 pl-0 rounded-md cursor-pointer dark:text-gray-800">
                                        <input id="Toggle3" type="checkbox" class="hidden peer">
                                        <span @click="chooseIncome = false"
                                            class="px-4 py-2 text-white bg-gray-800 rounded-l-md peer-checked:bg-gray-300 peer-checked:text-black">Pengeluaran</span>
                                        <span @click="chooseIncome = true"
                                            class="px-4 py-2 bg-gray-300 rounded-r-md peer-checked:bg-gray-800 peer-checked:text-white">Pemasukan</span>
                                    </label>
                                </div>
                                <div x-show="chooseIncome">
                                    <label for="nominal-masuk"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nominal
                                        Masuk</label>
                                    <input type="number" wire:model.defer="nominalMasuk" id="nominal-masuk"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="10.000">
                                </div>
                                <div x-show="chooseIncome==false">
                                    <label for="nominal-keluar"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nominal
                                        Keluar</label>
                                    <input type="number" wire:model.defer="nominalKeluar" id="nominal-keluar"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="10.000">
                                </div>
                            </div>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="keterangan"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">keterangan</label>
                            <textarea id="keterangan" rows="4" wire:model.defer="keterangan"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Tambahkan keterangan..."></textarea>
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

    {{-- modal delete --}}
    <x-modal-delete>
        <x-slot:action>deletePembukuan</x-slot>
    </x-modal-delete>
</div>
