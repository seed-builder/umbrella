<?php

namespace App\Http\Controllers\Admin;

use App\Models\Price;
use App\Models\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Equipment;
use Illuminate\Support\Facades\DB;

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
        $prices = Price::all();
        return view('admin.equipment.index', compact('sites','prices'));
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

    public function store(Request $request, $only = [], $extraFields = [], $redirect_url = null)
    {
        $data = $request->all();

        $fieldErrors = [];
        $entities = [];
        foreach ($data['data'] as $k=>$item){
            $error = $this->validateFields($item);
            if (!empty($error))
                $fieldErrors[] = '第'.($k+1).'条'.$error.'<br/>';

            $item['created_at'] = date('Y-m-d H:i:s');
            $item['updated_at'] = date('Y-m-d H:i:s');
            $entities[] = $item;
        }

        if (!empty($fieldErrors))
            return $this->fail_result($fieldErrors);

        DB::table('equipments')->insert($entities);

        return $this->success_result('添加成功', [],'/admin/equipment');

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
        return parent::pagination($request, $searchCols, ['site','price'], function ($query) use ($request) {
            $partner_id = $request->input('partner_id');
            if (!empty($partner_id))
                $query->where('partner_id',$partner_id);

        }, function ($entities) {
            foreach ($entities as $entity) {
                $entity->status_name = $entity->status();
            }
        });
    }

    public function batchPrice(Request $request){
        $ids = $request->input('ids');
        $priceId = $request->input('price_id');
        if(!empty($priceId) && !empty($ids)){
            $equipment_ids = explode(',', $ids);
            $res = Equipment::whereIn('id', $equipment_ids)->update(['price_id' => $priceId]);
            return $res ? $this->success_result('批量设置价格成功'):$this->success_result('批量设置价格失败');
        }else{
            return $this->fail('data is empty');
        }
    }

}
