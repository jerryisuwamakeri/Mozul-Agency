<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use App\Services\ActivityLogger;
use App\Services\MailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = \App\Models\Setting::orderBy('group')->orderBy('order')->get()->groupBy('group');
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $inputs = $request->except(['_token', '_method']);

        // Checkboxes are absent from POST when unchecked — force boolean keys to 0
        $booleanKeys = \App\Models\Setting::where('type', 'boolean')->pluck('key');
        foreach ($booleanKeys as $key) {
            if (!array_key_exists($key, $inputs)) {
                $inputs[$key] = '0';
            }
        }

        foreach ($inputs as $key => $value) {
            \App\Models\Setting::where('key', $key)->update(['value' => $value]);
        }

        ActivityLogger::log('updated', 'Site settings updated');
        return back()->with('success', 'Settings saved successfully.');
    }

    public function sendTestEmail(Request $request)
    {
        $request->validate(['test_email' => 'required|email']);

        MailService::configureMailer();

        try {
            \Illuminate\Support\Facades\Mail::to($request->test_email)->send(new TestMail());
            return back()->with('test_email_success', "Test email sent to {$request->test_email}");
        } catch (\Throwable $e) {
            return back()->with('test_email_error', 'Failed to send: ' . $e->getMessage());
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('password_error', 'Current password is incorrect.');
        }

        $user->update(['password' => Hash::make($request->password)]);

        return back()->with('password_success', 'Password updated successfully.');
    }
}
