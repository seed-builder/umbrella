<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

/**
 * model description
 * Class ViewPartnerStatistics
 * @package  App\Models
 *
 * @author  xrs
 * @SWG\Model(id="ViewPartnerStatistics")
 * @SWG\Property(name="created_at", type="string", description="")
 * @SWG\Property(name="deposit_amt", type="number", description="缴纳的保证金")
 * @SWG\Property(name="equipments_sn", type="string", description="设备编号（E/M + 邮编 + 序列号(4位数字，不足补0)）")
 * @SWG\Property(name="equipment_id", type="integer", description="")
 * @SWG\Property(name="hire_amt", type="number", description="租借费用")
 * @SWG\Property(name="id", type="integer", description="")
 * @SWG\Property(name="partner_fullname", type="string", description="经销商全称")
 * @SWG\Property(name="partner_id", type="integer", description="")
 * @SWG\Property(name="partner_name", type="string", description="")
 * @SWG\Property(name="site_id", type="integer", description="")
 * @SWG\Property(name="site_name", type="string", description="网点名")
  */
class ViewPartnerStatistics extends BaseModel
{
	//
	protected $table = 'view_partner_statistics';
	protected $guarded = ['id'];

    public $validateRules = [
        'id' => 'required',
    ];

    public $validateMessages = [
        'id.required' => "id不能为空",
    ];
}
