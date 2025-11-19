@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white shadow-lg rounded-xl p-8">

    <h2 class="text-2xl font-bold mb-6 text-gray-800">✏️ Edit Student</h2>

    <form action="{{ route('student.update', $student->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-5">
            <label class="block text-gray-600 font-medium mb-1">Full Name</label>
            <input 
                type="text" 
                name="name"
                value="{{ old('name', $student->name) }}"
                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-300"
                required>
            @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Aadhaar -->
        <div class="mb-5">
            <label class="block text-gray-600 font-medium mb-1">Aadhaar Number</label>
            <input 
                type="text" 
                name="aadhaar"
                value="{{ old('aadhaar', $student->aadhaar) }}"
                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-300"
                required>
            @error('aadhaar') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Phone -->
        <div class="mb-5">
            <label class="block text-gray-600 font-medium mb-1">Phone Number</label>
            <input 
                type="text" 
                name="phone"
                value="{{ old('phone', $student->phone) }}"
                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-300"
                required>
            @error('phone') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Class -->
        <div class="mb-5">
            <label class="block text-gray-600 font-medium mb-1">Class</label>
            <select 
                name="class" 
                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-300"
                required>
                @foreach(range(1,12) as $class)
                    <option value="{{ $class }}" 
                        {{ $student->class == $class ? 'selected' : '' }}>
                        {{ $class }}
                    </option>
                @endforeach
            </select>
            @error('class') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Existing Image Preview -->
        <div class="mb-5">
            <label class="block text-gray-600 font-medium mb-2">Current Image</label>

            @if($student->image)
                <img src="{{ asset('storage/' . $student->image) }}" 
                     class="w-24 h-24 rounded-lg object-cover border mb-2">
            @else
                <p class="text-gray-500 italic">No image available</p>
            @endif
        </div>

        <!-- New Image -->
        <div class="mb-6">
            <label class="block text-gray-600 font-medium mb-1">Upload New Image</label>
            <input 
                type="file" 
                name="image"
                accept="image/*"
                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-300">
            @error('image') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <!-- Submit -->
        <button 
            type="submit"
            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg text-lg font-semibold">
            ✔ Update Student
        </button>

    </form>
</div>
@endsection
