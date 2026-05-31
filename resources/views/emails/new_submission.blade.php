@extends('emails.layout')

@section('content')
<p style="font-size:18px;font-weight:800;color:#111;margin-bottom:6px;">New Contact Message</p>
<p style="font-size:14px;color:#71717a;margin-bottom:28px;">Someone just submitted the contact form on your website.</p>

<div class="field">
  <div class="label">From</div>
  <div class="value">{{ $submission->name }}</div>
</div>

<div class="field">
  <div class="label">Email</div>
  <div class="value"><a href="mailto:{{ $submission->email }}" style="color:#111;">{{ $submission->email }}</a></div>
</div>

@if($submission->phone)
<div class="field">
  <div class="label">Phone</div>
  <div class="value">{{ $submission->phone }}</div>
</div>
@endif

@if($submission->company)
<div class="field">
  <div class="label">Company</div>
  <div class="value">{{ $submission->company }}</div>
</div>
@endif

@if($submission->service_interest)
<div class="field">
  <div class="label">Service of Interest</div>
  <div class="value">{{ $submission->service_interest }}</div>
</div>
@endif

<div class="field">
  <div class="label">Message</div>
  <div class="message-box">{{ $submission->message }}</div>
</div>

<div class="divider"></div>

<p style="font-size:12px;color:#a1a1aa;margin-bottom:12px;">Submitted {{ $submission->created_at->format('F j, Y \a\t g:i A') }}</p>
<a href="{{ route('admin.submissions.show', $submission) }}" class="btn">View in Admin →</a>
@endsection
