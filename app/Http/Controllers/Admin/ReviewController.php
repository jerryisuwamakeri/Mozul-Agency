<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = \App\Models\Review::latest()->paginate(20);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:100',
            'company'     => 'nullable|string|max:100',
            'position'    => 'nullable|string|max:100',
            'content'     => 'required|string|max:1000',
            'rating'      => 'required|integer|min:1|max:5',
            'is_approved' => 'boolean',
            'is_featured' => 'boolean',
        ]);
        $data['is_approved'] = $request->boolean('is_approved');
        $data['is_featured'] = $request->boolean('is_featured');
        \App\Models\Review::create($data);
        return back()->with('success', 'Review added.');
    }

    public function update(Request $request, \App\Models\Review $review)
    {
        $review->update([
            'is_approved' => $request->boolean('is_approved'),
            'is_featured' => $request->boolean('is_featured'),
        ]);
        return back()->with('success', 'Review updated.');
    }

    public function destroy(\App\Models\Review $review)
    {
        $review->delete();
        return back()->with('success', 'Review deleted.');
    }

    public function create() {}
    public function show(string $id) {}
    public function edit(string $id) {}
}
