<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

/**
 * model description
 * Class Comment
 * @package  App\Models
 *
 * @author  xrs
 * @SWG\Model(id="Comment")
 * @SWG\Property(name="address", type="string", description="事发地点")
 * @SWG\Property(name="content", type="string", description="")
 * @SWG\Property(name="created_at", type="string", description="")
 * @SWG\Property(name="creator_id", type="integer", description="创建用户id")
 * @SWG\Property(name="customer_id", type="integer", description="客户id")
 * @SWG\Property(name="deleted_at", type="string", description="")
 * @SWG\Property(name="id", type="integer", description="")
 * @SWG\Property(name="modifier_id", type="integer", description="修改用户id")
 * @SWG\Property(name="service_id", type="integer", description="1-故障申报 2-损坏举报 3-疑问咨询")
 * @SWG\Property(name="updated_at", type="string", description="")
  */
class Comment extends BaseModel
{
	//
	protected $table = 'comments';
	protected $guarded = ['id'];
//	protected $with = ['pics'];

    public $validateRules = [
        'content' => 'required',
        'service_id' => 'required',
        'address' => 'required',
    ];

    public $validateMessages = [
        'service_id.required' => "请选择一种服务类型",
        'content.required' => "反馈不能为空哦",
        'address.required' => "请填写事发地点",
    ];

    public function customer(){
        return $this->hasOne(Customer::class,'id','customer_id');
    }

    public function service(){
        switch ($this->service_id){
            case 1:{
                return '故障申报';
            }
            case 2:{
                return '损坏举报';
            }
            case 3:{
                return '疑问咨询';
            }
        }
    }

    public function pics()
    {
        return $this->morphMany(Resource::class, 'res');
    }
}
