<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'posts'       => \App\Models\BlogPost::count(),
            'published'   => \App\Models\BlogPost::where('status', 'published')->count(),
            'submissions' => \App\Models\ContactSubmission::count(),
            'unread'      => \App\Models\ContactSubmission::where('is_read', false)->count(),
            'reviews'     => \App\Models\Review::count(),
            'pending'     => \App\Models\Review::where('is_approved', false)->count(),
        ];

        $recentSubmissions = \App\Models\ContactSubmission::latest()->take(5)->get();
        $recentPosts = \App\Models\BlogPost::with('category')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentSubmissions', 'recentPosts'));
    }
}
