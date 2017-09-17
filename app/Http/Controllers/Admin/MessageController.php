<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Message;

class MessageController extends BaseController
{
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new Message($attributes);
	}

	/**
	* Display a listing of the resource.
	*
	* @return  \Illuminate\Http\Response
	*/
	public function index()
	{
		//
		return view('admin.message.index');
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return  \Illuminate\Http\Response
	*/
	public function create()
	{
		return view('admin.message.create');
	}

	/**
	* Display the specified resource.
	*
	* @param    int  $id
	* @return  \Illuminate\Http\Response
	*/
	public function edit($id)
	{
		$entity = Message::find($id);
		return view('admin.message.edit', ['entity' => $entity]);
	}

	/**
	* Display the specified resource.
	*
	* @param    int  $id
	* @return  \Illuminate\Http\Response
	*/
	public function show($id)
	{
		$entity = Message::find($id);
		return view('admin.message.show', ['entity' => $entity]);
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
		$searchCols = ["content"];
		return parent::pagination($request, $searchCols);
	}

	public function getTops(Request $request){
        $params = $request->all();
        $query = Message::query();
        if(!empty($params)){
            foreach ($params as $col => $val){
                $query->where($col, $val);
            }
        }
        $messages = $query->orderBy('updated_at', 'desc')->take(10);
        return $this->success($messages);
    }

}
