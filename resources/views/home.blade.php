@extends('layouts.app')

@section('title', 'Home - My Blog')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Hero Section with Weather -->
    <div class="bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 rounded-2xl shadow-2xl p-8 md:p-12 mb-12 text-white fade-in">
        <div class="flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="flex-1">
                <h1 class="text-4xl md:text-6xl font-bold mb-4 leading-tight">
                    Welcome to <span class="text-yellow-300">MyBlog</span>
                </h1>
                <p class="text-xl md:text-2xl opacity-90 mb-6">
                    Discover amazing stories, insights, and ideas that inspire.
                </p>
                <a href="{{ route('posts.index') }}" 
                   class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition transform hover:scale-105 shadow-lg">
                    Explore Posts →
                </a>
            </div>
            
            <!-- Weather Widget -->
            <div class="w-full md:w-auto">
                @if($weather)
                <div class="bg-white/20 backdrop-blur-lg rounded-2xl p-6 min-w-[280px] shadow-xl border border-white/30">
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <p class="text-sm opacity-80 mb-1">📍 {{ $weather['city'] }}</p>
                            <p class="text-5xl font-bold">{{ $weather['temperature'] }}°C</p>
                        </div>
                        <img src="https://openweathermap.org/img/wn/{{ $weather['icon'] }}@4x.png" 
                             alt="Weather icon" 
                             class="w-24 h-24">
                    </div>
                    <p class="capitalize text-lg mb-4 font-medium">{{ $weather['description'] }}</p>
                    <div class="flex justify-between text-sm bg-white/10 rounded-lg p-3">
                        <div class="text-center">
                            <p class="opacity-80 mb-1">Humidity</p>
                            <p class="font-bold text-lg">💧 {{ $weather['humidity'] }}%</p>
                        </div>
                        <div class="text-center">
                            <p class="opacity-80 mb-1">Wind</p>
                            <p class="font-bold text-lg">💨 {{ $weather['wind_speed'] }} m/s</p>
                        </div>
                    </div>
                </div>
                @else
                <div class="bg-white/20 backdrop-blur-lg rounded-2xl p-6 min-w-[280px] shadow-xl border border-white/30">
                    <div class="text-center">
                        <p class="text-4xl mb-3">🌤️</p>
                        <p class="text-lg mb-2">Weather Unavailable</p>
                        <p class="text-sm opacity-80">Add your API key to .env</p>
                        <p class="text-xs mt-3 opacity-70">WEATHER_API_KEY</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Latest Posts Section -->
    <div class="mb-12">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Latest Posts</h2>
            <a href="{{ route('posts.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold flex items-center">
                View All <span class="ml-2">→</span>
            </a>
        </div>
        
        @if($posts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
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
        
        <div class="text-center mt-12">
            <a href="{{ route('posts.index') }}" 
               class="inline-block bg-gradient-to-r from-blue-600 to-purple-600 text-white px-10 py-4 rounded-lg hover:shadow-xl font-semibold text-lg transition transform hover:scale-105">
                Explore All Posts
            </a>
        </div>
        @else
        <div class="bg-white rounded-2xl shadow-lg p-12 text-center fade-in">
            <div class="text-6xl mb-6">📝</div>
            <h3 class="text-2xl font-bold text-gray-900 mb-3">No Posts Yet</h3>
            <p class="text-gray-600 mb-6 text-lg">Be the first to share your story with the world!</p>
            <a href="{{ route('posts.create') }}" 
               class="inline-block bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-lg hover:shadow-xl font-semibold transition transform hover:scale-105">
                Create First Post
            </a>
        </div>
        @endif
    </div>

    <!-- Call to Action -->
    <div class="bg-gradient-to-r from-gray-800 to-gray-900 rounded-2xl shadow-2xl p-8 md:p-12 text-white text-center fade-in">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Share Your Story</h2>
        <p class="text-xl opacity-90 mb-6 max-w-2xl mx-auto">
            Have something interesting to share? Join our community and start writing today.
        </p>
        <a href="{{ route('posts.create') }}" 
           class="inline-block bg-white text-gray-900 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition transform hover:scale-105 shadow-lg text-lg">
            Start Writing
        </a>
    </div>
</div>
@endsection