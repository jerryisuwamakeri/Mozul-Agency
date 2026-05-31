<?php

namespace App\Http\Controllers;

use App\Mail\NewSubmissionMail;
use App\Models\ContactSubmission;
use App\Services\ActivityLogger;
use App\Services\MailService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'             => 'required|string|max:150',
            'email'            => 'required|email|max:150',
            'phone'            => 'nullable|string|max:30',
            'company'          => 'nullable|string|max:150',
            'service_interest' => 'nullable|string|max:100',
            'message'          => 'required|string|max:3000',
        ]);

        $submission = ContactSubmission::create($data);
        ActivityLogger::log('created', "New contact submission from {$submission->name} ({$submission->email})");

        if (MailService::notificationsEnabled()) {
            MailService::sendToAdmin(new NewSubmissionMail($submission));
        }

        return back()->with('success', 'Thank you! We will get back to you shortly.');
    }
}
