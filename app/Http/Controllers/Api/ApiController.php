<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Services\LogSvr;
use Illuminate\Support\Facades\Validator;

abstract class  ApiController extends Controller
{
    protected $request;
	//
	public function __construct(Request $request)
	{
	    $this->request = $request;
	}

	public abstract function newEntity(array $attributes = []);

	public function fillQueryForIndex(Request $request, Builder &$query)
	{
		$search = $request->input('search', '{}');
		$conditions = json_decode($search, true);
		if (!empty($conditions)) {
			//dump($conditions);
			foreach ($conditions as $k => $v) {
				$tmp = explode(' ', $k);
				if(isset($tmp[1])){
					$operator = trim($tmp[1]);
					if(preg_match('/^[a-zA-Z]+$/', $operator)){
						$query->{'where'.ucwords($operator)}($tmp[0], $v);
					}else{
						$query->where($tmp[0], $tmp[1], $v);
					}
				}else {
					$query->where($tmp[0], $v);
				}
			}
		}
		//return $query;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		//
		$page = $request->input('page', 1);
		$pageSize = $request->input('pageSize', 10);
		$sort = $request->input('sort', 'id asc');
		$entity = $this->newEntity();
		$query = $entity->query();
		$this->fillQueryForIndex($request, $query);
		$count = $query->count();
		$arr = explode(',', $sort);
		//var_dump($arr);
		foreach ($arr as $order) {
			$tmpArr = explode(' ', trim($order));
			$query->orderBy($tmpArr[0], $tmpArr[1]);
		}
		$data = $query->take($pageSize)->skip(($page - 1) * $pageSize)->get();
		//LogSvr::apiSql()->info($query->toSql());
		return $this->success(['count' => $count, 'list' => $data, 'page' => $page, 'pageSize' => $pageSize]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
		$data = $request->all();
		unset($data['_sign']);
		$entity = $this->newEntity($data);
	    $fieldErrors = $this->validateFields($data);
	    if (!empty($fieldErrors)) {
	    	$msg = $this->formatFieldErrors($fieldErrors, $entity->fieldNames);
		    return $this->fail($msg);
	    }
		$res = $entity->save();
		return $res ? $this->success($entity) : $this->fail('store fail');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
		if ($id == 0) {
			return $this->fail('id is empty');
		} else {
			$entity = $this->newEntity()->newQuery()->find($id);
			// var_dump($entity);
			return $this->success($entity);
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
		$entity = $this->newEntity()->newQuery()->find($id);
		$data = $request->all();
		unset($data['_sign']);
		$entity->fill($data);
		$re = $entity->save();
		return $re ? $this->success($re) : $this->fail('update fail!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
		$entity = $this->newEntity()->newQuery()->find($id);
		$re = $entity->delete();
		return $re ? $this->success($re) : $this->fail('destroy fail');
	}

	protected function validateFields($data, $all = false)
	{
		$fieldErrors = [];
		$entity = $this->newEntity();
		if (isset($entity->validateRules)) {
			if($all){
				$rules = $entity->validateRules;
			}else {
				$rules = [];
				foreach ($data as $k => $v) {
					if (array_key_exists($k, $entity->validateRules)) {
						$rules[$k] = $entity->validateRules[$k];
					}
				}
			}
			$validator = Validator::make($data, $rules);
			if ($validator->fails()) {
				$errors = $validator->errors();
				$keys = $errors->keys();
				foreach ($keys as $k) {
					$fieldErrors[] = ['name' => $k, 'status' => $errors->first($k)];
				}
			}
		}
		return $fieldErrors;
	}

	protected function formatFieldErrors(array $fieldErrors, array $fieldNames){
		if(empty($fieldErrors) || empty($fieldNames))
			return '';
		$result = [];
		foreach ($fieldErrors as $error){
			$field = $error['name'];
			if(array_key_exists($field, $fieldNames)) {
				$result[] = str_replace($field, $fieldNames[$field], $error['status']);
			}else{
				$result[] = $error['status'];
			}
		}
		return implode(',', $result);
	}

	public function success($data, $msg = ''){
		return response()->json(['data' => $data, 'code' => 200, 'msg' => $msg, 'success' => true]);
	}

	public function fail($msg){
		return response()->json(['data' => null, 'code' => 401, 'msg' => $msg, 'success' => false]);
	}

}
