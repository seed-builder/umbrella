<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Permission;
use Symfony\Component\Yaml\Yaml;

class PermissionController extends BaseController
{
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new Permission($attributes);
	}

	/**
	* Display a listing of the resource.
	*
	* @return  \Illuminate\Http\Response
	*/
	public function index()
	{
		//
		$topPermissions = Permission::where('pid', 0)->get();
		$perOptions = [['label' => 'root', 'value' => 0]];
		foreach ($topPermissions as $per) {
			$this->toSelectOption($per, ['label' => 'display_name', 'value' => 'id'], $perOptions);
		}
		$res = storage_path('resources/icon.yml');
		$result = Yaml::parse(file_get_contents($res));
		$icons = $result['icons'];
		return view('admin.permission.index', compact('perOptions','icons'));
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return  \Illuminate\Http\Response
	*/
	public function create()
	{
		return view('admin.permission.create');
	}

	/**
	* Display the specified resource.
	*
	* @param    int  $id
	* @return  \Illuminate\Http\Response
	*/
	public function edit($id)
	{
		$entity = Permission::find($id);
		return view('admin.permission.edit', ['entity' => $entity]);
	}

	/**
	* Display the specified resource.
	*
	* @param    int  $id
	* @return  \Illuminate\Http\Response
	*/
	public function show($id)
	{
		//
	}

	/**
	 * @param  Request $request
	 * @param  array $searchCols
	 * @param array $with
	 * @param null $conditionCall
	 * @param bool $all_columns
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function pagination(Request $request, $searchCols = [], $with = [], $conditionCall = null, $all_columns = false){
		$searchCols = ["description","display_name","name"];
		return parent::pagination($request, $searchCols);
	}

	public function tree(){
		$tops = Permission::where('pid', 0)->orderBy('sort')->get();
		$tree = ['text' => 'root', 'selectable' => false, 'state' => [ 'expanded' => true ], 'nodes' => []];
		foreach ($tops as $top)
			$tree['nodes'][] = $this->toBootstrapTreeViewData($top,  ['text' => 'display_name', 'dataid' => 'id', 'icon' => 'icon'], false);
		return response()->json([$tree]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param array $extraFields
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, $extraFields=[])
	{
		//
		$data = $request->all();
		unset($data['_token']);
		if($data['id']){
			$entity = Permission::find($data['id']);
			$entity->fill($data);
			$entity->save();
		}else{
			$entity = Permission::create($data);
		}
		return $this->success($entity);
	}

}
