<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Slider;
use App\Models\User;
use App\Models\MonthClickHistory;
use DB;


class AdminDashboardController extends Controller
{
    //
    public function index()
    {
        $clickData = MonthClickHistory::select('user_id', 'user_name', 'month', DB::raw('count(*) as click_count'))
        ->whereYear('created_at', date('Y'))
        ->groupBy('user_id', 'user_name', 'month')
        ->get();

        $chartData = $this->prepareChartData($clickData);

        $blogs_count = Blog::count();
        $slider_count = Slider::count();
        $admin_count = User::where('role', 'admin')->count();
        $user_count = User::where('role', 'user')->count();

        // Report Monthly
        $clickData = MonthClickHistory::selectRaw('user_name, year, month, COUNT(*) as click_count')
        ->groupBy('user_name', 'year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->get();

        return view ('admin.dashboard.index',compact('blogs_count', 'slider_count', 'user_count', 'admin_count','chartData', 'clickData'));
    }

    private function prepareChartData($clickData)
    {
        $users = $clickData->pluck('user_id')->unique();
        $months = range(1, 12);

        $datasets = [];
        foreach ($users as $userId) {
            $data = array_fill(0, 12, 0);
            foreach ($clickData->where('user_id', $userId) as $click) {
                $data[$click->month - 1] = $click->click_count;
            }
            $datasets[] = [
                'label' => 'User ' . $userId,
                'data' => $data,
                'borderColor' => $this->getRandomColor(),
                'fill' => false
            ];
        }

        return [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'datasets' => $datasets
        ];
    }

    private function getRandomColor()
    {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }
}
