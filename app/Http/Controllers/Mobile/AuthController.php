<?php
namespace App\Http\Controllers\Mobile;

use App\Helpers\WeChatApi;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthController extends Controller
{
    public function AuthLogin(Request $request)
    {
        $code = $request->input('code','');

        if (!empty($code)) {
            $api = new WeChatApi();
            $response = $api->getUserByCode($code);

            $data = [
                'nickname' => $response->nickname,
                'head_img_url' => $response->headimgurl,
                'gender' => $response->sex,
                'city' => $response->city,
                'country' => $response->country,
                'province' => $response->province,
            ];

            $user = Customer::query()->where('openid', $response->openid)->first();

            if (!empty($user)) {
                $user->fill($data);
                $user->save();

            } else {
                $user = Customer::create($data);
            }
            Auth::guard('mobile')->login($user);

            return redirect(url('mobile/home/map'));
        }
    }
}
