<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = \App\Models\BlogPost::with(['category', 'author'])->latest()->paginate(15);
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        $categories = \App\Models\BlogCategory::orderBy('name')->get();
        return view('admin.blog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'excerpt'          => 'nullable|string|max:500',
            'content'          => 'required|string',
            'blog_category_id' => 'nullable|exists:blog_categories,id',
            'status'           => 'required|in:draft,published',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'featured_image'   => 'nullable|image|max:2048',
        ]);

        $data['user_id'] = auth()->id();
        $data['slug'] = \Illuminate\Support\Str::slug($data['title']);

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        if ($data['status'] === 'published') {
            $data['published_at'] = now();
        }

        \App\Models\BlogPost::create($data);

        return redirect()->route('admin.blog.index')->with('success', 'Post created successfully.');
    }

    public function edit(\App\Models\BlogPost $blog)
    {
        $categories = \App\Models\BlogCategory::orderBy('name')->get();
        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, \App\Models\BlogPost $blog)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'excerpt'          => 'nullable|string|max:500',
            'content'          => 'required|string',
            'blog_category_id' => 'nullable|exists:blog_categories,id',
            'status'           => 'required|in:draft,published',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'featured_image'   => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        if ($data['status'] === 'published' && ! $blog->published_at) {
            $data['published_at'] = now();
        }

        $blog->update($data);

        return redirect()->route('admin.blog.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(\App\Models\BlogPost $blog)
    {
        $blog->delete();
        return back()->with('success', 'Post deleted.');
    }

    public function show(string $id) {}
}
