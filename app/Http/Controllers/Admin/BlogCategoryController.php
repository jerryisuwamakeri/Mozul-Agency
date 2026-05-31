<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = \App\Models\BlogCategory::withCount('posts')->get();
        return view('admin.blog.categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|string|max:100|unique:blog_categories,name']);
        $data['slug'] = \Illuminate\Support\Str::slug($data['name']);
        \App\Models\BlogCategory::create($data);
        return back()->with('success', 'Category created.');
    }

    public function destroy(\App\Models\BlogCategory $blogCategory)
    {
        $blogCategory->delete();
        return back()->with('success', 'Category deleted.');
    }

    public function create() {}
    public function show(string $id) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
}
