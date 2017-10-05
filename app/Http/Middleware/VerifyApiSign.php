<?php

namespace App\Http\Middleware;

use App\Models\Account;
use App\Models\Customer;
use Closure;
use Illuminate\Support\Facades\Cache;

class VerifyApiSign
{
    protected $except = [
        '/api/wechat/customer/login',
        '/api/wechat/notify/*',
        '/api/wechat/js-api-config',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($this->inExceptArray($request)){
            return $next($request);
        }

        $token = $request->input('token', '');
        if (empty($token))
            return $this->fail(401, '令牌不能为空');

        if (!Cache::has($token))
            return $this->fail(403, '令牌不存在或者已失效');

        if (!empty($token)) {
            $customer_id = Cache::get($token);
            if(!empty($customer_id) && $customer_id > 0)
            {
                $request->customer = Customer::find($customer_id);
            }
        }
//        $request->customer = Customer::find(85);
        return $next($request);
    }

    protected function fail($code, $msg)
    {
        return response()->json([
            'result_code' => $code,
            'result_msg' => $msg
        ]);
    }

    protected function inExceptArray($request)
    {
        foreach ($this->except as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            if ($request->is($except)) {
                return true;
            }
        }
        return false;
    }
}
