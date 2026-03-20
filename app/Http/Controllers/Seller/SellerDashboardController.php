<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class SellerDashboardController extends Controller
{
    public function index() {  
        $totalproducts =  Product::where('user_id', Auth::id())->count();

        return view('seller.dashboard', compact('totalproducts'));
    }
}
