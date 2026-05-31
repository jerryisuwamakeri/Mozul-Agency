<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubmissionsController extends Controller
{
    public function index()
    {
        $submissions = \App\Models\ContactSubmission::latest()->paginate(20);
        return view('admin.submissions.index', compact('submissions'));
    }

    public function show(\App\Models\ContactSubmission $submission)
    {
        $submission->update(['is_read' => true]);
        return view('admin.submissions.show', compact('submission'));
    }

    public function destroy(\App\Models\ContactSubmission $submission)
    {
        $submission->delete();
        return redirect()->route('admin.submissions.index')->with('success', 'Submission deleted.');
    }
}
