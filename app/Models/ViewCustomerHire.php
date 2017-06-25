<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class ViewCustomerHire extends Model
{
	//
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
            case 1 : {
                return '用伞中';
            }
            case 2 : {
                return '用伞完成';
            }
            case 3 : {
                return '逾期未还';
            }
            case 4 : {
                return '待支付租金';
            }
        }
    }
}
