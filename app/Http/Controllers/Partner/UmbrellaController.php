<?php
namespace App\Http\Controllers\Partner;

use App\Models\Price;
use App\Models\ViewUmbrella;
use Illuminate\Http\Request;
use App\Http\Controllers\Partner\BaseController;
use App\Models\Umbrella;
use Illuminate\Support\Facades\Auth;

class UmbrellaController extends BaseController
{
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new Umbrella($attributes);
	}

	/**
	* Display a listing of the resource.
	*
	* @return  \Illuminate\Http\Response
	*/
	public function index()
	{
        $prices = Price::all();
		return view('partner.umbrella.index', compact('prices'));
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return  \Illuminate\Http\Response
	*/
	public function create()
	{
		return view('partner.umbrella.create');
	}

	/**
	* Display the specified resource.
	*
	* @param    int  $id
	* @return  \Illuminate\Http\Response
	*/
	public function edit($id)
	{
		$entity = Umbrella::find($id);
		return view('partner.umbrella.edit', ['entity' => $entity]);
	}

	/**
	* Display the specified resource.
	*
	* @param    int  $id
	* @return  \Illuminate\Http\Response
	*/
	public function show($id)
	{
		$entity = Umbrella::find($id);
		return view('partner.umbrella.show', ['entity' => $entity]);
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

			$queryBuilder->whereIn('equipment_id',$equipment_ids);
		});
	}

    public function entityQuery()
    {
        return ViewUmbrella::query();
    }

    public function filterQuery($filters, $queryBuilder)
    {
        foreach ($filters as $filter) {
            foreach ($filter as $k => $v) {
                if (empty($v)) {
                    continue;
                }
                switch ($k) {
                    case 'start_created_at': {
                        $queryBuilder->where('created_at', '>=', $v);
                        break;
                    }
                    case 'end_created_at': {
                        $queryBuilder->where('created_at', '<=', $v);
                        break;
                    }
                    default : {
                        $queryBuilder->where($k, 'like binary', '%' . $v . '%');
                    }
                }
            }

        }
    }

}
