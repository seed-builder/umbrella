<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

/**
 * model description
 * Class SysLog
 * @package  App\Models
 *
 * @author  xrs
 * @SWG\Model(id="SysLog")
 * @SWG\Property(name="action", type="string", description="操作")
 * @SWG\Property(name="content", type="string", description="内容")
 * @SWG\Property(name="created_at", type="string", description="")
 * @SWG\Property(name="creator_id", type="integer", description="创建用户id")
 * @SWG\Property(name="deleted_at", type="string", description="")
 * @SWG\Property(name="id", type="integer", description="")
 * @SWG\Property(name="modifier_id", type="integer", description="修改用户id")
 * @SWG\Property(name="module", type="string", description="模块名 （表名|请求接口名）")
 * @SWG\Property(name="updated_at", type="string", description="")
  */
class SysLog extends BaseModel
{
	//
	protected $table = 'sys_logs';
	protected $guarded = ['id'];

    public $validateRules = [
        'id' => 'required',
    ];

    public $validateMessages = [
        'id.required' => "id不能为空",
    ];
}
