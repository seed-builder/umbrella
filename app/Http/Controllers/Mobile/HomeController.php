<?php

namespace App\Http\Controllers\Mobile;

use App\Models\Price;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //

    public function index(){
        return view('mobile.home.index');
    }

    public function map(){
        $user = Auth::guard('mobile')->user();
        $price = Price::query()->where('status',1)->first();

        return view('mobile.home.map',compact('user','price'));
    }
}
