<?php
/**
 * Created by PhpStorm.
 * User: asus1
 * Date: 2018/1/11
 * Time: 11:08
 */

namespace App\Http\Controllers\Partner;

class HomeController extends BaseController
{
    public function index()
    {
        return view('partner.index');
    }

}