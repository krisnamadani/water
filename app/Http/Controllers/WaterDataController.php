<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WaterDataController extends Controller
{
    public function index()
    {
        return view('pages.water-data');
    }

    public function get()
    {
        $water_data = \App\Models\WaterData::orderBy('id', 'desc')->get();

        return \Yajra\DataTables\DataTables::of($water_data)
            ->addIndexColumn()
            ->editColumn('created_at', function ($data) {
                return $data->created_at->format('Y-m-d H:i:s');
            })
            ->make(true);
    }
}
