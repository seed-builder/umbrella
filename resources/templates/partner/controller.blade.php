{!! $BEGIN_PHP !!}
<?php
		$searchCols = [];
		foreach ($columns as $col){
			if($col->data_type == 'string'){
				$searchCols[] = $col->name;
			}
		}

?>
namespace App\Http\Controllers\Partner;

use Illuminate\Http\Request;
use App\Http\Controllers\Partner\BaseController;
use App\Models\{{$model}};
use Illuminate\Support\Facades\Auth;

class {{$model}}Controller extends BaseController
{
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new {{$model}}($attributes);
	}

	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		//
		return view('partner.{{snake_case($model,'-')}}.index');
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create()
	{
		return view('partner.{{snake_case($model,'-')}}.create');
	}

	/**
	* Display the specified resource.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function edit($id)
	{
		$entity = {{$model}}::find($id);
		return view('partner.{{snake_case($model,'-')}}.edit', ['entity' => $entity]);
	}

	/**
	* Display the specified resource.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function show($id)
	{
		$entity = {{$model}}::find($id);
		return view('partner.{{snake_case($model,'-')}}.show', ['entity' => $entity]);
	}

	/**
	* @param Request $request
	* @param array $searchCols
	* @param array $with
	* @param null $conditionCall
	* @param bool $all_columns
	* @return \Illuminate\Http\JsonResponse
	*/
	public function pagination(Request $request, $searchCols = [], $with=[], $conditionCall = null, $dataHandleCall = null, $all_columns = false){

		return parent::pagination($request,$searchCols,$with,function($queryBuilder){
			$partner = Auth::guard('partner')->user();
			$equipment_ids = $partner->equipments->pluck('id')->toArray();

			$queryBuilder->whereIn('equipment_id',$equipment_ids);
		});
	}

}
