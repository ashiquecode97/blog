@extends('layouts.app')

@section('title', 'Create New Post - My Blog')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8 fade-in">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Create New Post</h1>
        <p class="text-gray-600 text-lg">Share your thoughts and ideas with the world</p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 fade-in">
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-bold text-gray-700 mb-2">
                    Post Title <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="title" 
                       name="title" 
                       value="{{ old('title') }}"
                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('title') border-red-500 @enderror"
                       placeholder="Enter an engaging title..."
                       required>
                @error('title')
                    <p class="text-red-500 text-sm mt-2 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Excerpt -->
            <div>
                <label for="excerpt" class="block text-sm font-bold text-gray-700 mb-2">
                    Excerpt (Optional)
                </label>
                <input type="text" 
                       id="excerpt" 
                       name="excerpt" 
                       value="{{ old('excerpt') }}"
                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('excerpt') border-red-500 @enderror"
                       placeholder="A brief summary of your post (auto-generated if left empty)">
                <p class="text-gray-500 text-sm mt-1">This will appear in post previews</p>
                @error('excerpt')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Content -->
            <div>
                <label for="content" class="block text-sm font-bold text-gray-700 mb-2">
                    Content <span class="text-red-500">*</span>
                </label>
                <textarea id="content" 
                          name="content" 
                          rows="16"
                          class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition font-mono @error('content') border-red-500 @enderror"
                          placeholder="Write your amazing content here..."
                          required>{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-2 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Featured Image Upload -->
            <div class="bg-gray-50 rounded-lg p-6 border-2 border-dashed border-gray-300">
                <label class="block text-sm font-bold text-gray-700 mb-3">
                    Featured Image
                </label>
                
                <!-- Image Upload -->
                <div class="mb-4">
                    <label for="featured_image" class="block text-sm text-gray-600 mb-2">
                        📤 Upload Image (JPEG, PNG, GIF, WebP - Max 2MB)
                    </label>
                    <input type="file" 
                           id="featured_image" 
                           name="featured_image" 
                           accept="image/*"
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('featured_image') border-red-500 @enderror"
                           onchange="previewImage(event)">
                    @error('featured_image')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image Preview -->
                <div id="imagePreview" class="hidden mb-4">
                    <p class="text-sm text-gray-600 mb-2">Preview:</p>
                    <img id="preview" src="" alt="Preview" class="max-w-full h-48 object-cover rounded-lg shadow-md">
                </div>

                <!-- OR Divider -->
                {{-- <div class="flex items-center my-4">
                    <div class="flex-1 border-t border-gray-300"></div>
                    <span class="px-4 text-sm text-gray-500">OR</span>
                    <div class="flex-1 border-t border-gray-300"></div>
                </div>

                <!-- Image URL -->
                <div>
                    <label for="image_url" class="block text-sm text-gray-600 mb-2">
                        🔗 Use Image URL (e.g., from Unsplash, Pexels)
                    </label>
                    <input type="url" 
                           id="image_url" 
                           name="image_url" 
                           value="{{ old('image_url') }}"
                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                           placeholder="https://example.com/image.jpg">
                    <p class="text-gray-500 text-xs mt-1">Upload takes priority over URL if both are provided</p>
                    @error('image_url')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div> --}}
            </div>

            <!-- Publish Checkbox -->
            <div class="bg-blue-50 border-2 border-blue-200 rounded-lg p-4">
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" 
                           name="is_published" 
                           value="1"
                           {{ old('is_published') ? 'checked' : '' }}
                           class="w-6 h-6 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500 cursor-pointer">
                    <span class="ml-3">
                        <span class="text-sm font-bold text-gray-700 block">Publish immediately</span>
                        <span class="text-sm text-gray-600">Make this post visible to everyone</span>
                    </span>
                </label>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('posts.index') }}" 
                   class="inline-flex items-center text-gray-600 hover:text-gray-800 font-semibold transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Cancel
                </a>
                <button type="submit" 
                        class="inline-flex items-center bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-lg hover:shadow-xl font-bold text-lg transition transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Create Post
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('imagePreview').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    } else {
        document.getElementById('imagePreview').classList.add('hidden');
    }
}
</script>
@endsection