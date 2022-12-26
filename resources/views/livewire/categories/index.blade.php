<div class="py-12" x-data="{
    open: false,
    openDelete: false,
    openPerPage: false,
}">
    <x-data-table>
        <x-slot:title>Categorie</x-slot>
        <x-slot:tbHead>
            <th wire:click="sortBy('categorie')"
                class="bg-gray-200 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs cursor-pointer">
                <div class="flex items-center">
                    Categorie
                    <x-partials.sort-icon field="categorie" />
                </div>
            </th>

            <th wire:click="sortBy('slug')"
                class="bg-gray-200 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs cursor-pointer">
                <div class="flex items-center">
                    Slug
                    <x-partials.sort-icon field="slug" />
                </div>
            </th>
        </x-slot>
        <x-slot:tbBody>
            @forelse ($categories as $index => $categorie)
                <tr>
                    <td class="border-dashed border-t border-gray-200 px-3">
                        <label
                            class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
                            <input type="checkbox"
                                class="form-checkbox rowCheckbox focus:outline-none focus:shadow-outline"
                                name="1" />
                        </label>
                    </td>
                    <td class="border-dashed border-t border-gray-200">
                        @if ($editedCategorieIndex !== $index)
                            <span
                                class="text-gray-700 px-6 py-3 flex items-center">{{ $categorie['categorie'] }}</span>

                            {{-- {{ $item['categorie']}} --}}
                        @else
                            <input type="text" wire:model.defer="categories.{{ $index }}.categorie"
                                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @endif
                    </td>
                    <td class="border-dashed border-t border-gray-200 firstName">
                        <span class="text-gray-700 px-6 py-3 flex items-center">{{ $categorie['slug'] }}</span>
                    </td>
                    <td class="border-dashed border-t border-gray-200 phoneNumber">
                        <span class="text-gray-700 px-6 py-3 flex gap-2 items-center">
                            @if ($editedCategorieIndex !== $index)
                                <button type="button"
                                    wire:click.prevent="getIdCategorie('edit', {{ $index }})"
                                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Edit</button>
                                <button type="button"
                                    wire:click.prevent="getIdCategorie('delete', {{ $index }})"
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
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="border-dashed border-t border-gray-200 px-3">
                        <span class="text-gray-700 px-6 py-3 flex items-center justify-center">Data tidak
                            ditemukan!</span>
                    </td>
                </tr>
            @endforelse
        </x-slot>
        @if ($links->lastPage() > 1)
            <div class="bg-white px-4 py-3 sm:px-6 rounded-b-lg">
                @if ($links->links())
                    {{ $links->links() }}
                @endif
            </div>
        @endif
    </x-data-table>

    {{-- Modal Input --}}
    <x-modal-input>
        <x-slot:form>
            <form wire:submit.prevent="store" class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Tambah Categorie
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
                <div class="p-6 space-y-6 overflow-y-auto h-full lg:h-auto">
                    <div class="grid gap-6 ">
                        <div class="col-span- sm:col-span-3">
                            <label for="name-categorie"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Categorie</label>
                            <input type="text" id="name-categorie" wire:model="nameCategorie"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="makanan">
                            @error('nameCategorie')
                                <span class=" text-red-700">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div
                    class="flex items-center justify-end p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                    <button type="submit" @click="open = !open"
                        class="text-white bg-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Tambah</button>
                </div>
            </form>
        </x-slot>
    </x-modal-input>

    {{-- modal delete --}}
    <x-modal-delete>
        <x-slot:action>actionModal('delete')</x-slot>
    </x-modal-delete>
</div>
