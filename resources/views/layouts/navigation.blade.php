<header class="bg-white shadow-md py-4 flex flex-col md:flex-row justify-between items-center mb-8">
    <div class="container mx-auto flex justify-between items-center px-4 w-full lg:w-3/4">
        <a href="{{ route('dashboard') }}">
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
            <a
            id="dropdownAvatarNameButton"
            class="flex items-center cursor-pointer text-sm pe-1 font-medium text-gray-900 rounded-full hover:text-blue-600 dark:hover:text-blue-500 md:me-0 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-white">
            <img class="w-8 h-8 me-2 rounded-full" src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="{{ Auth::user()->name }}">
            <p class="text-black">{{ Auth::user()->name }}</p>
            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path class="text-black" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
            </svg>
        </a>
        

            <div id="dropdownAvatarName" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 absolute mt-2 right-0">

                <ul class="py-2 text-sm text-black" aria-labelledby="dropdownAvatarNameButton">
                    <li>
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-gray-100">{{ __('Home') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('author', ['user' => Auth::user()->id]) }}" class="block px-4 py-2 hover:bg-gray-100">{{ __('My Content') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">{{ __('Profile') }}</a>
                    </li>
                </ul>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="block px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer" :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</header>

<script>
    const dropdownButton = document.getElementById('dropdownAvatarNameButton');
    const dropdownMenu = document.getElementById('dropdownAvatarName');

    dropdownButton.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', (event) => {
        if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
</script>
