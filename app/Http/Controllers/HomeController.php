<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Review;
use App\Models\Setting;

class HomeController extends Controller
{
    public function services()
    {
        return view('services');
    }

    public function whyUs()
    {
        return view('why-us');
    }

    public function faqs()
    {
        return view('faqs');
    }

    public function index()
    {
        $latestPosts = BlogPost::published()->with('category')->latest('published_at')->take(3)->get();
        $reviews = Review::where('is_approved', true)->where('is_featured', true)->take(6)->get();

        $stats = [
            ['value' => Setting::get('stat_brands', '10+'), 'label' => 'Brands Served'],
            ['value' => Setting::get('stat_engagement', '3x'), 'label' => 'Avg. Engagement Growth'],
            ['value' => Setting::get('stat_products', '9'), 'label' => 'Knowledge Products'],
            ['value' => Setting::get('stat_industries', '5+'), 'label' => 'Industries Served'],
        ];

        $heroHeadline = Setting::get('hero_headline', 'We Build Digital Brands That Grow, Lead, and Last.');
        $heroHeadlineHtml = str_replace(
            'Grow,',
            '<span class="text-amber-400">Grow,</span>',
            e($heroHeadline)
        );

        return view('home', compact('latestPosts', 'reviews', 'stats', 'heroHeadlineHtml'));
    }
}
