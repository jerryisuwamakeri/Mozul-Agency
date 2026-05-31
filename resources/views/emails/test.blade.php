@extends('emails.layout')

@section('content')
<p style="font-size:18px;font-weight:800;color:#111;margin-bottom:6px;">✅ Email is working!</p>
<p style="font-size:14px;color:#71717a;margin-bottom:28px;">Your email configuration is set up correctly. You'll receive notifications for contact form submissions and blog comments at this address.</p>

<div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:10px;padding:16px;margin-bottom:24px;">
  <p style="font-size:13px;color:#15803d;font-weight:600;">Notifications are active for:</p>
  <ul style="font-size:13px;color:#166534;margin-top:8px;padding-left:16px;">
    <li style="margin-bottom:4px;">📬 New contact form submissions</li>
    <li style="margin-bottom:4px;">💬 New blog comments (pending approval)</li>
  </ul>
</div>

<div class="divider"></div>

<p style="font-size:12px;color:#a1a1aa;">Sent {{ now()->format('F j, Y \a\t g:i A') }} from Mozul Africa Admin</p>
@endsection
