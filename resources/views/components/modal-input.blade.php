<div x-cloak x-show="open" @click.outside="open = false"
    class="flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center py-6 px-4 w-full md:inset-0 h-full bg-gray-400 bg-opacity-40">
    <div class="relative w-full max-w-2xl lg:h-auto">
        <!-- Modal content -->
        {{ $form }}
    </div>
</div>
