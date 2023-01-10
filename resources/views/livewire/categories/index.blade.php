<div class="py-12" x-data="{
    open: false,
    openDelete: false,
    openPerPage: false,
}">
    <x-data-table>
        <x-slot:title>Categorie</x-slot>
            <x-slot:tbHead>
                <th wire:click="sortBy('categorie')"
                    class="sticky top-0 px-6 py-2 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-200 border-b border-gray-200 cursor-pointer">
                    <div class="flex items-center">
                        Categorie
                        <x-partials.sort-icon field="categorie" />
                    </div>
                </th>

                <th wire:click="sortBy('slug')"
                    class="sticky top-0 px-6 py-2 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-200 border-b border-gray-200 cursor-pointer">
                    <div class="flex items-center">
                        Slug
                        <x-partials.sort-icon field="slug" />
                    </div>
                </th>
                </x-slot>
                <x-slot:tbBody>
                    @forelse ($categories as $index => $categorie)
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
                                @if ($editedCategorieIndex !== $index)
                                    <span
                                        class="flex items-center px-6 py-3 text-gray-700">{{ $categorie['categorie'] }}</span>

                                    {{-- {{ $item['categorie']}} --}}
                                @else
                                    <input type="text" wire:model.defer="categories.{{ $index }}.categorie"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @endif
                            </td>
                            <td class="border-t border-gray-200 border-dashed firstName">
                                <span class="flex items-center px-6 py-3 text-gray-700">{{ $categorie['slug'] }}</span>
                            </td>
                            @can('isAdmin')
                                <td class="border-t border-gray-200 border-dashed phoneNumber">
                                    <span class="flex items-center gap-2 px-6 py-3 text-gray-700">
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
                            @endcan
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-3 border-t border-gray-200 border-dashed">
                                <span class="flex items-center justify-center px-6 py-3 text-gray-700">Data tidak
                                    ditemukan!</span>
                            </td>
                        </tr>
                    @endforelse
                    </x-slot>
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
            <form wire:submit.prevent="store" class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
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
                <div class="h-full p-6 space-y-6 overflow-y-auto lg:h-auto">
                    <div class="grid gap-6 ">
                        <div class="col-span- sm:col-span-3">
                            <label for="name-categorie"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Categorie</label>
                            <input type="text" id="name-categorie" wire:model="nameCategorie"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="makanan">
                            @error('nameCategorie')
                                <span class="text-red-700 ">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
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
        <x-slot:action>actionModal('delete')</x-slot>
    </x-modal-delete>
</div>
