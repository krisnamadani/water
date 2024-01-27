<?php

namespace App\Http\Controllers;

use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $first_date = \App\Models\WaterData::orderBy('created_at', 'asc')->first()->created_at;
        $last_date = \App\Models\WaterData::orderBy('created_at', 'desc')->first()->created_at;
        $month_period = CarbonPeriod::create(\Carbon\Carbon::parse($first_date)->startOfMonth(), '1 month', \Carbon\Carbon::parse($last_date)->endOfMonth());
        $months = [];
        foreach ($month_period as $month) {
            $months[] = [
                'month' => $month->format('M'),
                'year' => $month->format('y'),
                'text' => $month->format('M/y'),
                'value' => \App\Models\WaterData::whereMonth('created_at', $month->format('m'))->whereYear('created_at', $month->format('Y'))->count(),
            ];
        }
        $bar_chart = [
            'label' => json_encode(array_column($months, 'text')),
            'data' => json_encode(array_column($months, 'value')),
        ];
        $total_data = \App\Models\WaterData::count();
        $water_source_count = \App\Models\WaterData::select('water_source')->groupBy('water_source')->get()->count();
        $water_fit = \App\Models\WaterData::where('water_status', 'Layak')->count();
        $count = [
            'total_data' => $total_data,
            'water_source_count' => $water_source_count,
            'water_fit' => $water_fit,
        ];
        return view('pages.dashboard', compact('bar_chart', 'count'));
    }
}
