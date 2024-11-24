<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ __('MSOS | Register') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}"> 
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white rounded-lg shadow-2xl max-w-4xl">
        
        

        <div class="w-full p-8">
            <div class="text-center mb-4">
                <img src="{{ asset('storage/img/bulletin-logo.png') }}" alt="Logo" class="mx-auto" />
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <x-input-label class="block text-gray-700 text-sm mb-2" for="name" :value="__('Name')" />
                    <x-text-input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label class="block text-gray-700 text-sm mb-2" for="email" :value="__('Email')" />
                    <x-text-input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-4 relative">
                    <x-input-label class="block text-gray-700 text-sm mb-2" for="password" :value="__('Password')" />
                    <x-text-input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="password" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

                    <i class="fas fa-eye absolute right-3 bottom-3 text-gray-500 cursor-pointer" onclick="myFunction()"></i>
                </div>

                <div class="mb-4 relative">
                    <x-input-label class="block text-gray-700 text-sm mb-2" for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                    <i class="fas fa-eye absolute right-3 bottom-3 text-gray-500 cursor-pointer" onclick="ShowConfirm()"></i>
                </div>

                <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-200">{{ __('Register') }}</button>
            </form>

            <p class="mt-4 text-center text-gray-600">{{ __('Already registered?') }} <a class="text-blue-500" href="{{ route('login') }}">{{ __('Log in') }}</a></p>
        </div>
    </div>

    <script>
               function ShowConfirm() {
                    var x = document.getElementById("password_confirmation");
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                        x.type = "password";
                    }
                }
                
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>
</html>
