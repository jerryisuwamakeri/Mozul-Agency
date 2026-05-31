<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\ContactSubmission;
use App\Models\Course;
use App\Models\PageView;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        $days = 30;
        $start = now()->subDays($days)->startOfDay();

        // --- Overview stats ---
        $totalViews     = PageView::where('created_at', '>=', $start)->count();
        $allTimeViews   = PageView::count();
        $uniqueVisitors = PageView::where('created_at', '>=', $start)->distinct('session_id')->count('session_id');
        $totalPosts     = BlogPost::published()->count();
        $totalSubs      = ContactSubmission::count();
        $unreadSubs     = ContactSubmission::where('is_read', false)->count();

        // --- Views over time (last 30 days) ---
        $rawViews = PageView::selectRaw("date(created_at) as date, count(*) as count")
            ->where('created_at', '>=', $start)
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date')
            ->toArray();

        $viewDates  = [];
        $viewCounts = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $d = now()->subDays($i)->format('Y-m-d');
            $viewDates[]  = now()->subDays($i)->format('M j');
            $viewCounts[] = $rawViews[$d] ?? 0;
        }

        // --- Submissions over time (last 30 days) ---
        $rawSubs = ContactSubmission::selectRaw("date(created_at) as date, count(*) as count")
            ->where('created_at', '>=', $start)
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date')
            ->toArray();

        $subCounts = [];
        foreach ($viewDates as $i => $label) {
            $d = now()->subDays($days - 1 - $i)->format('Y-m-d');
            $subCounts[] = $rawSubs[$d] ?? 0;
        }

        // --- Top posts by views ---
        $topPosts = BlogPost::withCount(['pageViews as views'])
            ->published()
            ->orderByDesc('views')
            ->take(8)
            ->get()
            ->map(fn($p) => ['label' => str(strip_tags($p->title))->limit(40)->toString(), 'views' => $p->views]);

        // --- Visitors by country (top 10) ---
        $byCountry = PageView::select('country', DB::raw('count(*) as count'))
            ->whereNotNull('country')
            ->where('country', '!=', '')
            ->groupBy('country')
            ->orderByDesc('count')
            ->take(10)
            ->get();

        // --- Views by content type ---
        $blogViews   = PageView::where('viewable_type', BlogPost::class)->count();
        $courseViews = PageView::where('viewable_type', Course::class)->count();

        // --- Content status breakdown ---
        $publishedPosts = BlogPost::where('status', 'published')->count();
        $draftPosts     = BlogPost::where('status', 'draft')->count();
        $publishedCourses  = Course::where('status', 'published')->count();
        $comingSoonCourses = Course::where('status', 'coming_soon')->count();

        return view('admin.analytics', compact(
            'totalViews', 'allTimeViews', 'uniqueVisitors', 'totalPosts', 'totalSubs', 'unreadSubs',
            'viewDates', 'viewCounts', 'subCounts',
            'topPosts', 'byCountry',
            'blogViews', 'courseViews',
            'publishedPosts', 'draftPosts', 'publishedCourses', 'comingSoonCourses',
            'days'
        ));
    }
}
