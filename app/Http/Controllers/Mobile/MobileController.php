<?php

namespace App\Http\Controllers;

use App\Models\SysLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

/**
 * controller for UI Plugins: Datatables , Editor
 * Class DataTableController
 * @package App\Http\Controllers
 */
abstract class MobileController extends Controller
{
    public abstract function newEntity(array $attributes = []);

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param array $extraFields
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request, $only = [], $extraFields = [], $successMsg = null)
    {
        if (!empty($only)) {
            $props = $request->only($only);
        } else {
            $props = $request->except('_token');
        }
        $fieldErrors = $this->validateFields($props);

        if (!empty($fieldErrors)) {
            return $this->fail_result($fieldErrors);
        } else {
            if (!empty($extraFields)) {
                $props += $extraFields;
            }
            $entity = $this->newEntity($props);
            $entity->save();

            return $this->success_result($successMsg, $entity);

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
    public function update(Request $request, $id, $only = [], $extraFields = [], $successMsg = null)
    {
        $fieldErrors = $this->validateFields($request->except('_token'));
        if (!empty($only)) {
            $props = $request->only($only);
        } else {
            $props = $request->except('_token');
        }

        if (!empty($fieldErrors)) {
            return $this->fail_result($fieldErrors);
        } else {
            if (!empty($extraFields)) {
                $props += $extraFields;
            }
            $entity = $this->newEntity()->newQuery()->find($id);
            $entity->fill($props);


            $entity->save();

            return $this->success_result('编辑成功', $entity);
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
        $entity = $this->newEntity()->newQuery()->find($id);

        $entity->delete();

        return $this->success_result('删除成功');
    }

    /**
     * 实体的查询
     * @return  \Illuminate\Database\Eloquent\Builder
     */
    public function entityQuery()
    {
        return $this->newEntity()->newQuery();
    }

    /**
     * Datatables UI page
     * @param Request $request
     * @param array $searchCols
     * @param array $with
     * @param null $conditionCall
     * @param bool $all_columns
     * @return \Illuminate\Http\JsonResponse
     * @internal param array $columns
     */
    public function pagination(Request $request, $with = [], $conditionCall = null, $dataHandleCall = null)
    {
        $length = $request->input('length', 10);
        $draw = $request->input('draw', 0);
        $filters = $request->input('filter', []);

        $queryBuilder = $this->entityQuery(); //$this->newEntity()->newQuery();

        if (!empty($with)) {
            $queryBuilder->with($with);
        }

        if ($conditionCall != null && is_callable($conditionCall)) {
            $conditionCall($queryBuilder);
        }

        $this->filterQuery($filters, $queryBuilder);

        if (!empty($fields)) {
            $queryBuilder->select($fields);
        }

        $start = $draw > 1 ? ($draw - 1) * 10 + 1 : 0;
        $entities = $queryBuilder->skip($start)->take($length)->get();

        //数据处理
        if ($dataHandleCall != null && is_callable($dataHandleCall)) {
            $dataHandleCall($entities);
        }

        $result = [
            'draw' => $draw,
            'data' => $entities
        ];
        return response()->json($result);
    }

    protected function validateFields($data, $rules = [])
    {
        $fieldErrors = [];
        $entity = $this->newEntity();

        if (empty($rules) && isset($entity->validateRules))
            $rules = $entity->validateRules;

        $validator = Validator::make($data, $rules, $entity->validateMessages);

        if ($validator->fails()) {
            $fieldErrors = implode('<br/>', $validator->errors()->all());
        }

        return $fieldErrors;
    }

    public function success_result($msg, $data = [])
    {
        Session::flash('success', $msg);

        return $this->result(0, $msg, $data);
    }

    public function fail_result($msg, $code = 500)
    {
        return $this->result($code,$msg );
    }

    public function result($code = 0, $msg, $data = [])
    {
        return response()->json([
            'code' => $code,
            'message' => $msg,
            'data' => $data
        ]);
    }

    public function filterQuery($filters, $queryBuilder)
    {
        foreach ($filters as $filter) {
            foreach ($filter as $k => $v)
                if (!empty($v)) {
                    $queryBuilder->where($k, 'like binary', '%' . $v . '%');
                }
        }
    }
}
