<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * model description
 * Class Partner
 * @package  App\Models
 *
 * @author  xrs
 * @SWG\Model(id="Partner")
 * @SWG\Property(name="address", type="string", description="地址")
 * @SWG\Property(name="created_at", type="string", description="")
 * @SWG\Property(name="full_name", type="string", description="经销商全称")
 * @SWG\Property(name="id", type="integer", description="")
 * @SWG\Property(name="linkman", type="string", description="联系人")
 * @SWG\Property(name="mobile", type="string", description="手机号")
 * @SWG\Property(name="name", type="string", description="登陆账号")
 * @SWG\Property(name="password", type="string", description="密码")
 * @SWG\Property(name="remember_token", type="string", description="remember_token")
 * @SWG\Property(name="status", type="integer", description="状态 1-启用 2-禁用")
 * @SWG\Property(name="updated_at", type="string", description="")
  */
class Partner extends Authenticatable
{
	//
	protected $table = 'partners';
	protected $guarded = ['id'];

    public $validateRules = [
        'name' => 'required',
        'full_name' => 'required',
        'linkman' => 'required',
        'mobile' => 'required',
        'address' => 'required',
    ];

    public $validateMessages = [
        'name.required' => "登陆账号不能为空",
        'full_name.required' => "经销商全称不能为空",
        'linkman.required' => "联系人不能为空",
        'mobile.required' => "联系电话不能为空",
        'address.required' => "详细地址不能为空",
    ];

    public function equipments(){
        return $this->hasMany(Equipment::class,'partner_id','id');
    }
}
