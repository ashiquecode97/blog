<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::published()
            ->latest('published_at')
            ->paginate(9);

        return view('posts.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)
            ->published()
            ->firstOrFail();

        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_url' => 'nullable|url',
            'is_published' => 'boolean',
        ]);

        $validated['is_published'] = $request->has('is_published');
        $validated['published_at'] = $validated['is_published'] ? now() : null;

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('posts', $imageName, 'public');
            $validated['featured_image'] = $imagePath;
        } elseif ($request->filled('image_url')) {
            // Use URL if provided and no file uploaded
            $validated['featured_image'] = $request->image_url;
        }

        // Remove image_url from validated data as it's not in database
        unset($validated['image_url']);

        Post::create($validated);

        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully!');
    }

    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_url' => 'nullable|url',
            'is_published' => 'boolean',
        ]);

        $validated['is_published'] = $request->has('is_published');
        
        if ($validated['is_published'] && !$post->published_at) {
            $validated['published_at'] = now();
        }

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if it exists and is stored locally
            if ($post->featured_image && str_starts_with($post->featured_image, 'posts/')) {
                Storage::disk('public')->delete($post->featured_image);
            }

            $image = $request->file('featured_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('posts', $imageName, 'public');
            $validated['featured_image'] = $imagePath;
        } elseif ($request->filled('image_url')) {
            // Use URL if provided and no file uploaded
            $validated['featured_image'] = $request->image_url;
        }

        // Remove image_url from validated data
        unset($validated['image_url']);

        $post->update($validated);

        return redirect()->route('posts.show', $post->slug)
            ->with('success', 'Post updated successfully!');
    }

    public function destroy($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        
        // Delete image if it exists and is stored locally
        if ($post->featured_image && str_starts_with($post->featured_image, 'posts/')) {
            Storage::disk('public')->delete($post->featured_image);
        }
        
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully!');
    }


    public function studentForm()
{
    return view('student.create'); // NOT posts.create
}


public function student(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'aadhaar' => 'required|digits:12',
        'phone' => 'required|digits:10',
        'class' => 'required|in:1,2,3,4,5,6,7,8,9,10,11,12',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('students', $imageName, 'public');
        $validated['image'] = $imagePath;
    }

    DB::table('students')->insert($validated);

    return back()->with('success', 'Student Added Successfully!');
}
public function studentList(Request $request)
{
    $query = DB::table('students');

    // Search by name, phone, aadhaar
    if ($request->search) {
        $query->where(function($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('phone', 'like', '%' . $request->search . '%')
              ->orWhere('aadhaar', 'like', '%' . $request->search . '%');
        });
    }

    // Class Filter
    if ($request->class_filter) {
        $query->where('class', $request->class_filter);
    }

    $students = $query->orderBy('id', 'desc')->get();

    return view('student.index', compact('students'));
}

public function studentEdit($id)
{
    $student = DB::table('students')->where('id', $id)->first();

    if (!$student) {
        abort(404);
    }

    return view('student.edit', compact('student'));
}

public function studentUpdate(Request $request, $id)
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

    // If new image is uploaded
    if ($request->hasFile('image')) {

        // delete old image if stored
        if ($student->image && str_starts_with($student->image, 'students/')) {
            Storage::disk('public')->delete($student->image);
        }

        $image = $request->file('image');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('students', $imageName, 'public');
        $validated['image'] = $imagePath;
    }

    DB::table('students')->where('id', $id)->update($validated);

    return redirect()->route('student.list')->with('success', 'Student updated successfully!');
}
public function studentDelete($id)
{
    $student = DB::table('students')->where('id', $id)->first();

    if (!$student) {
        abort(404);
    }

    // Delete image if stored locally
    if ($student->image && str_starts_with($student->image, 'students/')) {
        Storage::disk('public')->delete($student->image);
    }

    DB::table('students')->where('id', $id)->delete();

    return redirect()->route('student.list')->with('success', 'Student deleted successfully!');
}
public function studentView($id)
{
    $student = DB::table('students')->where('id', $id)->first();

    if (!$student) {
        abort(404);
    }

    return view('student.view', compact('student'));
}



}