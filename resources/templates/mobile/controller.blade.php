
namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Mobile\MobileController;
use App\Models\{{$model}};

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
		return view('mobile.{{snake_case($model,'-')}}.index');
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create()
	{
		return view('mobile.{{snake_case($model,'-')}}.create');
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
		return view('mobile.{{snake_case($model,'-')}}.edit', ['entity' => $entity]);
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
		return view('mobile.{{snake_case($model,'-')}}.show', ['entity' => $entity]);
	}

	/**
	* @param Request $request
	* @param array $searchCols
	* @param array $with
	* @param null $conditionCall
	* @param bool $all_columns
	* @return \Illuminate\Http\JsonResponse
	*/
	public function pagination(Request $request, $with=[], $conditionCall = null, $dataHandleCall = null){
		return parent::pagination($request, $searchCols);
	}

}
