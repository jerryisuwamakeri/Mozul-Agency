<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use App\Services\ActivityLogger;

class CommentController extends Controller
{
    public function index()
    {
        $pending  = BlogComment::with('post')->where('is_approved', false)->latest()->get();
        $approved = BlogComment::with('post')->where('is_approved', true)->latest()->take(30)->get();
        return view('admin.comments.index', compact('pending', 'approved'));
    }

    public function approve(BlogComment $comment)
    {
        $comment->update(['is_approved' => true]);
        ActivityLogger::log('approved', "Approved comment from {$comment->name} on \"{$comment->post->title}\"");
        return back()->with('success', 'Comment approved.');
    }

    public function destroy(BlogComment $comment)
    {
        ActivityLogger::log('deleted', "Deleted comment from {$comment->name}");
        $comment->delete();
        return back()->with('success', 'Comment deleted.');
    }
}
