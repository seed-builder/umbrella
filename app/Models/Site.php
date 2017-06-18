<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

/**
 * model description
 * Class Site
 * @package  App\Models
 *
 * @author  xrs
 * @SWG\Model(id="Site")
 * @SWG\Property(name="address", type="string", description="详细地址")
 * @SWG\Property(name="city", type="string", description="城市")
 * @SWG\Property(name="created_at", type="string", description="")
 * @SWG\Property(name="creator_id", type="integer", description="创建用户id")
 * @SWG\Property(name="deleted_at", type="string", description="")
 * @SWG\Property(name="district", type="string", description="区域")
 * @SWG\Property(name="id", type="integer", description="")
 * @SWG\Property(name="latitude", type="string", description="纬度")
 * @SWG\Property(name="longitude", type="string", description="经度")
 * @SWG\Property(name="modifier_id", type="integer", description="修改用户id")
 * @SWG\Property(name="name", type="string", description="网点名")
 * @SWG\Property(name="province", type="string", description="省份")
 * @SWG\Property(name="type", type="integer", description="网点类别 1-设备网点 2-还伞网点")
 * @SWG\Property(name="updated_at", type="string", description="")
  */
class Site extends BaseModel
{
	//
	protected $table = 'sites';
	protected $guarded = ['id'];

    public $validateRules = [
        'id' => 'required',
    ];

    public $validateMessages = [
        'id.required' => "id不能为空",
    ];
}
