<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ __('MSOS | BULLETIN') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}"> 
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .carousel-item {
            display: none;
        }
        .carousel-item.active {
            display: block;
        }
        @media (max-width: 767px) {
            .carousel-container {
                display: none;
            }
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white rounded-lg shadow-2xl flex flex-col md:flex-row w-11/12 md:w-3/4 max-w-4xl">
        <style>
        @media (max-width: 767px) {
            .carousel-container {
                display: none;
            }
        }
    </style>
        <div class="carousel-container w-full md:w-1/2 p-8 rounded-b-lg md:rounded-lg flex flex-col items-center justify-center mb-8 md:mb-0">
            <div class="carousel w-full">
                <a href="#" target="_blank">
                    <div class="carousel-item active">
                        <img alt="Illustration of project progress with charts and graphs" class="hidden md:block mb-6" src="{{ asset('storage/img/bulletin-banner.png') }}" width="500"/>
                    </a>
                        <h3 class="text-center text-xl font-semibold mb-2 hidden md:block">{{ __('Online Bulletin') }}</h3>
                        <p class="text-gray-600 text-center hidden md:block">{{ __('Touch Base for public information, events.') }}</p>
                    </div>
                
                <a href="https://www.msoshub.com/login" target="_blank">
                    <div class="carousel-item">
                        <img alt="Illustration of project management with charts and graphs" class="hidden md:block mb-6" src="{{ asset('storage/img/shop-banner.png') }}" width="500"/>
                    </a>
                        <h3 class="text-center text-xl font-semibold mb-2 hidden md:block">{{ __('Organization Shop') }}</h3>
                        <p class="text-gray-600 text-center hidden md:block">{{ __('All in One Merch Shop from your Favorite Org.') }}</p>
                    </div>
                
                <a href="https://attendance.msos.site/" target="_blank">
                    <div class="carousel-item">
                        <img alt="Illustration of team collaboration with charts and graphs" class="hidden md:block mb-6" src="{{ asset('storage/img/attendance-banner.png') }}" width="500"/>
                    </a>
                        <h3 class="text-center text-xl font-semibold mb-2 hidden md:block">{{ __('Attendance System') }}</h3>
                        <p class="text-gray-600 text-center hidden md:block">{{ __('Efficient way to manage attendance.') }}</p>
                    </div>
                
            </div>
        </div>

        <div class="w-full md:w-1/2 p-8">
            <div class="text-center mb-4">
                <img src="{{ asset('storage/img/bulletin-logo.png') }}" alt="Logo" class="mx-auto" />
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <x-input-label class="block text-gray-700 text-sm mb-2" for="email" :value="__('Email')" />
                    <x-text-input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-4 relative">
                    <x-input-label class="block text-gray-700 text-sm mb-2" for="password" :value="__('Password')" />
                    <x-text-input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="password"
                        type="password"
                        name="password"
                        required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

                    {{-- @if (Route::has('password.request'))
                    <a class="absolute right-2 top-2 text-blue-500 text-sm" href="https://shop.msoshub.com/forgot-password" target="_blank">{{ __('Forgot your password?') }}</a>
                    @endif --}}
                    <i class="fas fa-eye absolute right-3 bottom-3 text-gray-500 cursor-pointer" onclick="myFunction()"></i>
                </div>

                <div class="mb-6 flex items-center">
                    <input class="mr-2" id="remember_me" type="checkbox"/>
                    <label class="text-gray-700 text-sm" for="remember_me" name="remember">{{ __('Remember me') }}</label>
                </div>
                <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-200">{{ __('Log in') }}</button>
            </form>
            <p class="mt-4 text-center text-gray-600">{{ __('Forgot your password?') }} <a class="text-blue-500" href="{{ route('register') }}">{{ __('Sign up') }}</a></p>
        </div>
    </div>

    <script>
        function myFunction() {
          var x = document.getElementById("password");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
        }
        </script>
    
    <script>
        const indicators = document.querySelectorAll('.carousel-indicator');
        const items = document.querySelectorAll('.carousel-item');
        let currentIndex = 0;

        function showSlide(index) {
            items.forEach(item => item.classList.remove('active'));
            indicators.forEach(ind => ind.classList.remove('bg-blue-600'));
            indicators.forEach(ind => ind.classList.add('bg-gray-400'));

            items[index].classList.add('active');
            indicators[index].classList.add('bg-blue-600');
        }

        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                currentIndex = index;
                showSlide(index);
            });
        });

        function autoPlay() {
            currentIndex = (currentIndex + 1) % items.length;
            showSlide(currentIndex);
        }

        setInterval(autoPlay, 3000);
    </script>
</body>
</html>
