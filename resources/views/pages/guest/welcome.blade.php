<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ayang Beib Steak</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900">
    <header class="flex items-center justify-center lg:justify-start lg:items-stretch bg-[#EDEAE5] h-screen">
        <div
            class="relative flex flex-col items-center px-8 text-center gap-11 md:px-12 lg:w-1/2 lg:text-left lg:h-screen lg:gap-0 lg:items-start lg:justify-evenly">
            <img src="{{ asset('images/abs_logo.png') }}" alt="abs logo" class="self-start w-12 h-10">
            <div class="z-40 w-[350px] ml-12">
                <div class="mb-16 text-left ">
                    <h2 class="text-5xl font-extrabold leading-[55px] mb-3">Delicious and Cheap Steak Dishes For You
                    </h2>
                    <p class="font-medium leading-relaxed text-md">Cinta adalah bahan rahasiamu untuk bahagia bersama
                        Ayang Beib Steak.</p>
                </div>
                <button type="button"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Order Now</button>
            </div>
            {{-- <p class="text-sm font-semibold">@CopyrightTeamHAM</p> --}}
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
    </header>
    <main>
        <div class="container mx-auto">
            <section id="introduction" class="flex p-20 mt-4 border-t-4 border-b-gray-400">
                <img src="images/ricebox.png" alt="ricebox" class="w-72">
                <div class="max-w-2xl pt-8 pl-12">
                    <h2 class="text-4xl font-bold">BERANEKA macam sajian <br /> STEAK dari Ayang <br /> Beib Steak</h2>
                    <blockquote class="my-6 italic font-semibold text-gray-900 text-md dark:text-white">
                        <p>"Hati-hati jika ingin mencicipi Ayang beib Steak Bisa-bisa dompet Anda menipis karena
                            kecanduan
                            makan setiap hari!"</p>
                        <p>"Awas, konsumsi MilkShake Spesial dapat menimbulkan efek ketagihan, tidak mau pulang, hingga
                            menyamakan orang tersayang!"</p>
                    </blockquote>
                    <button type="button"
                        class="text-white bg-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Read More</button>
                </div>
            </section>
            <section id="contact-profile"
                class="flex justify-end gap-3 pb-4 border-b-4 cursor-pointer  border-b-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                </svg>
                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.88595 7.16985C9.06891 7.17475 9.27175 7.18465 9.46474 7.61303C9.59271 7.89821 9.80829 8.42321 9.9839 8.85087C10.1206 9.18366 10.233 9.45751 10.2611 9.51356C10.3254 9.64156 10.365 9.78926 10.2809 9.96156C10.271 9.98188 10.2617 10.0013 10.2526 10.02C10.1852 10.16 10.1372 10.2597 10.0237 10.3899C9.97709 10.4435 9.9285 10.5022 9.88008 10.5607C9.79494 10.6636 9.71035 10.7658 9.63785 10.838C9.50924 10.9659 9.37563 11.1039 9.52402 11.3599C9.6725 11.6159 10.1919 12.4579 10.9587 13.1373C11.783 13.8712 12.4998 14.1805 12.8622 14.3368C12.9325 14.3672 12.9895 14.3918 13.0313 14.4126C13.2886 14.5406 13.4419 14.5209 13.5903 14.3486C13.7388 14.1762 14.2334 13.6001 14.4066 13.3441C14.5748 13.0881 14.7479 13.1275 14.9854 13.2161C15.2228 13.3047 16.4892 13.9251 16.7464 14.0531C16.7972 14.0784 16.8448 14.1012 16.8889 14.1224C17.0678 14.2082 17.1895 14.2665 17.2411 14.3535C17.3054 14.4618 17.3054 14.9739 17.0927 15.5746C16.8751 16.1752 15.8263 16.7513 15.3514 16.7956C15.3064 16.7999 15.2617 16.8053 15.2156 16.8108C14.7804 16.8635 14.228 16.9303 12.2596 16.1555C9.83424 15.2018 8.23322 12.8354 7.90953 12.357C7.88398 12.3192 7.86638 12.2932 7.85698 12.2806L7.8515 12.2733C7.70423 12.0762 6.80328 10.8707 6.80328 9.62685C6.80328 8.43682 7.38951 7.81726 7.65689 7.53467C7.67384 7.51676 7.6895 7.50021 7.70366 7.48494C7.94107 7.22895 8.21814 7.16495 8.39125 7.16495C8.56445 7.16495 8.73756 7.16495 8.88595 7.16985Z"
                        fill="black" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M2.18418 21.3314C2.10236 21.6284 2.37285 21.9025 2.6709 21.8247L7.27824 20.6213C8.7326 21.409 10.37 21.8275 12.0371 21.8275H12.0421C17.5281 21.8275 22 17.3815 22 11.9163C22 9.26735 20.966 6.77594 19.0863 4.90491C17.2065 3.03397 14.7084 2 12.042 2C6.55607 2 2.08411 6.44605 2.08411 11.9114C2.08348 13.65 2.5424 15.3582 3.41479 16.8645L2.18418 21.3314ZM4.86092 17.2629C4.96774 16.8752 4.91437 16.4608 4.71281 16.1127C3.97266 14.8348 3.58358 13.3855 3.58411 11.9114C3.58411 7.28158 7.37738 3.5 12.042 3.5C14.3119 3.5 16.4296 4.37698 18.0281 5.96805C19.6248 7.55737 20.5 9.66611 20.5 11.9163C20.5 16.5459 16.7068 20.3275 12.0421 20.3275H12.0371C10.6206 20.3275 9.22863 19.9718 7.99266 19.3023C7.65814 19.1211 7.26726 19.0738 6.89916 19.17L4.13676 19.8915L4.86092 17.2629Z"
                        fill="black" />
                </svg>
                <svg width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <g>
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path fill-rule="nonzero"
                            d="M12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6zm0-2a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm6.5-.25a1.25 1.25 0 0 1-2.5 0 1.25 1.25 0 0 1 2.5 0zM12 4c-2.474 0-2.878.007-4.029.058-.784.037-1.31.142-1.798.332-.434.168-.747.369-1.08.703a2.89 2.89 0 0 0-.704 1.08c-.19.49-.295 1.015-.331 1.798C4.006 9.075 4 9.461 4 12c0 2.474.007 2.878.058 4.029.037.783.142 1.31.331 1.797.17.435.37.748.702 1.08.337.336.65.537 1.08.703.494.191 1.02.297 1.8.333C9.075 19.994 9.461 20 12 20c2.474 0 2.878-.007 4.029-.058.782-.037 1.309-.142 1.797-.331.433-.169.748-.37 1.08-.702.337-.337.538-.65.704-1.08.19-.493.296-1.02.332-1.8.052-1.104.058-1.49.058-4.029 0-2.474-.007-2.878-.058-4.029-.037-.782-.142-1.31-.332-1.798a2.911 2.911 0 0 0-.703-1.08 2.884 2.884 0 0 0-1.08-.704c-.49-.19-1.016-.295-1.798-.331C14.925 4.006 14.539 4 12 4zm0-2c2.717 0 3.056.01 4.122.06 1.065.05 1.79.217 2.428.465.66.254 1.216.598 1.772 1.153a4.908 4.908 0 0 1 1.153 1.772c.247.637.415 1.363.465 2.428.047 1.066.06 1.405.06 4.122 0 2.717-.01 3.056-.06 4.122-.05 1.065-.218 1.79-.465 2.428a4.883 4.883 0 0 1-1.153 1.772 4.915 4.915 0 0 1-1.772 1.153c-.637.247-1.363.415-2.428.465-1.066.047-1.405.06-4.122.06-2.717 0-3.056-.01-4.122-.06-1.065-.05-1.79-.218-2.428-.465a4.89 4.89 0 0 1-1.772-1.153 4.904 4.904 0 0 1-1.153-1.772c-.248-.637-.415-1.363-.465-2.428C2.013 15.056 2 14.717 2 12c0-2.717.01-3.056.06-4.122.05-1.066.217-1.79.465-2.428a4.88 4.88 0 0 1 1.153-1.772A4.897 4.897 0 0 1 5.45 2.525c.638-.248 1.362-.415 2.428-.465C8.944 2.013 9.283 2 12 2z" />
                    </g>
                </svg>
            </section>
        </div>
        <section id="promo" class="mt-5 bg-black">
            <div class="container py-8 mx-auto">
                <section class="flex gap-8">
                    <div class="w-1/2">
                        <img src="{{ asset('images/drum.jpg') }}" alt="drum">
                    </div>
                    <div class="w-2/3">
                        <h2 class="text-3xl text-neutral-100">Sensai Khas dari Ayang Beib <br /> Steak Siap Menyentuh
                            <br />Lidah Anda.</h2>
                        <p class="mt-5 text-gray-300">
                            "Steak, makanan yang dibuat dengan bahan-bahan premium pilihan Daging steak yang dipotong
                            tebal ini sungguh membuat anda kenyang, apalagi dengan Saus khas dari Ayang Beib Steak
                            sungguh mengenyangkan."
                        </p>
                    </div>
                </section>
                <section class="flex items-start justify-between my-14">
                    <img src="{{ asset('images/drum.jpg') }}" alt="test"
                        class="w-52 h-52 rounded-full object-cover object-center drop-shadow-[0_0_15px_rgba(255,255,255,0.65)]">
                    <img src="{{ asset('images/drum.jpg') }}" alt="test"
                        class="w-52 h-52 rounded-full object-cover object-center drop-shadow-[0_0_15px_rgba(255,255,255,0.65)]">
                    <img src="{{ asset('images/drum.jpg') }}" alt="test"
                        class="w-52 h-52 rounded-full object-cover object-center drop-shadow-[0_0_15px_rgba(255,255,255,0.65)]">
                    <img src="{{ asset('images/drum.jpg') }}" alt="test"
                        class="w-52 h-52 rounded-full object-cover object-center drop-shadow-[0_0_15px_rgba(255,255,255,0.65)]">
                </section>
            </div>
        </section>
    </main>
    <footer class="p-3 font-medium text-center bg-white">
        <p>Copyright@TeamHAM2022</p>
    </footer>
</body>

</html>
