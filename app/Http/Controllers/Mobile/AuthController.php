<?php
namespace App\Http\Controllers\Mobile;

use App\Helpers\WeChatApi;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthController extends Controller
{
    public function AuthLogin(Request $request)
    {
        $code = $request->input('code', '');

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

            //创建资金账户
            if (empty($user->account)) {
                CustomerAccount::create([
                    'sn' => 'A' . date('YmdHis') . $user->id . random_int(10, 99),
                    'customer_id' => $user->id
                ]);
            }

            Auth::guard('mobile')->login($user);

            return redirect(url('mobile/home/map'));
        }
    }
}
