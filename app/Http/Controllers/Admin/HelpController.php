<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Help;

class HelpController extends BaseController
{
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new Help($attributes);
	}

	/**
	* Display a listing of the resource.
	*
	* @return  \Illuminate\Http\Response
	*/
	public function index()
	{
		//
		return view('admin.help.index');
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return  \Illuminate\Http\Response
	*/
	public function create()
	{
		return view('admin.help.create');
	}

	/**
	* Display the specified resource.
	*
	* @param    int  $id
	* @return  \Illuminate\Http\Response
	*/
	public function edit($id)
	{
		$entity = Help::find($id);
		return view('admin.help.edit', ['entity' => $entity]);
	}

	/**
	* Display the specified resource.
	*
	* @param    int  $id
	* @return  \Illuminate\Http\Response
	*/
	public function show($id)
	{
		$entity = Help::find($id);
		return view('admin.help.show', ['entity' => $entity]);
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
		$searchCols = ["content","name"];
		return parent::pagination($request, $searchCols);
	}

	public function store(Request $request, $only = [], $extraFields = [], $redirect_url = null)
    {
        $redirect_url = url('/admin/help');
        return parent::store($request, $only, $extraFields, $redirect_url); // TODO: Change the autogenerated stub
    }

    public function update(Request $request, $id, $only = [], $extraFields = [], $redirect_url = null)
    {
        $redirect_url = url('/admin/help');
        return parent::update($request, $id, $only, $extraFields, $redirect_url); // TODO: Change the autogenerated stub
    }

}
