<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;


class AdminDashboardController extends Controller
{
    public function index() { 
        return view('admin.dashboard', [
            'totalUsers'=> User::count(),
            'totalProducts' => Product::count()
        ]);
    }
}
