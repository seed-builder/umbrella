<?php

namespace App\Http\Controllers\Mobile;

use App\Helpers\WeChatApi;
use App\Http\Controllers\MobileController;
use App\Models\Comment;
use App\Models\CustomerHire;
use App\Models\Help;
use App\Models\Price;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Dysms;

class HelpController extends MobileController
{
    public function newEntity(array $attributes = [])
    {
        // TODO: Implement newEntity() method.
        return new Comment($attributes);
    }

    public function create(){
        return view('mobile.comment.create');
    }

    public function index(){
        $entities = Help::all();
        return view('mobile.help.index',compact('entities'));
    }
}
