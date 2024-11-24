@php
    $pageTitle = $post->title;
@endphp

<x-app-layout :pageTitle="$pageTitle">
    <main class="container mx-auto mt-8 w-full lg:w-3/4">
        <article class="bg-white px-6 py-6 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold mb-4">
                <span class="text-red-500 font-bold">{{ $post->category ?? 'Category' }}</span>: {{ $post->title }}
            </h1>
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
                @if (auth()->check() && auth()->user()->id == $post->user->id)
                    <button onclick="openEditModal()" class="text-blue-500 text-sm">Edit Post</button>
                @endif
            </div>
            <div>
                <link href="https://cdn.quilljs.com/1.2.2/quill.snow.css" rel="stylesheet">
                {!! $post->content !!}
            </div>
        </article>

        
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

    <div id="editModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-[80%] h-[80%] flex">
            <form action="{{ route('posts.update', $post->id) }}" method="POST" id="editPostForm"
                enctype="multipart/form-data" class="flex flex-grow">
                @csrf
                @method('PUT')

                <div class="w-1/3 p-6 flex flex-col gap-4 border-r">
                    
                    <div>
                        <x-input-label for="category" :value="__('Category')" />
                        <select id="category" name="category"
                            class="p-2 text-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                            required>
                            <option value="Not Classified" {{ $post->category == 'Not Classified' ? 'selected' : '' }}>
                                Not Classified</option>
                            <option value="Merch" {{ $post->category == 'Merch' ? 'selected' : '' }}>Merch</option>
                            <option value="Campus" {{ $post->category == 'Campus' ? 'selected' : '' }}>Campus</option>
                            <option value="Organization" {{ $post->category == 'Organization' ? 'selected' : '' }}>
                                Organization</option>
                            <option value="Research" {{ $post->category == 'Research' ? 'selected' : '' }}>Research
                            </option>
                            <option value="Events" {{ $post->category == 'Events' ? 'selected' : '' }}>Events</option>
                            <option value="Sports" {{ $post->category == 'Sports' ? 'selected' : '' }}>Sports</option>
                            <option value="Environment" {{ $post->category == 'Environment' ? 'selected' : '' }}>
                                Environment</option>
                            <option value="Technology" {{ $post->category == 'Technology' ? 'selected' : '' }}>
                                Technology</option>
                        </select>
                    </div>

                    
                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input type="text" id="title" name="title" value="{{ $post->title }}"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            required />
                    </div>

                    
                    <div>
                        <x-input-label for="cover_photo" :value="__('Cover Photo')" />
                        <input type="file" id="cover_photo" name="cover_photo" accept="image/*"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            onchange="previewCoverPhoto(event)">
                        <img id="coverPreview" class="mt-4 rounded-md shadow-md max-w-full"
                            src="{{ asset('storage/' . $post->cover_photo) }}" />
                    </div>

                    
                    <div class="flex justify-between mt-auto">
                        <button type="button" onclick="closeEditModal()"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 px-4 rounded-lg">
                            Cancel
                        </button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg">
                            Save
                        </button>
                    </div>
                </div>

                
                <div class="w-2/3 p-6 flex flex-col">
                    <x-input-label for="editor" :value="__('Content')" />
                    <div id="editor" class="mt-3 p-2 border rounded-lg overflow-y-auto flex-grow">
                        {!! $post->content !!}
                    </div>
                    <input type="hidden" id="content" name="content">
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewCoverPhoto(event) {
            const file = event.target.files[0];
            const coverPreview = document.getElementById('coverPreview');

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    coverPreview.src = e.target.result;
                    coverPreview.classList.remove('hidden');
                }

                reader.readAsDataURL(file);
            } else {
                // If no file is selected, show the original image
                coverPreview.src = "{{ asset('storage/' . $post->cover_photo) }}";
            }
        }

        function openEditModal() {
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
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
                imageResize: {},
                toolbar: toolbarOptions,
                clipboard: {
                    matchVisual: false
                }
            }
        });


        quill.clipboard.dangerouslyPasteHTML({!! json_encode($post->content) !!});

        document.getElementById('editPostForm').addEventListener('submit', function(e) {
            e.preventDefault();

            var quillContent = quill.root.innerHTML;
            console.log('Quill Content:', quillContent);
            document.getElementById('content').value = quillContent;

            var formData = new FormData(this);

            fetch('{{ route('posts.update', $post->id) }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.errors) {
                        console.log('Validation Errors:', data.errors);
                        alert('There were errors in your form.');
                    } else {
                        alert(data.message);
                        closeEditModal();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Check console for details.');
                });
        });
    </script>
</x-app-layout>
