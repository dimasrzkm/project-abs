<x-guest-layout>
    <div class="flex items-center justify-center lg:justify-start lg:items-stretch bg-[#EDEAE5] h-screen">
        <div
            class="relative flex flex-col items-center px-8 text-center lg:items-start lg:justify-around md:px-12 lg:w-1/2 lg:text-left gap-11">
            <img src="{{ asset('images/abs_logo.png') }}" alt="abs logo" class="w-12 h-10">
            <div class="z-40 w-[300px] mx-auto">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <div class="mb-16 font-bold leading-relaxed text-center">
                    <h2 class="text-3xl">Welcome Back</h2>
                    <p class="text-xs">Please enter your details.</p>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />

                        <x-text-input id="email" class="block w-full mt-1" type="email" name="email"
                            :value="old('email')" required placeholder="Enter Your Email" autofocus />

                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required
                            autocomplete="current-password" placeholder="******" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-5">
                        <x-primary-button class="justify-center w-full">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
            <p class="text-sm font-semibold">@CopyrightTeamHAM</p>
            <img src="{{ asset('images/wave.png') }}" alt="wave"
                class="z-40 hidden lg:block lg:absolute lg:h-full lg:left-2/3">
        </div>
        <div class="relative hidden bg-black lg:block lg:w-1/2">
            <img src="{{ asset('images/lines.png') }}" alt="lines"
                class="hidden h-full lg:block lg:absolute :w-full">
            <img src="{{ asset('images/sirloin.png') }}" alt="lines"
                class="hidden lg:block lg:absolute bottom-24  right-0 z-40 h-[465px]">
            <img src="{{ asset('images/cordon.png') }}" alt="lines"
                class="hidden lg:block lg:absolute bottom-0 right-0 z-40 h-[365px]">
        </div>
    </div>
</x-guest-layout>
