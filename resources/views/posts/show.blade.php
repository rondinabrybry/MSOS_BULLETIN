<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-adsense-account" content="ca-pub-6444619677143056">
    <meta name="description" content="{{ $metaDescription ?? 'Explore the latest news, academic programs, student resources, and campus life at Cebu Technological University - Danao Campus. Stay informed about admissions, scholarships, events, and opportunities for student success in a vibrant university community' }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'university, higher education, college life, campus, academic programs, student resources, faculty, research, scholarships, admissions, university news, student success, study tips, campus events, degree programs, online courses, university rankings, international students, student organizations, alumni, university community, career services, campus facilities, financial aid, student engagement, academic excellence, student support, university events, campus culture, educational opportunities, university guide, study abroad, university life, campus tours, student housing, university admissions process' }}">
    
    
    <meta property="fb:app_id" content="1928575444318418" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $post->title }}" />
    <meta property="og:description" content="{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 200) }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ asset('storage/' . $post->cover_photo) }}" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:site_name" content="MSOS Bulletin" />
    

    
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>MSOS | News</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
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
            <article class="bg-white px-6 py-6 mx-auto rounded-lg shadow-md max-w-5xl">
                <div class="flex justify-between mb-4">
                    <h1 class="text-xl font-bold">
                        <span class="text-red-500 font-bold">{{ $post->category ?? 'Category' }}</span>
                    </h1>

                    <div class="flex items-center justify-center gap-2">
                        <a href="{{ route('login') }}">
                            <button
                                class="flex items-center gap-2 px-4 py-2 rounded-full border transition-all duration-200 ease-in-out text-xs">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 transition-transform duration-200 ease-in-out" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                <span id="reactionCount"
                                    class="font-medium">{{ $post->reactions ? $post->reactions->count() : 0 }}</span>
                            </button>
                        </a>

                        <button 
                        onclick="openShareModal({{ $post->id }})"
                        class="flex items-center text-xs gap-2 px-4 py-2 rounded-full border transition-all duration-200 ease-in-out bg-gray-50 border-gray-200 hover:bg-blue-50 hover:border-blue-200 hover:text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z" />
                        </svg>
                        <span class="font-medium">Share</span>
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
                <style>
                    #editor {
                        height: auto;
                        max-height: 24rem;
                        overflow-y: auto;
                        word-wrap: break-word;
                    }
            
                    .ql-image-resize-handle {
                        width: 16px;
                        height: 16px;
                        background-color: #007bff;
                        border-radius: 50%;
                        border: 2px solid #fff;
                        cursor: pointer;
                        touch-action: none;
                    }
            
                    .ql-image-resize-overlay {
                        border: 2px solid rgba(0, 123, 255, 0.5);
                    }
                    .ql-align-center {
                        text-align: center;
                    }
                    .ql-align-right {
                        float: right;
                    }
                    .ql-align-justify {
                        text-align: justify;
                        text-justify: inter-word;
                    }
                    .post-content a {
                        color: #007bff;
                    }
                    .post-content h1 {
                        font-size: 34px;
                    }
                    .post-content h2 {
                        font-size: 30px;
                    }
                    .post-content ol {
                        list-style-type: number;
                    }
    
                    .post-content ul {
                        list-style-type: disc;
                    }
                </style>
                <div class="whole-content px-4">
                    <h1 class="text-3xl font-bold mt-6 mb-4">
                        <span class="text-black font-bold">{{ $post->title }}</span>
                    </h1>
    
                    <hr>
    
                    <div class="post-content">
                        {!! $post->content !!}
                    </div>
                </div>
                <img alt="Author Image" class="w-12 h-12 rounded-full"
                src="{{ asset('storage/' . $post->cover_photo) }}" hidden/>
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
    <div id="shareModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z" />
                    </svg>
                </div>
                
                <h3 class="text-lg font-medium text-gray-900 mb-4">Share this post</h3>
                <div class="flex items-center justify-between bg-gray-100 p-3 rounded-lg mb-4">
                    <input type="text" id="shareUrl" class="bg-transparent flex-1 border-none focus:ring-0" readonly>
                    <button onclick="copyShareUrl()" class="ml-2 text-blue-600 hover:text-blue-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                    </button>
                </div>
    
                <button onclick="closeShareModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium">
                    Close
                </button>
            </div>
        </div>
    </div>
    
    <script>
    function openShareModal(postId) {
        const shareUrl = `https://bulletin.msoshub.com/posts/${postId}`;
        document.getElementById('shareUrl').value = shareUrl;
        document.getElementById('shareModal').classList.remove('hidden');
    }
    
    function closeShareModal() {
        document.getElementById('shareModal').classList.add('hidden');
    }
    
    function copyShareUrl() {
        const shareUrl = document.getElementById('shareUrl');
        shareUrl.select();
        document.execCommand('copy');
        
        // Show feedback
        const message = document.createElement('div');
        message.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in-out';
        message.textContent = 'Link copied to clipboard!';
        document.body.appendChild(message);
        
        setTimeout(() => message.remove(), 2000);
    }
    
    // Close modal when clicking outside
    document.getElementById('shareModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeShareModal();
        }
    });
    </script>

</body>

</html>
