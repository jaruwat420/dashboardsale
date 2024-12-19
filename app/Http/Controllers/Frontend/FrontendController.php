<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Links;
use App\Models\UserActivities;
use Illuminate\Support\Facades\Auth;
use App\Models\Slider;
use App\Models\Blog;

class FrontendController extends Controller
{

    public function index()
    {
        try {
            $sliders = Slider::where('status', 1)->get();
            $blogs = Blog::where('status', 1)->get();
        } catch (\Exception $e) {
            $sliders = collect([]);
            $blogs = collect([]);
        }

        return view('frontend.home.index', compact('sliders', 'blogs'));
    }

    // render url
    public function getUrl ()
    {
        $links = Links::latest()->select('url')
        ->where('status', '=', 1)
        ->get();

        return view('frontend.link.index', compact('links'));
    }

    // insert log history copy url
    public function copyUrl (Request $request)
    {

        UserActivities::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'action' => 'copy',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'url_name' => $request->url,
        ]);
        return response(['status' => 'success', 'message' => 'Create Links Successfully.']);
    }

    public function OpenUrl(Request $request)
    {
        // Validate the URL
        $request->validate([
            'url' => 'required|url'
        ]);

        try {
            UserActivities::create([
                'user_id' => Auth::id(),
                'user_name' => Auth::user()->name,
                'action' => 'Open',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'url_name' => $request->url,
            ]);

            return response()->json(['status' => 'success', 'message' => 'Open Links Successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Failed to open link.'], 500);
        }
    }
}
