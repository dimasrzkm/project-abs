<div x-cloak x-show="open" @click.outside="open = false"
    class="fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full h-full px-4 py-6 overflow-x-hidden overflow-y-auto bg-gray-400 md:inset-0 bg-opacity-40">
    <div class="relative w-full max-w-2xl lg:h-auto">
        <!-- Modal content -->
        {{ $form }}
    </div>
</div>
