<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

/**
 * model description
 * Class SysConfig
 * @package  App\Models
 *
 * @author  xrs
 * @SWG\Model(id="SysConfig")
 * @SWG\Property(name="category", type="string", description="类型")
 * @SWG\Property(name="created_at", type="string", description="")
 * @SWG\Property(name="deleted_at", type="string", description="")
 * @SWG\Property(name="desc", type="string", description="描述")
 * @SWG\Property(name="id", type="integer", description="")
 * @SWG\Property(name="name", type="string", description="配置项名称")
 * @SWG\Property(name="updated_at", type="string", description="")
 * @SWG\Property(name="value", type="string", description="值")
  */
class SysConfig extends BaseModel
{
	//
	protected $table = 'sys_configs';
	protected $guarded = ['id'];

    public $validateRules = [

    ];

    public $validateMessages = [

    ];
}
