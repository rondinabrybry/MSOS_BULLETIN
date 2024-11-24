<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-adsense-account" content="ca-pub-6444619677143056">
    <meta name="description"
        content="{{ $metaDescription ?? 'Explore the latest news, academic programs, student resources, and campus life at Cebu Technological University - Danao Campus. Stay informed about admissions, scholarships, events, and opportunities for student success in a vibrant university community' }}">
    <meta name="keywords"
        content="{{ $metaKeywords ?? 'university, higher education, college life, campus, academic programs, student resources, faculty, research, scholarships, admissions, university news, student success, study tips, campus events, degree programs, online courses, university rankings, international students, student organizations, alumni, university community, career services, campus facilities, financial aid, student engagement, academic excellence, student support, university events, campus culture, educational opportunities, university guide, study abroad, university life, campus tours, student housing, university admissions process' }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>MSOS | News</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    <script src="{{ asset('js/image-resize.min.js') }}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <header class="bg-white shadow-md py-4 flex flex-col md:flex-row justify-between items-center mb-8">
            <div class="container mx-auto flex justify-between items-center px-4 w-full lg:w-3/4">
                <a href="{{ route('news') }}">
                    <div class="flex flex-row justify-center content-center text-4xl font-bold mb-4 md:mb-0">
                        <img class="w-24" src="{{ asset('logo.png') }}">
                        <div class="hidden md:flex flex-col">
                            <span class="text-black">{{ __('MSOS') }}<span class="text-blue-600">
                                    {{ __(' BULLETIN') }}</span></span>
                            <span class="text-black"
                                style="font-size: .70rem; line-height:.5rem;">{{ __('Multi-functional Student Organizational System') }}</span>
                        </div>
                    </div>
                </a>
                <div class="relative">
                    <a href="{{ route('login') }}" id="dropdownAvatarNameButton"
                        class="flex items-center cursor-pointer text-sm pe-1 font-medium text-gray-900 rounded-full hover:text-blue-600 dark:hover:text-blue-500 md:me-0 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-white">
                        <p class="text-black">Login</p>
                    </a>
                </div>
            </div>
        </header>
        <main class="container mx-auto mt-8 w-full lg:w-3/4">
            <article class="bg-white px-6 py-6 rounded-lg shadow-md">
                <div class="flex justify-between mb-4">
                    <h1 class="text-3xl font-bold">
                        <span class="text-red-500 font-bold">{{ $post->category ?? 'Category' }}</span>:
                        {{ $post->title }}
                    </h1>

                    <div class="flex items-center justify-center gap-2">
                        <button
                            class="flex items-center gap-2 px-4 py-2 rounded-full border transition-all duration-200 ease-in-out">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 transition-transform duration-200 ease-in-out" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <span id="reactionCount"
                                class="font-medium">{{ $post->reactions ? $post->reactions->count() : 0 }}</span>
                        </button>
                    </div>
                </div>
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <a href="{{ route('author', ['user' => $post->user->id]) }}">
                            <img alt="Author Image" class="w-12 h-12 rounded-full"
                                src="{{ asset('storage/' . $post->user->profile_image) }}" />
                        </a>
                        <div class="ml-3">
                            <p class="text-sm font-bold">{{ $post->user->name }}</p>
                            <p class="text-xs text-gray-600">Published on {{ $post->created_at->format('F j, Y') }}</p>
                        </div>
                    </div>
                </div>
                <div>
                    {!! $post->content !!}
                </div>
            </article>

            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6444619677143056"
                crossorigin="anonymous"></script>
            <ins class="adsbygoogle" style="display:block; text-align:center;" data-ad-layout="in-article"
                data-ad-format="fluid" data-ad-client="ca-pub-6444619677143056" data-ad-slot="6030470771"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </main>
    </div>
</body>

</html>
