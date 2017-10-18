<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

/**
 * model description
 * Class Umbrella
 * @package  App\Models
 *
 * @author  xrs
 * @SWG\Model(id="Umbrella")
 * @SWG\Property(name="color", type="string", description="颜色")
 * @SWG\Property(name="created_at", type="string", description="")
 * @SWG\Property(name="creator_id", type="integer", description="创建用户id")
 * @SWG\Property(name="deleted_at", type="string", description="")
 * @SWG\Property(name="equipment_id", type="integer", description="equipments id")
 * @SWG\Property(name="id", type="integer", description="")
 * @SWG\Property(name="logo", type="string", description="logo")
 * @SWG\Property(name="modifier_id", type="integer", description="修改用户id")
 * @SWG\Property(name="name", type="string", description="伞名称")
 * @SWG\Property(name="site_id", type="integer", description="sites id")
 * @SWG\Property(name="sn", type="string", description="伞编号")
 * @SWG\Property(name="status", type="integer", description="状态 1-未发放 2-待借中 3-借出中 4-失效（超过还伞时间） 5-异常")
 * @SWG\Property(name="updated_at", type="string", description="")
  */
class Umbrella extends BaseModel
{
	/**
	 * 状态 1-未发放
	 */
	const STATUS_INIT = 1;
	/**
	 * 状态 2-待借中
	 */
	const STATUS_WAITING = 2;
	/**
	 * 状态 3-借出中
	 */
	const STATUS_HIRING = 3;
	/**
	 * 状态 4-失效（超过还伞时间）
	 */
	const STATUS_EXPIRED = 4;
	/**
	 * 状态 5-异常
	 */
	const STATUS_EXCEPTION = 5;


	//
	protected $table = 'umbrellas';
	protected $guarded = ['id'];

    public $validateRules = [
//        'id' => 'required',
    ];

    public $validateMessages = [
//        'id.required' => "id不能为空",
    ];

    public function site(){
        return $this->hasOne(Site::class,'id','site_id');
    }

    public function equipment(){
        return $this->hasOne(Equipment::class,'id','equipment_id');
    }

    public function price(){
        return $this->hasOne(Umbrella::class,'id','price_id');
    }

    public function status(){
        switch ($this->status){
            case 1:{
                return '未发放';
            }
            case 2:{
                return '待借中';
            }
            case 3:{
                return '借出中';
            }
            case 4:{
                return '失效';
            }
            default : {
                return '未发放';
            }
        }
    }
}
