@extends('layouts.app')

@section('title', $post->title . ' - My Blog')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <article class="bg-white rounded-2xl shadow-2xl overflow-hidden fade-in">
        @if($post->image_url)
        <div class="h-96 overflow-hidden">
            <img src="{{ $post->image_url }}" 
                 alt="{{ $post->title }}" 
                 class="w-full h-full object-cover">
        </div>
        @endif  
        
        <div class="p-8 md:p-12">
            <!-- Meta Info -->
            <div class="mb-6 flex items-center justify-between flex-wrap gap-4">
                <div class="flex items-center text-gray-600 space-x-4">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                        </svg>
                        {{ $post->published_at->format('F d, Y') }}
                    </span>
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        {{ ceil(str_word_count($post->content) / 200) }} min read
                    </span>
                </div>
                <div class="flex items-center space-x-2">
                    <a href="{{ route('posts.edit', $post->slug) }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit
                    </a>
                    <form action="{{ route('posts.destroy', $post->slug) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            <!-- Title -->
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                {{ $post->title }}
            </h1>

            <!-- Excerpt -->
            @if($post->excerpt)
            <div class="text-xl text-gray-600 mb-8 pb-8 border-b border-gray-200 italic">
                {{ $post->excerpt }}
            </div>
            @endif

            <!-- Content -->
            <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed">
                {!! nl2br(e($post->content)) !!}
            </div>
        </div>
    </article>

    <!-- Navigation -->
    <div class="mt-8 flex justify-between items-center">
        <a href="{{ route('posts.index') }}" 
           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to all posts
        </a>
        <a href="{{ route('posts.create') }}" 
           class="inline-flex items-center bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-lg hover:shadow-lg font-semibold transition transform hover:scale-105">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Write New Post
        </a>
    </div>
</div>
@endsection