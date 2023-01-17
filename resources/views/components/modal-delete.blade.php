<div x-cloak x-show="openDelete" @click.outside="openDelete = false"
    class="fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full h-full px-4 py-6 overflow-x-hidden overflow-y-auto bg-gray-400 md:inset-0 bg-opacity-40">
    <div class="relative flex items-center justify-center w-full h-full max-w-2xl md:h-auto">
        <div class="my-3 bg-white rounded-lg shadow-lg md:w-2/3 sm:w-full">
            <div class="flex justify-between px-5 py-4 border-b border-gray-100">
                <div>
                    <div class="flex items-center justify-center gap-1">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path fill="#b91c1c" d="M13 14H11V9H13M13 18H11V16H13M1 21H23L12 2L1 21Z" />
                        </svg>
                        <i class="bg-red-700 fa fa-exclamation-triangle"></i>
                        <span class="text-lg font-bold text-gray-700">Warning</span>
                    </div>
                </div>
                <div>
                    <svg class="w-5 h-5 cursor-pointer" wire:click="actionCancel('edit')" @click="openDelete = false"
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
                    wire:click="actionCancel('edit')" @click="openDelete = false">Cancel</button>
                <button class="px-3 py-2 text-sm text-white transition duration-150 bg-red-600 rounded hover:bg-red-700"
                    wire:click.prevent="{{ $action }}" @click="openDelete = false">OK</button>
            </div>
        </div>
    </div>
</div>
