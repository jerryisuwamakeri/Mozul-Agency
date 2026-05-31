<?php

namespace App\Http\Controllers;

use App\Mail\NewCommentMail;
use App\Models\BlogComment;
use App\Models\BlogPost;
use App\Services\ActivityLogger;
use App\Services\MailService;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    public function store(Request $request, string $slug)
    {
        $post = BlogPost::published()->where('slug', $slug)->firstOrFail();

        $data = $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'body'  => 'required|string|min:5|max:2000',
        ]);

        $data['blog_post_id'] = $post->id;
        $data['ip_address']   = $request->ip();
        $data['is_approved']  = false;

        $comment = BlogComment::create($data);
        ActivityLogger::log('created', "New blog comment on \"{$post->title}\" from {$comment->name}");

        if (MailService::notificationsEnabled()) {
            $comment->load('post');
            MailService::sendToAdmin(new NewCommentMail($comment));
        }

        return back()->with('comment_success', 'Thanks for your comment! It will appear after moderation.');
    }
}
