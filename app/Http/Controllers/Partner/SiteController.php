<?php
namespace App\Http\Controllers\Partner;

use Illuminate\Http\Request;
use App\Http\Controllers\Partner\BaseController;
use App\Models\Site;
use Illuminate\Support\Facades\Auth;

class SiteController extends BaseController
{
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new Site($attributes);
	}

	/**
	* Display a listing of the resource.
	*
	* @return  \Illuminate\Http\Response
	*/
	public function index()
	{
		//
		return view('partner.site.index');
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return  \Illuminate\Http\Response
	*/
	public function create()
	{
		return view('partner.site.create');
	}

	/**
	* Display the specified resource.
	*
	* @param    int  $id
	* @return  \Illuminate\Http\Response
	*/
	public function edit($id)
	{
		$entity = Site::find($id);
		return view('partner.site.edit', ['entity' => $entity]);
	}

	/**
	* Display the specified resource.
	*
	* @param    int  $id
	* @return  \Illuminate\Http\Response
	*/
	public function show($id)
	{
		$entity = Site::find($id);
		return view('partner.site.show', ['entity' => $entity]);
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
			$site_ids = $partner->equipments->pluck('site_id')->toArray();

			$queryBuilder->whereIn('id',$site_ids);
		});
	}

}
