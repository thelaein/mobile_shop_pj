<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SoldItem;

class DashboardController extends Controller
{
    public function info()
    {
        $data = SoldItem::all();

        $purchased_count = $data->where('delivery_status', "PURCHASED")->count();
        $packaging_count = $data->where('delivery_status', "PACKAGING")->count();
        $delivering_count = $data->where('delivery_status', "DELIVERING")->count();
        $received_count = $data->where('delivery_status', "RECEIVED")->count();

        return view('admin.dashboard', ['purchased' => $purchased_count, 'packaging' => $packaging_count, 'delivering' => $delivering_count, 'received' => $received_count]);
    }
}
