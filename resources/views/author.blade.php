@php
$pageTitle = $user->name;
@endphp

<x-app-layout :pageTitle="$pageTitle">
    <main class="container mx-auto mt-8">
        <!-- Author Profile Section -->
        <div class="bg-white px-6 py-6 rounded-lg shadow-md">
            <div class="flex items-center mb-4">
                <img alt="Author Image" class="w-16 h-16 rounded-full"
                    src="{{ asset('storage/' . $user->profile_image) }}" />
                <div class="ml-4">
                    <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
                    <p class="text-sm text-gray-600">Joined {{ $user->created_at->format('F j, Y') }}</p>
                    <p class="text-sm text-gray-600">Total Articles: {{ $posts->count() }}</p>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-xl font-bold mb-4">Articles by {{ $user->name }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($posts as $post)
                    <div class="bg-gray-200 rounded-lg shadow-md p-4">
                        <a href="{{ route('article', ['post' => $post->id]) }}">
                            <img alt="Article Image" class="rounded-lg w-full h-48 object-cover mb-2"
                                src="{{ asset('storage/' . $post->cover_photo) }}" />
                            <h3 class="text-lg font-bold">{{ $post->title }}</h3>
                        </a>
                        <p class="text-sm text-gray-600">{{ $post->created_at->format('F j, Y') }}</p>
                    </div>
                @endforeach
            </div>
        
        </div>
        
        </div>
    </main>
</x-app-layout>
