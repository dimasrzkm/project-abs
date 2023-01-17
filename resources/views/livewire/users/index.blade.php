<div class="py-12" x-data="{
    open: false,
    openDelete: false,
    openPerPage: false,
}">
    <x-data-table>
        <x-slot:title>User</x-slot>
            <x-slot:tbHead>
                <th wire:click="sortBy('name')"
                    class="sticky top-0 px-6 py-2 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-200 border-b border-gray-200 cursor-pointer">
                    <div class="flex items-center">
                        Name
                        <x-partials.sort-icon field="name" />
                    </div>
                </th>

                <th wire:click="sortBy('email')"
                    class="sticky top-0 px-6 py-2 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-200 border-b border-gray-200 cursor-pointer">
                    <div class="flex items-center">
                        Email
                        <x-partials.sort-icon field="email" />
                    </div>
                </th>

                <th wire:click="sortBy('is_admin')"
                    class="sticky top-0 px-6 py-2 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-200 border-b border-gray-200 cursor-pointer">
                    <div class="flex items-center">
                        Role
                        <x-partials.sort-icon field="is_admin" />
                    </div>
                </th>
                </x-slot>
                <x-slot:tbBody>
                    @forelse ($users as $index => $user)
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
                                <span class="flex items-center px-6 py-3 text-gray-700">{{ $user['name'] }}</span>
                            </td>
                            <td class="border-t border-gray-200 border-dashed firstName">
                                <span class="flex items-center px-6 py-3 text-gray-700">{{ $user['email'] }}</span>
                            </td>
                            <td class="border-t border-gray-200 border-dashed firstName">
                                <span
                                    class="flex items-center px-6 py-3 text-gray-700">{{ $user['is_admin'] == 1 ? 'Admin' : 'Pegawai' }}</span>
                            </td>
                            <td>
                                <button type="button" @click="open = true"
                                    wire:click.prevent="actionModal('edit', {{ $user['id'] }})"
                                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Edit</button>
                                <button type="button" wire:click.prevent="actionModal('hapus', {{ $index }})"
                                    @click="openDelete = true"
                                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Delete</button>
                            </td>
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

    <x-modal-input>
        <x-slot:form>
            <form wire:submit.prevent="{{ $actionForm == 'tambah' || $actionForm == 'hapus' ? 'store' : 'updateUser' }}"
                class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ $actionForm == 'tambah' || $actionForm == 'hapus' ? 'Tambah User' : 'Update User' }}
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
                            <label for="nama-user"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                            <input type="text" id="nama-user" wire:model.defer="namaUser"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Name" @if ($actionForm == 'edit') disabled @endif>
                            @error('namaUser')
                                <span class="text-red-700 ">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-span- sm:col-span-3">
                            <label for="email-user"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" id="email-user" wire:model.defer="emailUser"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Email" @if ($actionForm == 'edit') disabled @endif>
                            @error('emailUser')
                                <span class="text-red-700 ">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        @if ($actionForm != 'edit')
                            <div class="col-span- sm:col-span-3">
                                <label for="password-user"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                <input type="password" id="password-user" wire:model.defer="passwordUser"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-gray-600 focus:border-gray-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="password">
                                @error('passwordUser')
                                    <span class="text-red-700 ">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        @endif
                        <div class="col-span- sm:col-span-3">
                            <label for="role"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hak Akses</label>
                            <select id="role" wire:model.defer="roleUser"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Pilih Hak Akses</option>
                                <option value="1">Admin</option>
                                <option value="0">Pegawai</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div
                    class="flex items-center justify-end p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit" @click="open = !open"
                        class="text-white bg-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        {{ $actionForm == 'tambah' || $actionForm == 'hapus' ? 'Tambah' : 'Update' }}
                    </button>
                </div>
            </form>
            </x-slot>
    </x-modal-input>

    {{-- modal delete --}}
    <x-modal-delete>
        <x-slot:action>deleteUser</x-slot>
    </x-modal-delete>
</div>
