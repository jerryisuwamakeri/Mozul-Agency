@extends('emails.layout')

@section('content')
<p style="font-size:18px;font-weight:800;color:#111;margin-bottom:6px;">New Blog Comment</p>
<p style="font-size:14px;color:#71717a;margin-bottom:28px;">A new comment was submitted on your blog and is awaiting approval.</p>

<div class="field">
  <div class="label">Post</div>
  <div class="value">{{ $comment->post->title ?? 'Unknown post' }}</div>
</div>

<div class="field">
  <div class="label">From</div>
  <div class="value">{{ $comment->name }} &lt;<a href="mailto:{{ $comment->email }}" style="color:#111;">{{ $comment->email }}</a>&gt;</div>
</div>

<div class="field">
  <div class="label">Comment</div>
  <div class="message-box">{{ $comment->body }}</div>
</div>

<div class="divider"></div>

<p style="font-size:12px;color:#a1a1aa;margin-bottom:12px;">Submitted {{ $comment->created_at->format('F j, Y \a\t g:i A') }} · Awaiting your approval</p>
<a href="{{ url('/admin/comments') }}" class="btn">Review Comment →</a>
@endsection
