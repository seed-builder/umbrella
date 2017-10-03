<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

/**
 * model description
 * Class Message
 * @package  App\Models
 *
 * @author  xrs
 * @SWG\Model(id="Message")
 * @SWG\Property(name="category", type="integer", description="0-普通,1-设备")
 * @SWG\Property(name="channel", type="integer", description="通道号")
 * @SWG\Property(name="content", type="string", description="")
 * @SWG\Property(name="created_at", type="string", description="")
 * @SWG\Property(name="creator_id", type="integer", description="创建用户id")
 * @SWG\Property(name="deleted_at", type="string", description="")
 * @SWG\Property(name="equipment_id", type="integer", description="设备Id")
 * @SWG\Property(name="id", type="integer", description="")
 * @SWG\Property(name="level", type="integer", description="0-CRITICAL,1-ERROR,2-WARNING,3-NOTICE,4-INFO")
 * @SWG\Property(name="modifier_id", type="integer", description="修改用户id")
 * @SWG\Property(name="read", type="integer", description="是否已读( 0-未读， 1-已读)")
 * @SWG\Property(name="site_id", type="integer", description="site id")
 * @SWG\Property(name="updated_at", type="string", description="")
  */
class Message extends BaseModel
{
	//
	protected $table = 'messages';
	protected $guarded = ['id'];

    public $validateRules = [
        'id' => 'required',
    ];

    public $validateMessages = [
        'id.required' => "id不能为空",
    ];

    public function site(){
        return $this->hasOne(Site::class,'id','site_id');
    }

    public function equipment(){
        return $this->hasOne(Equipment::class,'id','equipment_id');
    }

    public function category(){
        switch ($this->category){
            case 0:
                return '普通';
            case 1:
                return '设备';
        }
    }
}
