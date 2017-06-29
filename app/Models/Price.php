<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

/**
 * model description
 * Class Price
 * @package  App\Models
 *
 * @author  xrs
 * @SWG\Model(id="Price")
 * @SWG\Property(name="begin", type="string", description="有效期开始日期")
 * @SWG\Property(name="created_at", type="string", description="")
 * @SWG\Property(name="creator_id", type="integer", description="创建用户id")
 * @SWG\Property(name="deleted_at", type="string", description="")
 * @SWG\Property(name="deposit_cash", type="number", description="保证金")
 * @SWG\Property(name="end", type="string", description="有效期结束日期")
 * @SWG\Property(name="hire_day_cash", type="number", description="日租金")
 * @SWG\Property(name="hire_expire_days", type="integer", description="租借逾期天数(逾期则扣除保证金)")
 * @SWG\Property(name="hire_free_days", type="integer", description="租借免费天数")
 * @SWG\Property(name="id", type="integer", description="")
 * @SWG\Property(name="is_default", type="integer", description="是否默认(1-是， 2-否)")
 * @SWG\Property(name="modifier_id", type="integer", description="修改用户id")
 * @SWG\Property(name="name", type="string", description="名称")
 * @SWG\Property(name="status", type="integer", description="状态（1-启用， 2-禁用）")
 * @SWG\Property(name="updated_at", type="string", description="")
  */
class Price extends BaseModel
{
	//
	protected $table = 'prices';
	protected $guarded = ['id'];

    public $validateRules = [
        'name' => 'required',
        'deposit_cash' => 'required|numeric',
        'hire_day_cash' => 'required|numeric',
        'hire_free_days' => 'required|numeric',
        'hire_expire_days' => 'required|numeric',
    ];

    public $validateMessages = [
        'name.required' => "押金规则名称不能为空",
        'deposit_cash.required' => "押金金额不能为空",
        'deposit_cash.numeric' => "押金金额必须为数值",
        'hire_day_cash.required' => "日租金不能为空",
        'hire_day_cash.numeric' => "日租金必须为数值",
        'hire_free_days.required' => "租借免费天数不能为空",
        'hire_free_days.numeric' => "租借免费天数必须为数值",
        'hire_expire_days.required' => "租借免费天数不能为空",
        'hire_expire_days.numeric' => "租借免费天数必须为数值",
    ];
}
