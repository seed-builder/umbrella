<?php
namespace App\Http\Controllers\Partner;

use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Http\Controllers\Partner\BaseController;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends BaseController
{
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new Comment($attributes);
	}

	/**
	* Display a listing of the resource.
	*
	* @return  \Illuminate\Http\Response
	*/
	public function index()
	{
		//
		return view('partner.comment.index');
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return  \Illuminate\Http\Response
	*/
	public function create()
	{
		return view('partner.comment.create');
	}

	/**
	* Display the specified resource.
	*
	* @param    int  $id
	* @return  \Illuminate\Http\Response
	*/
	public function edit($id)
	{
		$entity = Comment::find($id);
		return view('partner.comment.edit', ['entity' => $entity]);
	}

	/**
	* Display the specified resource.
	*
	* @param    int  $id
	* @return  \Illuminate\Http\Response
	*/
	public function show($id)
	{
		$entity = Comment::find($id);
		return view('partner.comment.show', ['entity' => $entity]);
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
			$equipment_ids = $partner->equipments->pluck('id')->toArray();
			$site_ids = Equipment::whereIn('id',$equipment_ids)->pluck('site_id')->toArray();

			$queryBuilder->whereIn('site_id',$site_ids);
		});
	}

}
