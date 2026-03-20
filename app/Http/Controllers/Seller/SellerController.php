<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;

class SellerController extends Controller
{
    public function transactions() {
        return view('seller.transactions.index');
    }
}
