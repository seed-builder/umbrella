<?php
namespace App\Http\Controllers\Admin;

use App\Models\Equipment;
use App\Models\Site;
use App\Models\ViewUmbrella;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Umbrella;
use Illuminate\Support\Facades\DB;

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
        $equipments = Equipment::all();
        $sites = Site::all();
        return view('admin.umbrella.index', compact('equipments', 'sites'));
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
