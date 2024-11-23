@php
    $pageTitle = 'Dashboard';
@endphp

<x-app-layout :pageTitle="$pageTitle">

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
            <div class="flex justify-between align-center">
                <h2 class="text-2xl font-bold mb-4">Latest News</h2>
                @if (Auth::check() && Auth::user()->isAdminandSuper())
                <div class="flex mb-4">
                    <button class="bg-blue-600 text-white py-2 px-4 rounded-lg" onclick="openModal()">Create + </button>
                </div>
                @endif
            </div>

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

            
                            <a href="{{ route('article', ['post' => $post->id]) }}">
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
<!-- Display banner image -->
<section class="mt-2 mb-4">
    <div class="w-full">
        <img alt="Group of people working together" class="rounded-lg w-full object-cover"
            src="{{ asset('storage/img/banner.png') }}" />
    </div>
</section>

@foreach ($postsGroupedByCategory as $category => $posts)
    @if ($posts->isNotEmpty())
        <div class="category-section mb-2 p-6">
            <h3 class="category-title">{{ $category }}</h3>

            <div class="relative">
                <!-- Previous Button -->
                <button 
                    class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black text-white p-2 rounded-full z-10 prev-btn"
                    aria-label="Previous posts"
                >
                    &#60;
                </button>

                <div class="overflow-x-auto no-scrollbar">
                    <div class="flex gap-4 min-w-min px-4">
                        @foreach ($posts as $post)
                            <a href="{{ route('article', ['post' => $post->id]) }}" class="post-link flex-shrink-0">
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

                <!-- Next Button -->
                <button 
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black text-white p-2 rounded-full z-10 next-btn"
                    aria-label="Next posts"
                >
                    &#62;
                </button>
            </div>
        </div>
    @endif
@endforeach

<style>
/* Hide scrollbar but keep functionality */
.no-scrollbar {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;     /* Firefox */
}

.no-scrollbar::-webkit-scrollbar {
    display: none;  /* Chrome, Safari and Opera */
}

/* Ensure buttons are more visible and tappable on mobile */
@media (max-width: 768px) {
    .prev-btn, .next-btn {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(0, 0, 0, 1);
        touch-action: manipulation;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('.category-section');
    
    sections.forEach(section => {
        const scrollContainer = section.querySelector('.overflow-x-auto');
        const prevBtn = section.querySelector('.prev-btn');
        const nextBtn = section.querySelector('.next-btn');
        
        if (prevBtn && nextBtn && scrollContainer) {
            // Update button visibility based on scroll position
            const updateButtonVisibility = () => {
                const isAtStart = scrollContainer.scrollLeft === 0;
                const isAtEnd = scrollContainer.scrollLeft + scrollContainer.clientWidth >= scrollContainer.scrollWidth;
                
                prevBtn.style.opacity = isAtStart ? '0.3' : '0.7';
                nextBtn.style.opacity = isAtEnd ? '0.3' : '0.7';
                
                prevBtn.style.cursor = isAtStart ? 'not-allowed' : 'pointer';
                nextBtn.style.cursor = isAtEnd ? 'not-allowed' : 'pointer';
            };

            // Scroll handling with touch-friendly distance
            const scrollDistance = window.innerWidth <= 768 ? 210 : 220; // Slightly less scroll on mobile

            prevBtn.addEventListener('click', () => {
                scrollContainer.scrollBy({
                    left: -scrollDistance,
                    behavior: 'smooth'
                });
            });

            nextBtn.addEventListener('click', () => {
                scrollContainer.scrollBy({
                    left: scrollDistance,
                    behavior: 'smooth'
                });
            });

            // Add touch scrolling for mobile
            let isDown = false;
            let startX;
            let scrollLeft;

            scrollContainer.addEventListener('mousedown', (e) => {
                isDown = true;
                startX = e.pageX - scrollContainer.offsetLeft;
                scrollLeft = scrollContainer.scrollLeft;
            });

            scrollContainer.addEventListener('touchstart', (e) => {
                isDown = true;
                startX = e.touches[0].pageX - scrollContainer.offsetLeft;
                scrollLeft = scrollContainer.scrollLeft;
            });

            scrollContainer.addEventListener('mouseleave', () => {
                isDown = false;
            });

            scrollContainer.addEventListener('mouseup', () => {
                isDown = false;
            });

            scrollContainer.addEventListener('touchend', () => {
                isDown = false;
            });

            scrollContainer.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - scrollContainer.offsetLeft;
                const walk = (x - startX) * 2;
                scrollContainer.scrollLeft = scrollLeft - walk;
            });

            scrollContainer.addEventListener('touchmove', (e) => {
                if (!isDown) return;
                const x = e.touches[0].pageX - scrollContainer.offsetLeft;
                const walk = (x - startX) * 2;
                scrollContainer.scrollLeft = scrollLeft - walk;
            });

            // Update button visibility on scroll and initial load
            scrollContainer.addEventListener('scroll', updateButtonVisibility);
            updateButtonVisibility();

            // Prevent button double-tap zoom on mobile
            prevBtn.addEventListener('touchend', (e) => e.preventDefault());
            nextBtn.addEventListener('touchend', (e) => e.preventDefault());
        }
    });
});
</script>


    </main>




    <div id="createModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl h-full max-h-[90%] sm:w-[90%] sm:h-[90%] md:w-[80%] lg:h-[80%] flex flex-col overflow-auto touch-manipulation">

            <form action="" id="postForm" enctype="multipart/form-data" class="flex flex-grow flex-col lg:flex-row">
                @csrf
    
                <div class="lg:w-1/3 p-4 sm:p-6 flex flex-col gap-4 border-r overflow-auto">
                    
                    <div>
                        <x-input-label for="category" :value="__('Category')" />
                        <select id="category" name="category"
                            class="p-2 text-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                            required>
                            <option value="Not Classified">Not Classified</option>
                            <option value="Merch">Merch</option>
                            <option value="Campus">Campus</option>
                            <option value="Organization">Organization</option>
                            <option value="Research">Research</option>
                            <option value="Events">Events</option>
                            <option value="Sports">Sports</option>
                            <option value="Environment">Environment</option>
                            <option value="Technology">Technology</option>
                        </select>
                    </div>
    
                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input type="text" id="title" name="title"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            required />
                    </div>
    
                    <div>
                        <x-input-label for="cover_photo" :value="__('Cover Photo')" />
                        <input type="file" id="cover_photo" name="cover_photo" accept="image/*"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            onchange="displayImage(this)" required>
                            <span class="text-xs text-gray-600">Best size 500x300 px</span>
                        <img id="coverPreview" class="mt-4 hidden rounded-md shadow-md max-w-full" />
                    </div>
    
                    <div class="flex justify-between mt-auto">
                        <button type="button" onclick="closeModal()"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 px-4 rounded-lg">
                            Cancel
                        </button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg">
                            Save
                        </button>
                    </div>
                </div>
    
                <div class="lg:w-2/3 p-4 sm:p-6 flex flex-col overflow-auto">
                    <x-input-label for="editor" :value="__('Content')" />
                    <div id="editor" class="mt-3 p-2 border rounded-lg overflow-y-auto flex-grow">
                    </div>
                    <input type="hidden" id="content" name="content">
                </div>
            </form>
        </div>
    </div>
    

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

    <script>
        function displayImage(input) {
            const preview = document.getElementById('coverPreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.classList.add('hidden');
            }
        }

        function openModal() {
            document.getElementById('createModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('createModal').classList.add('hidden');
        }
    </script>


    <script>
        const toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],
            ['image'],
            [{'script': 'sub'}, {'script': 'super'}],
            [{'font': ['serif', 'sans-serif', 'monospace', 'poppins']}],
            ['clean']
        ];
        

        var quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                imageResize: {
                    modules: ['Resize', 'DisplaySize', 'Toolbar'],
                    handleStyles: {
                        backgroundColor: 'blue',
                        borderRadius: '50%',
                        width: '12px',
                        height: '12px',
                    },
                },
                toolbar: toolbarOptions,
            },
        });
        document.getElementById('postForm').addEventListener('submit', function(e) {
            e.preventDefault();

            var content = quill.root.innerHTML;
            document.getElementById('content').value = content;

            var formData = new FormData(this);

            fetch('/posts', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                    },
                })
                .then(response => {
                    if (!response.ok) {
                        console.error(`HTTP Error: ${response.status} - ${response.statusText}`);
                        throw new Error('Failed to submit the form.');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.errors) {
                        console.log('Validation Errors:', data.errors);
                        alert('There were errors in your form.');
                    } else if (data.message) {
                        alert(data.message);
                        closeModal();
                    } else {
                        console.warn('Unexpected response:', data);
                        alert('An unexpected error occurred.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Check console for details.');
                });
        });

        function closeModal() {
            document.getElementById('createModal').classList.add('hidden');
        }
    </script>


</x-app-layout>
