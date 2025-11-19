@extends('layouts.app')

@section('title', 'Student Profile')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white shadow-xl rounded-xl p-8">

    <div class="flex items-center gap-6">
        <!-- Student Image -->
        @if($student->image)
            <img src="{{ asset('storage/' . $student->image) }}" 
                 class="w-28 h-28 rounded-full object-cover border shadow">
        @else
            <div class="w-28 h-28 bg-gray-200 rounded-full flex items-center justify-center">
                <span class="text-gray-500">No Image</span>
            </div>
        @endif

        <div>
            <h2 class="text-3xl font-bold text-gray-800">{{ $student->name }}</h2>
            <p class="text-gray-500">Class: {{ $student->class }}</p>
        </div>
    </div>

    <hr class="my-6">

    <!-- Details -->
    <p class="text-lg"><strong>Aadhaar:</strong> {{ $student->aadhaar }}</p>
    <p class="text-lg"><strong>Phone:</strong> {{ $student->phone }}</p>

    <!-- Buttons -->
    <div class="mt-6 flex gap-3">
        <a href="{{ route('student.edit', $student->id) }}"
           class="px-5 py-2 bg-blue-600 text-white rounded-lg">Edit</a>

        <a href="{{ route('student.list') }}"
           class="px-5 py-2 bg-gray-600 text-white rounded-lg">Back</a>
    </div>

</div>
@endsection
