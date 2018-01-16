<?php
namespace App\Http\Controllers\Partner;

use App\Models\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Partner\BaseController;
use App\Models\Equipment;
use Illuminate\Support\Facades\Auth;

class EquipmentController extends BaseController
{
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new Equipment($attributes);
	}

	/**
	* Display a listing of the resource.
	*
	* @return  \Illuminate\Http\Response
	*/
    public function index()
    {
        $sites = Site::all();
        return view('partner.equipment.index', compact('sites'));
    }

	/**
	* Show the form for creating a new resource.
	*
	* @return  \Illuminate\Http\Response
	*/
	public function create()
	{
		return view('partner.equipment.create');
	}

	/**
	* Display the specified resource.
	*
	* @param    int  $id
	* @return  \Illuminate\Http\Response
	*/
	public function edit($id)
	{
		$entity = Equipment::find($id);
		return view('partner.equipment.edit', ['entity' => $entity]);
	}

	/**
	* Display the specified resource.
	*
	* @param    int  $id
	* @return  \Illuminate\Http\Response
	*/
	public function show($id)
	{
		$entity = Equipment::find($id);
		return view('partner.equipment.show', ['entity' => $entity]);
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
			$queryBuilder->where('partner_id',$partner->id);
		}, function ($entities) {
            foreach ($entities as $entity) {
                $entity->status_name = $entity->status();
            }
        });
	}

}
