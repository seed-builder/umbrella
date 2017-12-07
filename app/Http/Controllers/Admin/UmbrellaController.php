<?php

namespace App\Http\Controllers\Admin;

use App\Models\Equipment;
use App\Models\Price;
use App\Models\Site;
use App\Models\ViewUmbrella;
use App\Services\ExcelService;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Umbrella;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

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
//        $equipments = Equipment::all();
//        $sites = Site::all();
        $prices = Price::all();
        return view('admin.umbrella.index', compact('prices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $equipments = Equipment::all();
        $sites = Site::all();
        return view('admin.umbrella.create', compact('equipments', 'sites'));
    }

    public function store(Request $request, $only = [], $extraFields = [], $redirect_url = null)
    {
        $data = $request->all();

        if (empty($data['start_index']) || empty($data['start_index'])) {
            return $this->fail_result('伞编号区间不能为空');
        }

        $ep = Equipment::find($data['equipment_id']);

        $umbrellas = [];
        for ($i = $data['start_index']; $i <= $data['end_index']; $i++) {
            $umbrellas[] = [
                'sn' => $i,
                'birth_site_id' => !empty($ep->site_id) ? $ep->site_id : 0,
                'birth_equipment_id' => $data['equipment_id'],
                'status' => $data['status'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        DB::table('umbrellas')->insert($umbrellas);

        return $this->success_result('新增成功');
    }

    public function entityQuery()
    {
        return ViewUmbrella::query();
    }

    /**
     * Display the specified resource.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entity = Umbrella::find($id);
        return view('admin.umbrella.edit', ['entity' => $entity]);
    }

    /**
     * Display the specified resource.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entity = Umbrella::find($id);
        return view('admin.umbrella.show', ['entity' => $entity]);
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
        $searchCols = ["color", "logo", "name", "sn"];
        return parent::pagination($request, $searchCols, $with, $conditionCall, $dataHandleCall, true);
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

    public function importExcel(Request $request)
    {
        $data = $request->all();
        if (empty($data['excel'])) {
            return response()->json([
                'error' => '请选择一个文件'
            ]);
        }
        $file = $data['excel'];

        if (!$file) {
            return false;
        }

        $path = storage_path() . '/app/excel-file/';
        $filename = date("YmdHis") . uniqid() . '.xls';

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file->move(
            $path,
            $filename
        );

        $excel = new ExcelService();
        $results = $excel->import($path . $filename);

        if ($results[0] == ['伞编码','RFID（机器识别码）']){
            return $this->fail_result('Excel格式不对');
        }

        if (count($results) > 2000)
            return $this->fail_result('数量过大，尽量控制在2000条记录以内');
            unset($results[0]);

        $umbrellas = [];
        $price = new Price();

        DB::beginTransaction();

        try {
            foreach ($results as $result) {
                $umbrellas[] = [
                    'number' => (string)$result[0],
                    'sn' => $result[1],
//                    'price_id' => $price->getUsingPrice()->id,
                    'price_id' => $data['price_id'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }

            DB::table('umbrellas')->insert($umbrellas);;

            DB::commit();
        }catch (Exception $e){
            return $this->fail_result('导入失败，Excel中有数据异常');
            DB::rollback();
        }


        return $this->success_result('导入成功');

    }

    public function downTemplate(){
        $excel = new ExcelService();

        $data = [['伞编码','RFID（机器识别码）']];
        for ($i=0;$i<1000;$i++){
            $data[] = ['',''];
        }
        $excel->export($data,'柒天伞客共享伞导入模板');
    }

    public function batchPrice(Request $request){
        $ids = $request->input('ids');
        $priceId = $request->input('price_id');
        if(!empty($priceId) && !empty($ids)){
            $umbrellaIds = explode(',', $ids);
            $res = Umbrella::whereIn('id', $umbrellaIds)->update(['price_id' => $priceId]);
            return $res ? $this->success('成功'):$this->fail('失败');
        }else{
            return $this->fail('data is empty');
        }
    }

    /**
     *
     */
    public function reset(Request $request){
        $ids = $request->input('id');

        $ids_arr = explode(',',$ids);

        Umbrella::whereIn('id',$ids_arr)->update([
            'site_id' => 0,
            'equipment_id' => 0,
            'status' => Umbrella::STATUS_INIT,
            'equipment_channel_num' => 0,
        ]);
//        dd($ids);
//        $umbrella = Umbrella::find($id);
//        $umbrella->site_id = 0;
//        $umbrella->equipment_id = 0;
//
//        $umbrella->save();

        return $this->success_result('初始化该伞成功');
    }
}
