<?php

namespace App\Http\Controllers;

use App\Models\Startup;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Helper\Helper;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DateTime;

class HomeController extends Controller
{
    public function getHomeData()
    {
        // Fetch 4 most viewed startups
        $mostViewedStartups = Startup::orderBy('startup_view_count', 'desc')
            ->take(4)
            ->get(['id', 'startup_image', 'startup_name', 'startup_valuation', 'startup_equity']);

        // Fetch large startups (example: based on valuation > 100 cr)
        $largeStartups = Startup::where('startup_valuation', '>', 1000000000)
            ->take(4)
            ->get(['id', 'startup_image', 'startup_name', 'startup_valuation', 'startup_equity']);

        // Fetch mid startups (example: based on valuation between 10 cr and 100 cr)
        $midStartups = Startup::whereBetween('startup_valuation', [100000000, 1000000000])
            ->take(4)
            ->get(['id', 'startup_image', 'startup_name', 'startup_valuation', 'startup_equity']);

        // Fetch small startups (example: based on valuation < 10 cr)
        $smallStartups = Startup::where('startup_valuation', '<', 100000000)
            ->take(4)
            ->get(['id', 'startup_image', 'startup_name', 'startup_valuation', 'startup_equity']);

        // Fetch 4 startups for "Explore All" section (example: most recent startups)
        $exploreAllStartups = Startup::orderBy('created_at', 'desc')
            ->take(4)
            ->get(['id', 'startup_image', 'startup_name', 'startup_valuation', 'startup_equity']);

        // Fetch 4 news items for "Startup in News" section (assuming a News model and table exist)
        $newsItems = News::orderBy('created_at', 'desc')
            ->take(4)
            ->get(['id', 'company_name', 'image_url', 'news', 'date', 'url']);

        // Return JSON response
        return response()->json(
            [
                'status' => 'success',
                'data' => [
                    'most_viewed_startups' => $mostViewedStartups,
                    'large_startups' => $largeStartups,
                    'mid_startups' => $midStartups,
                    'small_startups' => $smallStartups,
                    'explore_all_startups' => $exploreAllStartups,
                    'startup_news' => $newsItems,
                ],
            ],
            200,
        );
    }
}
