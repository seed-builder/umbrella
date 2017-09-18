<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

/**
 * model description
 * Class Help
 * @package  App\Models
 *
 * @author  xrs
 * @SWG\Model(id="Help")
 * @SWG\Property(name="content", type="string", description="")
 * @SWG\Property(name="created_at", type="string", description="")
 * @SWG\Property(name="id", type="integer", description="")
 * @SWG\Property(name="name", type="string", description="")
 * @SWG\Property(name="updated_at", type="string", description="")
  */
class Help extends BaseModel
{
	//
	protected $table = 'helps';
	protected $guarded = ['id'];

    public $validateRules = [
        'name' => 'required',
        'content' => 'required',
    ];

    public $validateMessages = [
        'name.required' => "名称不能为空",
        'content.required' => "内容不能为空",
    ];
}
