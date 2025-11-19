@extends('layouts.app')

@section('title', 'Add New Student')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white shadow-lg rounded-xl p-8">

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="text-2xl font-bold mb-6 text-gray-800">➕ Add New Student</h2>

    <form action="{{ route('posts.student') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div class="mb-5">
            <label class="block text-gray-600 font-medium mb-1">Full Name</label>
            <input 
                type="text" 
                name="name"
                value="{{ old('name') }}"
                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-300"
                placeholder="Enter student full name"
                required>
            @error('name')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Aadhaar -->
        <div class="mb-5">
            <label class="block text-gray-600 font-medium mb-1">Aadhaar Number</label>
            <input 
                type="text" 
                name="aadhaar"
                value="{{ old('aadhaar') }}"
                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-300"
                placeholder="12-digit Aadhaar number"
                required>
            @error('aadhaar')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Phone -->
        <div class="mb-5">
            <label class="block text-gray-600 font-medium mb-1">Phone Number</label>
            <input 
                type="text" 
                name="phone"
                value="{{ old('phone') }}"
                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-300"
                placeholder="10-digit phone number"
                required>
            @error('phone')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Class -->
        <div class="mb-5">
            <label class="block text-gray-600 font-medium mb-1">Class</label>
            <select 
                name="class" 
                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-300"
                required>
                <option value="">Select Class</option>
                @foreach(range(1,12) as $class)
                    <option value="{{ $class }}">{{ $class }}</option>
                @endforeach
            </select>
            @error('class')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Image -->
        <div class="mb-6">
            <label class="block text-gray-600 font-medium mb-1">Student Image</label>
            <input 
                type="file" 
                name="image"
                accept="image/*"
                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-300">

            @error('image')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button 
            type="submit"
            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg text-lg font-semibold">
            ✔ Add Student
        </button>

    </form>
</div>
@endsection
