<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

/**
 * model description
 * Class Customer
 * @package  App\Models
 *
 * @author  xrs
 * @SWG\Model(id="Customer")
 * @SWG\Property(name="address", type="string", description="地址")
 * @SWG\Property(name="birth_day", type="string", description="生日")
 * @SWG\Property(name="created_at", type="string", description="")
 * @SWG\Property(name="creator_id", type="integer", description="创建用户id")
 * @SWG\Property(name="deleted_at", type="string", description="")
 * @SWG\Property(name="gender", type="integer", description="性别(2-女,1-男，0-未知")
 * @SWG\Property(name="head_img_url", type="string", description="微信头像")
 * @SWG\Property(name="id", type="integer", description="")
 * @SWG\Property(name="login_time", type="integer", description="")
 * @SWG\Property(name="mobile", type="string", description="手机号")
 * @SWG\Property(name="modifier_id", type="integer", description="修改用户id")
 * @SWG\Property(name="nickname", type="string", description="微信昵称")
 * @SWG\Property(name="openid", type="string", description="微信openid")
 * @SWG\Property(name="password", type="string", description="密码")
 * @SWG\Property(name="remark", type="string", description="备注")
 * @SWG\Property(name="updated_at", type="string", description="")
  */
class Customer extends Authenticatable
{
	//
	protected $table = 'customers';
	protected $guarded = ['id'];

    public $validateRules = [
        'id' => 'required',
    ];

    public $validateMessages = [
        'id.required' => "id不能为空",
    ];

    public function account(){
        return $this->hasOne(CustomerAccount::class,'customer_id','id');
    }
}
