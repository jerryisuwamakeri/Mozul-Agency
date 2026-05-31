<?php

namespace App\Http\Controllers;

use App\Models\Course;

class CoursesController extends Controller
{
    public function index()
    {
        $courses = Course::visible()->orderBy('order')->orderBy('created_at')->get();
        return view('courses', compact('courses'));
    }
}
