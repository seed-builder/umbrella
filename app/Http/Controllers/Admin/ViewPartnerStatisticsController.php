<?php

namespace App\Http\Controllers\Admin;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Models\ViewPartnerStatistics;

class ViewPartnerStatisticsController extends BaseController
{
    public function newEntity(array $attributes = [])
    {
        // TODO: Implement newEntity() method.
        return new ViewPartnerStatistics($attributes);
    }

    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = Partner::all();
        return view('admin.view-partner-statistics.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.view-partner-statistics.create');
    }

    /**
     * Display the specified resource.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entity = ViewPartnerStatistics::find($id);
        return view('admin.view-partner-statistics.edit', ['entity' => $entity]);
    }

    /**
     * Display the specified resource.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entity = ViewPartnerStatistics::find($id);
        return view('admin.view-partner-statistics.show', ['entity' => $entity]);
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
        $searchCols = ["equipments_sn", "partner_fullname", "partner_name", "site_name"];
        return parent::pagination($request, $searchCols);
    }

    public function statistics(Request $request)
    {
        $data = $request->all();

        $query = $this->newEntity()->newQuery();
        $this->filterQuery($data['filter'],$query);

        return $this->success_result('',[
            'deposit' => $query->sum('deposit_amt'),
            'amt' => $query->sum('hire_amt'),
        ]);
    }

    public function filterQuery($filters, $queryBuilder)
    {
        foreach ($filters as $filter) {
            foreach ($filter as $k => $v) {
                if (empty($v)) {
                    continue;
                }
                switch ($k) {
                    case 'partner_id': {
                        $queryBuilder->where('partner_id', $v);
                        break;
                    }
                    case 'start_created_at': {
                        $queryBuilder->where('created_at', '>=', $v);
                        break;
                    }
                    case 'end_created_at': {
                        $queryBuilder->where('created_at', '<=', $v);
                        break;
                    }
                    case 'filter_no_partner': {
                        $queryBuilder->where('partner_id', '!=', 0);
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
