<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        foreach ($inputs as $key => $value) {
            \App\Models\Setting::where('key', $key)->update(['value' => $value]);
        }

        return back()->with('success', 'Settings saved successfully.');
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
