<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Services\PageViewTracker;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::published()->with(['category', 'author'])->latest('published_at');

        if ($request->filled('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }

        $posts = $query->paginate(9);
        $categories = BlogCategory::withCount(['posts' => fn($q) => $q->published()])->get();

        return view('blog.index', compact('posts', 'categories'));
    }

    public function show(string $slug, Request $request)
    {
        $post = BlogPost::published()->with(['category', 'author'])->where('slug', $slug)->firstOrFail();
        PageViewTracker::track($post, $request);
        $related = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->when($post->blog_category_id, fn($q) => $q->where('blog_category_id', $post->blog_category_id))
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('blog.show', compact('post', 'related'));
    }
}
