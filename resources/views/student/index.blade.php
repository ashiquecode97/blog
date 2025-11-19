@extends('layouts.app')

@section('title', 'Student List')

@section('content')
<div class="max-w-6xl mx-auto mt-10">

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">📋 Student List</h2>

        <a href="{{ route('posts.studentForm') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg shadow">
            ➕ Add Student
        </a>
    </div>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                <form method="GET" action="{{ route('student.list') }}" class="mb-6 flex gap-3">

    <input type="text" 
           name="search"
           value="{{ request('search') }}"
           placeholder="Search by name, phone, Aadhaar"
           class="px-4 py-2 border rounded-lg w-1/2">

    <select name="class_filter" class="px-4 py-2 border rounded-lg">
        <option value="">All Classes</option>
        @foreach(range(1,12) as $class)
            <option value="{{ $class }}" 
                {{ request('class_filter') == $class ? 'selected' : '' }}>
                Class {{ $class }}
            </option>
        @endforeach
    </select>

    <button class="px-5 py-2 bg-indigo-600 text-white rounded-lg">Filter</button>
</form>

        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="py-3 px-4 text-gray-700 font-semibold">Image</th>
                    <th class="py-3 px-4 text-gray-700 font-semibold">Name</th>
                    <th class="py-3 px-4 text-gray-700 font-semibold">Aadhaar</th>
                    <th class="py-3 px-4 text-gray-700 font-semibold">Phone</th>
                    <th class="py-3 px-4 text-gray-700 font-semibold">Class</th>
                    <th class="py-3 px-4 text-gray-700 font-semibold text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($students as $student)
                    <tr class="border-b hover:bg-gray-50">
                        
                        <!-- Image -->
                        <td class="py-3 px-4">
                            @if($student->image)
                                <img src="{{ asset('storage/' . $student->image) }}" 
                                     class="w-12 h-12 rounded-full object-cover border">
                            @else
                                <span class="text-gray-400 italic">No Image</span>
                            @endif
                        </td>

                        <!-- Name -->
                        <td class="py-3 px-4 font-medium">{{ $student->name }}</td>

                        <!-- Aadhaar -->
                        <td class="py-3 px-4">{{ $student->aadhaar }}</td>

                        <!-- Phone -->
                        <td class="py-3 px-4">{{ $student->phone }}</td>

                        <!-- Class -->
                        <td class="py-3 px-4">{{ $student->class }}</td>

                        <!-- Actions -->
                        <td class="py-3 px-4 text-center">
                            <div class="flex justify-center gap-2">

                                <!-- Edit Button -->
                                <a href="{{ route('student.edit', $student->id) }}" 
                                   class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                    Edit
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('student.delete', $student->id) }}" 
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this student?');">
                                    @csrf
                                    @method('DELETE')

                                    <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>
@endsection
