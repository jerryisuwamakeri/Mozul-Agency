<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::orderBy('order')->orderByDesc('created_at')->get();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'content'        => 'nullable|string',
            'price'          => 'nullable|numeric|min:0',
            'currency'       => 'nullable|string|max:10',
            'status'         => 'required|in:draft,published,coming_soon',
            'duration'       => 'nullable|string|max:100',
            'level'          => 'nullable|in:beginner,intermediate,advanced',
            'category'       => 'nullable|string|max:100',
            'enrollment_url' => 'nullable|url|max:500',
            'order'          => 'nullable|integer|min:0',
            'cover_image'    => 'nullable|image|max:3072',
        ]);

        $data['slug'] = Str::slug($data['title']);
        if (empty($data['price'])) $data['price'] = null;

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('courses', 'public');
        }

        $course = Course::create($data);
        ActivityLogger::created($course, 'Course');

        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'content'        => 'nullable|string',
            'price'          => 'nullable|numeric|min:0',
            'currency'       => 'nullable|string|max:10',
            'status'         => 'required|in:draft,published,coming_soon',
            'duration'       => 'nullable|string|max:100',
            'level'          => 'nullable|in:beginner,intermediate,advanced',
            'category'       => 'nullable|string|max:100',
            'enrollment_url' => 'nullable|url|max:500',
            'order'          => 'nullable|integer|min:0',
            'cover_image'    => 'nullable|image|max:3072',
        ]);

        if (empty($data['price'])) $data['price'] = null;

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('courses', 'public');
        } else {
            unset($data['cover_image']);
        }

        $course->update($data);
        ActivityLogger::updated($course, 'Course');

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        ActivityLogger::deleted('Course', $course->title);
        $course->delete();
        return back()->with('success', 'Course deleted.');
    }
}
