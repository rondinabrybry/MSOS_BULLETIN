<header class="bg-white shadow-md py-4 flex flex-col md:flex-row justify-between items-center mb-8">
    <div class="container mx-auto flex justify-between items-center px-4 w-full lg:w-3/4">
        <a href="{{ route('auth.login') }}">
            <div class="flex flex-row justify-center content-center text-4xl font-bold mb-4 md:mb-0">
                <img class="w-24" src="{{ asset('logo.png') }}">
                <div class="hidden md:flex flex-col">
                    <span class="text-black">{{ __('MSOS') }}<span class="text-blue-600"> {{ __(' BULLETIN') }}</span></span>
                    <span class="text-black" style="font-size: .70rem; line-height:.5rem;">{{ __('Multi-functional Student
                        Organizational System') }}</span>
                </div>
            </div>
        </a>

        <div class="relative">
            <a href="{{ route('auth.login') }}"
            id="dropdownAvatarNameButton"
            class="flex items-center cursor-pointer text-sm pe-1 font-medium text-gray-900 rounded-full hover:text-blue-600 dark:hover:text-blue-500 md:me-0 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-white">
             <p class="text-black">Login</p>
            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path class="text-black" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
            </svg>
        </a>
        </div>
    </div>
</header>
