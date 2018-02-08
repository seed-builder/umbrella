<?php
namespace App\Http\Controllers\Partner;

use Illuminate\Http\Request;
use App\Http\Controllers\Partner\BaseController;
use App\Models\EquipmentLog;
use Illuminate\Support\Facades\Auth;

class EquipmentLogController extends BaseController
{
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new EquipmentLog($attributes);
	}

	/**
	* Display a listing of the resource.
	*
	* @return  \Illuminate\Http\Response
	*/
	public function index()
	{
		//
		return view('partner.equipment-log.index');
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return  \Illuminate\Http\Response
	*/
	public function create()
	{
		return view('partner.equipment-log.create');
	}

	/**
	* Display the specified resource.
	*
	* @param    int  $id
	* @return  \Illuminate\Http\Response
	*/
	public function edit($id)
	{
		$entity = EquipmentLog::find($id);
		return view('partner.equipment-log.edit', ['entity' => $entity]);
	}

	/**
	* Display the specified resource.
	*
	* @param    int  $id
	* @return  \Illuminate\Http\Response
	*/
	public function show($id)
	{
		$entity = EquipmentLog::find($id);
		return view('partner.equipment-log.show', ['entity' => $entity]);
	}

	/**
	* @param  Request $request
	* @param  array $searchCols
	* @param  array $with
	* @param  null $conditionCall
	* @param  bool $all_columns
	* @return  \Illuminate\Http\JsonResponse
	*/
	public function pagination(Request $request, $searchCols = [], $with=[], $conditionCall = null, $dataHandleCall = null, $all_columns = false){

		return parent::pagination($request,$searchCols,$with,function($queryBuilder){
			$partner = Auth::guard('partner')->user();
			$equipment_sns = $partner->equipments->pluck('sn')->toArray();
			$queryBuilder->whereIn('equipment_sn',$equipment_sns);
		},function($entities){
            foreach ($entities as $entity){
                $entity->level_name = $entity->level();
            }

        });
	}

    public function filterQuery($filters, $queryBuilder)
    {
        foreach ($filters as $filter) {
            foreach ($filter as $k => $v){
                if (empty($v)) {
                    continue ;
                }
                switch ($k){
                    case 'start_created_at':{
                        $queryBuilder->where('created_at','>=',$v );
                        break ;
                    }
                    case 'end_created_at':{
                        $queryBuilder->where('created_at','<=',$v );
                        break ;
                    }
                    default : {
                        $queryBuilder->where($k, 'like binary', '%' . $v . '%');
                    }
                }
            }

        }
    }

}
