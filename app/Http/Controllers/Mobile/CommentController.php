<?php

namespace App\Http\Controllers\Mobile;

use App\Helpers\WeChatApi;
use App\Http\Controllers\MobileController;
use App\Models\Comment;
use App\Models\CustomerHire;
use App\Models\Price;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Dysms;

class CommentController extends MobileController
{
    public function newEntity(array $attributes = [])
    {
        // TODO: Implement newEntity() method.
        return new Comment($attributes);
    }

    public function create(){
        return view('mobile.comment.create');
    }

    public function store(Request $request, $only = [], $extraFields = [], $successMsg = null)
    {
        $successMsg = '感谢您的宝贵意见，我们的工作人员会尽快处理';
        $data = $request->all();

        if(!empty($data['photo_id'])){
            $img = [];
            $api = new WeChatApi();

            $inputs = explode(',',$data['photo_id']);
            foreach ($inputs as $input){
                $file_id = $api->downResource($input);
                $img[] = $file_id;
            }
            $extraFields['photo_id'] = implode(',',$img);
        }

        $extraFields['customer_id'] = Auth::guard('mobile')->user()->id;
        return parent::store($request, $only, $extraFields, $successMsg); // TODO: Change the autogenerated stub
    }
}
