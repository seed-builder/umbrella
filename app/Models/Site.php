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
	/**
	 * 网点类别 1-设备网点
	 */
	const TYPE_EQUIPMENT = 1;
	/**
	 * 网点类别 2-还伞网点
	 */
	const TYPE_RESTORE = 2;

    //
    protected $table = 'sites';
    protected $guarded = ['id'];
    protected $appends = ['umbrella_hava', 'umbrella_capacity', 'umbrella_repay','photo'];

    public $validateRules = [
        'name' => 'required',
        'province' => 'required',
        'city' => 'required',
        'district' => 'required',
        'address' => 'required',
        'postal_code' => 'required',
    ];

    public $validateMessages = [
        'name.required' => "网点名不能为空",
        'province.required' => "省份不能为空",
        'city.required' => "城市不能为空",
        'district.required' => "区域不能为空",
        'address.required' => "详细地址不能为空",
        'postal_code.required' => "编码不能为空",
    ];

    public function type()
    {
        switch ($this->type) {
            case 1: {
                return '设备网点';
            }
            case 2: {
                return '还伞网点';
            }
            default : {
                return '设备网点';
            }
        }
    }

    public function equipments()
    {
        return $this->hasMany(Equipment::class, 'site_id', 'id');
    }

    public function getUmbrellaHavaAttribute()
    {
        return $this->equipments()->sum('have');
    }

    public function getUmbrellaCapacityAttribute()
    {
        return $this->equipments()->sum('capacity');
    }

    public function getUmbrellaRepayAttribute()
    {
        return $this->getUmbrellaCapacityAttribute() - $this->getUmbrellaHavaAttribute();
    }

    public function getPhotoAttribute()
    {
        if (!empty($this->photo_id))
            return '/admin/show-image/'.$this->photo_id;
        else
            return '/images/site_default.png';
    }
}
