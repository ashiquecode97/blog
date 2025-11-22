<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    // List students + search + filter
    public function index(Request $request)
    {
        $query = DB::table('students');

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%')
                  ->orWhere('aadhaar', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->class_filter) {
            $query->where('class', $request->class_filter);
        }

        $students = $query->orderBy('id', 'desc')->get();

        return view('student.index', compact('students'));
    }

    // Show create form
    public function create()
    {
        return view('student.create');
    }

    // Store new student
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'aadhaar' => 'required|digits:12|numeric',
            'phone' => 'required|digits:10|numeric',
            'class' => 'required|in:1,2,3,4,5,6,7,8,9,10,11,12',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();
            $imagePath = $image->storeAs('students', $imageName, 'public');
            $validated['image'] = $imagePath;
        }

        DB::table('students')->insert($validated);

        return redirect()->route('student.index')->with('success', 'Student Added Successfully!');
    }

    // Show profile
    public function show($id)
    {
        $student = DB::table('students')->where('id', $id)->first();

        if (!$student) {
            abort(404);
        }

        return view('student.view', compact('student'));
    }

    // Edit form
    public function edit($id)
    {
        $student = DB::table('students')->where('id', $id)->first();

        if (!$student) {
            abort(404);
        }

        return view('student.edit', compact('student'));
    }

    // Update student
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'aadhaar' => 'required|digits:12|numeric',
            'phone' => 'required|digits:10|numeric',
            'class' => 'required|in:1,2,3,4,5,6,7,8,9,10,11,12',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $student = DB::table('students')->where('id', $id)->first();

        if (!$student) {
            abort(404);
        }

        if ($request->hasFile('image')) {
            if ($student->image && str_starts_with($student->image, 'students/')) {
                Storage::disk('public')->delete($student->image);
            }

            $image = $request->file('image');
            $imageName = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();
            $imagePath = $image->storeAs('students', $imageName, 'public');
            $validated['image'] = $imagePath;
        }

        DB::table('students')->where('id', $id)->update($validated);

        return redirect()->route('student.index')->with('success', 'Student Updated Successfully!');
    }

    // Delete
    public function destroy($id)
    {
        $student = DB::table('students')->where('id', $id)->first();

        if ($student->image && str_starts_with($student->image, 'students/')) {
            Storage::disk('public')->delete($student->image);
        }

        DB::table('students')->where('id', $id)->delete();

        return redirect()->route('student.index')->with('success', 'Student Deleted Successfully!');
    }
}
