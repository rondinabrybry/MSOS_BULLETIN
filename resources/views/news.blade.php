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

        <title>MSOS | News</title>
        <!-- Fonts -->
        <script src="https://cdn.tailwindcss.com"></script>
        
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
            <header class="bg-white shadow-md py-4 flex flex-col md:flex-row justify-between items-center mb-8">
                <div class="container mx-auto flex justify-between items-center px-4 w-full lg:w-3/4">
                    <a href="{{ route('login') }}">
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
                        <a href="{{ route('login') }}"
                        id="dropdownAvatarNameButton"
                        class="flex items-center cursor-pointer text-sm pe-1 font-medium text-gray-900 rounded-full hover:text-blue-600 dark:hover:text-blue-500 md:me-0 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-white">
                         <p class="text-black">Login</p>
                    </a>
                    </div>
                </div>
            </header>
            

            <main>

                    <main class="container mx-auto mt-8 w-full lg:w-3/4">
                        <style>
                            .hide-scrollbar {
                                -ms-overflow-style: none;
                                scrollbar-width: none;
                            }
                
                            .hide-scrollbar::-webkit-scrollbar {
                                display: none;
                            }
                
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
                        </style>
                
                        <section class="bg-white px-6 py-6 pb-2 rounded-lg shadow-md overflow-hidden">

                
                            <div id="horizontalScrollContainer" class="flex space-x-4 overflow-x-auto pb-4 hide-scrollbar">
                                @if($posts->isEmpty())
                                    <div class="w-full text-center py-4 text-lg text-gray-600">
                                        No posts available.
                                    </div>
                                @else
                                    @foreach ($posts as $post)
                                        <div class="bg-gray-200 rounded-lg shadow-md flex-shrink-0 h-[295px] w-[300px] relative">
                                            <div
                                                class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-md shadow-md">
                                                {{ $post->category ?? 'Category' }}
                                            </div>
                            
                                            <div class="absolute bottom-[115px] right-1 bg-white rounded-lg text-gray-700 font-bold px-2 py-1 shadow-md">
                                                <p class="text-[10px]">Last update: {{ $post->updated_at->diffForHumans() }}</p>
                                            </div>
                
                            
                                            <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                                                <img alt="News Image" class="rounded-t-lg w-full h-[185px] object-cover"
                                                    src="{{ asset('storage/' . $post->cover_photo) }}" />
                                                <div class="p-2">
                                                    <h1 class="text-2xl font-bold truncate">{{ $post->title }}</h1>
                                                </div>
                                            </a>
                            
                                            <a href="{{ route('author', ['user' => $post->user->id]) }}">
                                                <div class="bg-white w-[290px] py-2 px-4 rounded-lg w-full flex mx-auto items-center">
                                                    <img alt="Author Image" class="w-10 h-10 rounded-full"
                                                        src="{{ asset('storage/' . $post->user->profile_image) }}" />
                                                    <div class="ml-2">
                                                        <p class="text-sm font-bold">{{ $post->user->name }}</p>
                                                        <p class="text-xs text-gray-600">{{ $post->created_at->format('M j, Y') }} · <span class="text-[10px]">{{ $post->created_at->diffForHumans() }}</span></p>
                                                    </div>
                                                    <i class="fas fa-arrow-right ml-auto mr-4 text-gray-600"></i>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                    @if($posts->count() >= 5)
                                    <div class="flex justify-center mt-4">
                                        <a href="{{ route('posts.view-more') }}" class="bg-blue-600 text-white py-2 px-6 text-center m-auto rounded-lg w-[200px]">
                                            View More
                                        </a>
                                    </div>
                                    @endif
                                @endif
                            
                
                            </div>
                            
                
                        </section>
                <style>
                    .category-section {
                    margin-bottom: 20px;
                }
                
                .category-title {
                    font-size: 1.25rem;
                    font-weight: bold;
                }
                
                .post-item {
                    background: #f9f9f9;
                    padding: 10px;
                    margin-bottom: 10px;
                    border-radius: 5px;
                }
                
                .post-item {
                    position: relative;
                    max-width: 200px;
                    height: 150px;
                    overflow: hidden;
                }
                
                .below {
                    position: absolute;
                    bottom: 0;
                    left: 0;
                    right: 0;
                    background: linear-gradient(to top, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0));
                    padding: 10px;
                }
                    </style>
                    
                <section class="mt-2 mb-4">
                    <div class="w-full">
                        <img alt="Group of people working together" class="rounded-lg w-full object-cover"
                            src="{{ asset('storage/img/banner.png') }}" />
                    </div>
                </section>
                
                @foreach ($postsGroupedByCategory as $category => $posts)
                    @if ($posts->isNotEmpty())
                        <div class="category-section px-6">
                            <h3 class="category-title">{{ $category }}</h3>
                
                            <div class="relative">
                                
                                <button 
                                    class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-black/80 text-white p-2 rounded-full z-10 prev-btn touch-manipulation"
                                    aria-label="Previous posts"
                                >
                                    &#60;
                                </button>
                
                                <div class="overflow-x-auto no-scrollbar">
                                    <div class="flex gap-4 min-w-min px-4">
                                        @foreach ($posts as $post)
                                            <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="post-link flex-shrink-0">
                                                <div class="post-item w-[200px] h-[150px] relative">
                                                    <img 
                                                        src="{{ asset('storage/' . $post->cover_photo) }}" 
                                                        alt="{{ $post->user->name }}" 
                                                        class="object-cover w-full h-full rounded-lg"
                                                    >
                                                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black p-2 rounded-b-lg">
                                                        <div class="truncate">
                                                            <h4 class="font-bold text-white truncate">{{ $post->title }}</h4>
                                                            <p class="text-[10px] text-white">
                                                                {{ $post->user->name }} · 
                                                                <span class="text-[8px]">{{ $post->created_at->diffForHumans() }}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                
                                
                                <button 
                                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-black/80 text-white p-2 rounded-full z-10 next-btn touch-manipulation"
                                    aria-label="Next posts"
                                >
                                    &#62;
                                </button>
                            </div>
                        </div>
                    @endif
                @endforeach
                
                <style>
                .no-scrollbar {
                    -ms-overflow-style: none;
                    scrollbar-width: none;
                }
                
                .no-scrollbar::-webkit-scrollbar {
                    display: none;
                }
                
                
                @media (max-width: 768px) {
                    .prev-btn, .next-btn {
                        width: 40px;
                        height: 40px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 18px;
                        background-color: rgba(0, 0, 0, 0.8);
                        -webkit-tap-highlight-color: transparent;
                        touch-action: manipulation;
                    }
                
                    
                    .prev-btn::before, .next-btn::before {
                        content: '';
                        position: absolute;
                        top: -10px;
                        bottom: -10px;
                        left: -10px;
                        right: -10px;
                    }
                }
                
                
                .prev-btn:active, .next-btn:active {
                    background-color: rgba(0, 0, 0, 1);
                    transform: translateY(-50%) scale(0.95);
                }
                </style>
                
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const sections = document.querySelectorAll('.category-section');
                    
                    sections.forEach(section => {
                        const scrollContainer = section.querySelector('.overflow-x-auto');
                        const prevBtn = section.querySelector('.prev-btn');
                        const nextBtn = section.querySelector('.next-btn');
                        
                        if (!prevBtn || !nextBtn || !scrollContainer) return;
                
                
                        const updateButtonVisibility = () => {
                            const isAtStart = scrollContainer.scrollLeft <= 0;
                            const isAtEnd = scrollContainer.scrollLeft + scrollContainer.clientWidth >= scrollContainer.scrollWidth - 1;
                            
                            prevBtn.style.opacity = isAtStart ? '0.3' : '1';
                            nextBtn.style.opacity = isAtEnd ? '0.3' : '1';
                            prevBtn.disabled = isAtStart;
                            nextBtn.disabled = isAtEnd;
                        };
                
                
                        const getScrollDistance = () => {
                            return window.innerWidth <= 768 ? 210 : 420;
                        };
                
                
                        const handleButtonClick = (direction) => {
                            const distance = getScrollDistance();
                            const targetScroll = scrollContainer.scrollLeft + (direction * distance);
                            
                            scrollContainer.scrollTo({
                                left: targetScroll,
                                behavior: 'smooth'
                            });
                        };
                
                
                        prevBtn.addEventListener('click', (e) => {
                            e.preventDefault();
                            e.stopPropagation();
                            if (!prevBtn.disabled) {
                                handleButtonClick(-1);
                            }
                        });
                
                        nextBtn.addEventListener('click', (e) => {
                            e.preventDefault();
                            e.stopPropagation();
                            if (!nextBtn.disabled) {
                                handleButtonClick(1);
                            }
                        });
                
                
                        let touchStartX = 0;
                        let touchStartScrollLeft = 0;
                        let isTouching = false;
                
                        scrollContainer.addEventListener('touchstart', (e) => {
                            isTouching = true;
                            touchStartX = e.touches[0].pageX;
                            touchStartScrollLeft = scrollContainer.scrollLeft;
                        }, { passive: true });
                
                        scrollContainer.addEventListener('touchmove', (e) => {
                            if (!isTouching) return;
                            const touchDelta = touchStartX - e.touches[0].pageX;
                            scrollContainer.scrollLeft = touchStartScrollLeft + touchDelta;
                        }, { passive: true });
                
                        scrollContainer.addEventListener('touchend', () => {
                            isTouching = false;
                        }, { passive: true });
                
                
                        scrollContainer.addEventListener('scroll', updateButtonVisibility);
                        window.addEventListener('resize', updateButtonVisibility);
                        
                        
                        updateButtonVisibility();
                    });
                });
                </script>
                
                
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6444619677143056"
                crossorigin="anonymous"></script>
                <!-- responsive -->
                <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-6444619677143056"
                    data-ad-slot="9969715782"
                    data-ad-format="auto"
                    data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                
                
                    </main>
                
        
                    
                
                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            const scrollContainer = document.getElementById("horizontalScrollContainer");
                
                            if (scrollContainer) {
                                scrollContainer.addEventListener("wheel", (event) => {
                                    event.preventDefault();
                                    scrollContainer.scrollLeft += event.deltaY;
                                });
                            }
                        });
                    </script>
                
               
                
                
                
            </main>
        </div>
    </body>
</html>
