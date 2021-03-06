<?php
namespace App\Http\Controllers\Admin;

use App\Models\Equipment;
use App\Models\Site;
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
		$sites = Site::all();
		$eqs = Equipment::all();
		Message::query()->where('read',0)->update([
		    'read' => 1
        ]);
		return view('admin.message.index',compact('sites','eqs'));
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
		return parent::pagination($request, $searchCols,$with,$conditionCall,function ($entities){
		    foreach ($entities as $entity){
		        if(!empty($entity->site)){
                    $entity->site_name = $entity->site->name;
                }else{
                    $entity->site_name = '';
                }
                if(!empty($entity->equipment)){
                    $entity->equ_name = $entity->equipment->sn;
                }else{
                    $entity->equ_name = '';
                }
                $entity->category_name = $entity->category();
            }
        });
	}

	public function getTops(Request $request){
        $params = $request->all();
        $query = Message::query();
        if(!empty($params)){
            foreach ($params as $col => $val){
                $query->where($col, $val);
            }
        }
        $messages = $query->orderBy('updated_at', 'desc')->take(10)->get();
        if(!empty($messages)){
            foreach ($messages as &$msg){
                $msg->time_desc = time_tran($msg->updated_at);
            }
        }
        return response()->json(['data' => $messages, 'cancelled' => 0]);
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
