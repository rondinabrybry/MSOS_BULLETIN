@props(['pageTitle' => config('app.name', 'Laravel')])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="google-adsense-account" content="ca-pub-6444619677143056">
        <meta name="description" content="{{ $metaDescription ?? 'Explore the latest news, academic programs, student resources, and campus life at Cebu Technological University - Danao Campus. Stay informed about admissions, scholarships, events, and opportunities for student success in a vibrant university community' }}">
        <meta name="keywords" content="{{ $metaKeywords ?? 'university, higher education, college life, campus, academic programs, student resources, faculty, research, scholarships, admissions, university news, student success, study tips, campus events, degree programs, online courses, university rankings, international students, student organizations, alumni, university community, career services, campus facilities, financial aid, student engagement, academic excellence, student support, university events, campus culture, educational opportunities, university guide, study abroad, university life, campus tours, student housing, university admissions process' }}">
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">  
        <meta property="fb:app_id" content="1928575444318418">
        <title>MSOS | {{ $pageTitle }}</title>


        <!-- Fonts -->
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Quill Editor -->
        <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
        <script src="{{ asset('js/image-resize.min.js') }}"></script>
        
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }
        </style>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
