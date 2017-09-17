<?php
namespace App\Http\Controllers\Admin;

use App\Models\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Equipment;

class EquipmentController extends BaseController
{
    public function newEntity(array $attributes = [])
    {
        // TODO: Implement newEntity() method.
        return new Equipment($attributes);
    }

    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $sites = Site::all();
        return view('admin.equipment.index', compact('sites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $sites = Site::all();
        return view('admin.equipment.create', compact('sites'));
    }

    /**
     * Display the specified resource.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entity = Equipment::find($id);
        $sites = Site::all();
        return view('admin.equipment.edit', ['entity' => $entity, 'sites' => $sites]);
    }

    /**
     * Display the specified resource.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entity = Equipment::find($id);
        return view('admin.equipment.show', ['entity' => $entity]);
    }

    /**
     * @param  Request $request
     * @param  array $searchCols
     * @param  array $with
     * @param  null $conditionCall
     * @param  bool $all_columns
     * @return  \Illuminate\Http\JsonResponse
     */
    public function pagination(Request $request, $searchCols = [], $with = [], $conditionCall = null, $dataHandleCall = null, $all_columns = false)
    {
        $searchCols = ["ip", "sn"];
        return parent::pagination($request, $searchCols, ['site'],$conditionCall,function($entities){
            foreach ($entities as $entity){
                $entity->status_name = $entity->status();
            }
        });
    }

}
