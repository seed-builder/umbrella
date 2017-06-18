<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //

    public function index(){
        return view('mobile.home.index');
    }

    public function map(){
        return view('mobile.home.map');
    }
}
