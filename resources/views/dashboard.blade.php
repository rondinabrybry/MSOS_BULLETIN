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

            /* Optional: Ensure consistent layout and overflow for the editor */
            #editor {
                height: auto;
                max-height: 24rem;
                /* Adjustable max height for scrollability */
                overflow-y: auto;
                word-wrap: break-word;
            }
        </style>
        <section class="bg-white px-6 py-6 pb-2 rounded-lg shadow-md overflow-hidden">
            <div class="flex justify-between align-center">
                <h2 class="text-2xl font-bold mb-4">Latest News</h2>

                <div class="flex mb-4">
                    <button class="bg-blue-600 text-white py-2 px-4 rounded-lg" onclick="openModal()">Create + </button>
                </div>
            </div>

            <div class="flex space-x-4 overflow-x-auto pb-4 hide-scrollbar">
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

        <section class="mt-2 mb-4">
            <div class="w-full">
                <img alt="Group of people working together" class="rounded-lg w-full object-cover"
                    src="{{ asset('storage/img/banner.png') }}" />
            </div>
        </section>
    </main>


    <div id="createModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-[80%] h-[80%] flex">
            <!-- Modal Header -->

            <!-- Modal Content -->
            <form action="" id="postForm" enctype="multipart/form-data" class="flex flex-grow">
                @csrf

                <!-- Left Panel -->
                <div class="w-1/3 p-6 flex flex-col gap-4 border-r">
                    <!-- Category Selection -->
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

                    <!-- Title Input -->
                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input type="text" id="title" name="title"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            required />
                    </div>

                    <!-- Cover Photo Input -->
                    <div>
                        <x-input-label for="cover_photo" :value="__('Cover Photo')" />
                        <input type="file" id="cover_photo" name="cover_photo" accept="image/*"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            onchange="displayImage(this)" required>
                        <img id="coverPreview" class="mt-4 hidden rounded-md shadow-md max-w-full" />
                    </div>

                    <!-- Action Buttons -->
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

                <!-- Right Panel -->
                <div class="w-2/3 p-6 flex flex-col">
                    <x-input-label for="editor" :value="__('Content')" />
                    <div id="editor" class="mt-3 p-2 border rounded-lg overflow-y-auto flex-grow">
                    </div>
                    <input type="hidden" id="content" name="content">
                </div>
            </form>
        </div>
    </div>



    <script>
        function displayImage(input) {
            const preview = document.getElementById('coverPreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden'); // Show image when selected
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
            ['blockquote', 'code-block'],
            ['link', 'image'],
            [{'script': 'sub'}, {'script': 'super'}],
            [{'font': ['serif', 'sans-serif', 'monospace', 'poppins']}],
            ['clean']
        ];
        var quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                imageResize: {},
                toolbar: toolbarOptions
            }
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
