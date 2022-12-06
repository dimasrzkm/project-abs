<div x-cloak x-show="openDelete" @click.outside="openDelete = false"
    class="flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center py-6 px-4 w-full md:inset-0 h-full bg-gray-400 bg-opacity-40">
    <div class="relative w-full max-w-2xl h-full md:h-auto flex justify-center items-center">
        <div class="md:w-2/3 sm:w-full rounded-lg shadow-lg bg-white my-3">
            <div class="flex justify-between border-b border-gray-100 px-5 py-4">
                <div>
                    <div class="flex justify-center items-center gap-1">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path fill="#b91c1c" d="M13 14H11V9H13M13 18H11V16H13M1 21H23L12 2L1 21Z" />
                        </svg>
                        <i class="fa fa-exclamation-triangle bg-red-700"></i>
                        <span class="font-bold text-gray-700 text-lg">Warning</span>
                    </div>
                </div>
                <div>
                    <svg class="h-5 w-5 cursor-pointer" wire:click="actionCancel('edit')" @click="openDelete = false"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill="#D84315"
                            d="M12,2C17.53,2 22,6.47 22,12C22,17.53 17.53,22 12,22C6.47,22 2,17.53 2,12C2,6.47 6.47,2 12,2M15.59,7L12,10.59L8.41,7L7,8.41L10.59,12L7,15.59L8.41,17L12,13.41L15.59,17L17,15.59L13.41,12L17,8.41L15.59,7Z" />
                    </svg>
                </div>
            </div>

            <div class="px-10 py-5 text-gray-600">
                Anda yakin ingin mengahapus data?
            </div>

            <div class="px-5 py-4 flex justify-end">
                <button
                    class="bg-gray-800 hover:bg-gray-900 mr-1 rounded text-sm py-2 px-3 text-white transition duration-150"
                    wire:click="actionCancel('edit')" @click="openDelete = false">Cancel</button>
                <button class="bg-red-600 rounded text-sm py-2 px-3 text-white hover:bg-red-700 transition duration-150"
                    wire:click.prevent="{{ $action }}" @click="openDelete = false">OK</button>
            </div>
        </div>
    </div>
</div>
