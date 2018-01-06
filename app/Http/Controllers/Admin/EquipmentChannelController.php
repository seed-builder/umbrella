<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Models\EquipmentChannel;

class EquipmentChannelController extends BaseController
{
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new EquipmentChannel($attributes);
	}

	/**
	* Display a listing of the resource.
	*
	* @return  \Illuminate\Http\Response
	*/
	public function index()
	{
		//
		return view('admin.equipment-channel.index');
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return  \Illuminate\Http\Response
	*/
	public function create()
	{
		return view('admin.equipment-channel.create');
	}

	/**
	* Display the specified resource.
	*
	* @param    int  $id
	* @return  \Illuminate\Http\Response
	*/
	public function edit($id)
	{
		$entity = EquipmentChannel::find($id);
		return view('admin.equipment-channel.edit', ['entity' => $entity]);
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
	* @param  array $with
	* @param  null $conditionCall
	* @param  bool $all_columns
	* @return  \Illuminate\Http\JsonResponse
	*/
	public function pagination(Request $request, $searchCols = [], $with=[], $conditionCall = null, $dataHandleCall = null, $all_columns = false){
		$searchCols = [];
		return parent::pagination($request, $searchCols);
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param array $extraFields
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,  $only = [], $extraFields = [], $redirect_url = null)
    {
        $data = $request->input('data', []);
        if (empty($data))
            return $this->fail('data is empty');
        //$props = current($data);
        $props = $this->beforeSave(current($data));
        $fieldErrors = $this->validateFields($props);
        if (!empty($fieldErrors)) {
            return $this->fail('validate error', $fieldErrors);
        } else {
            if (!empty($extraFields)) {
                $props += $extraFields;
            }
            $entity = $this->newEntity($props);
            $entity->save();
            return $this->success($entity);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @param array $extraFields
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $only = [], $extraFields = [], $redirect_url = null)
    {
        //
        $data = $request->input('data', []);
        if (empty($data))
            return $this->fail('data is empty');

        //$props = current($data);
        $props = $this->beforeSave(current($data));
        $fieldErrors = $this->validateFields($props);
        if (!empty($fieldErrors)) {
            return $this->fail('validate error', $fieldErrors);
        } else {
            if (!empty($extraFields)) {
                $props += $extraFields;
            }
            $entity = $this->newEntity()->newQuery()->find($id);
            $entity->fill($props);
            $entity->save();
            $this->afterSave($entity);
            return $this->success($entity);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //var_dump($id);
        $entity = $this->newEntity()->newQuery()->find($id);
        //var_dump($entity);
        $entity->delete();
        //$entity = [];
        return $this->success($entity);
    }


}
