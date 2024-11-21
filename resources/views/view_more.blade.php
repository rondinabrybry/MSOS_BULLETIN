<x-app-layout :pageTitle="'All Posts'">
    <main class="container mx-auto mt-8 w-full lg:w-3/4">
        <section class="bg-white px-6 py-6 rounded-lg shadow-md">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">All Posts</h2>

            <!-- Grid Container -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
                @foreach ($posts as $post)
                    <!-- Post Card -->
                    <div class="bg-gray-200 rounded-lg shadow-md flex-shrink-0 h-[310px] w-full relative">
                        <!-- Category Badge -->
                        <div
                            class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-md shadow-md">
                            {{ $post->category ?? 'Category' }}
                        </div>

                        <!-- Timestamp -->
                        <div
                            class="absolute bottom-[130px] right-2 bg-white rounded-lg text-gray-900 text-xs font-bold px-2 py-1 shadow-md">
                            {{ $post->created_at->diffForHumans() }}
                        </div>

                        <!-- Post Image and Title -->
                        <a href="{{ route('article', ['post' => $post->id]) }}">
                            <img alt="Post Image" class="rounded-t-lg w-full h-[185px] object-cover"
                                src="{{ asset('storage/' . $post->cover_photo) }}" />
                            <div class="p-2">
                                <h1 class="text-xl font-bold truncate">{{ $post->title }}</h1>
                            </div>
                        </a>

                        <!-- Author Section -->
                        <a href="{{ route('author', ['user' => $post->user->id]) }}">
                            <div class="bg-white w-full py-2 px-4 rounded-lg flex items-center mt-4">
                                <img alt="Author Image" class="w-10 h-10 rounded-full"
                                    src="{{ asset('storage/' . $post->user->profile_image) }}" />
                                <div class="ml-2">
                                    <p class="text-sm font-bold">{{ $post->user->name }}</p>
                                    <p class="text-xs text-gray-600">{{ $post->created_at->format('F j, Y') }}</p>
                                </div>
                                <i class="fas fa-arrow-right ml-auto mr-4 text-gray-600"></i>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Links -->
            <div class="mt-8 flex justify-center">
                {{ $posts->links('pagination::tailwind') }}
            </div>
            
        </section>
    </main>
</x-app-layout>
