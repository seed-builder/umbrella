<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class ViewCustomerHire extends Model
{
	protected $table = 'view_customer_hires';
	protected $guarded = ['id'];

    public $validateRules = [
        'id' => 'required',
    ];

    public $validateMessages = [
        'id.required' => "id不能为空",
    ];

    public function status(){
        switch ($this->status){
            case CustomerHire::STATUS_INIT : {
                return '初始';
            }
            case CustomerHire::STATUS_HIRING : {
                return '租借中';
            }
            case CustomerHire::STATUS_PAYING : {
                return '还伞完毕，待支付租金';
            }
            case CustomerHire::STATUS_COMPLETE : {
                return '已完成';
            }
            case CustomerHire::STATUS_EXPIRED : {
                return '逾期未归还';
            }
        }
    }
}
