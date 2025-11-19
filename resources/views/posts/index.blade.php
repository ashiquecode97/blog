@extends('layouts.app')

@section('title', 'All Posts - My Blog')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-12 text-center fade-in">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">All Blog Posts</h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
            Explore our collection of articles, insights, and stories
        </p>
    </div>

    @if($posts->count() > 0)
    <!-- Posts Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        @foreach($posts as $post)
        <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 fade-in">
            @if($post->image_url)
            <div class="h-48 overflow-hidden">
                <img src="{{ $post->image_url }}" 
                     alt="{{ $post->title }}" 
                     class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
            </div>
            @else
            <div class="h-48 bg-gradient-to-br from-blue-400 via-purple-500 to-pink-500"></div>
            @endif
            
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                    <a href="{{ route('posts.show', $post->slug) }}" 
                       class="hover:text-blue-600 transition">
                        {{ $post->title }}
                    </a>
                </h3>
                <p class="text-gray-600 mb-4 line-clamp-3">{{ $post->excerpt }}</p>
                <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                    <span class="text-sm text-gray-500 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                        </svg>
                        {{-- {{ $post->published_at->format('M d, Y') }} --}}
                        {{ optional($post->published_at)->format('M d, Y') ?? 'Draft' }}

                    </span>
                    <a href="{{ route('posts.show', $post->slug) }}" 
                       class="text-blue-600 hover:text-blue-800 font-semibold text-sm flex items-center">
                        Read More 
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </article>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="flex justify-center">
        {{ $posts->links() }}
    </div>
    @else
    <!-- Empty State -->
    <div class="bg-white rounded-2xl shadow-lg p-12 text-center fade-in">
        <div class="text-6xl mb-6">📭</div>
        <h3 class="text-2xl font-bold text-gray-900 mb-3">No Posts Found</h3>
        <p class="text-gray-600 mb-6 text-lg">There are no published posts yet.</p>
        <a href="{{ route('posts.create') }}" 
           class="inline-block bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-lg hover:shadow-xl font-semibold transition transform hover:scale-105">
            Create Your First Post
        </a>
    </div>
    @endif
</div>
@endsection