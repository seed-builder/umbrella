<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Closure;
use Validator;
use Illuminate\Support\Facades\Session;

/**
 * controller for UI Plugins: Datatables , Editor
 * Class DataTableController
 * @package App\Http\Controllers
 */
abstract class DataTableController extends Controller
{

    public abstract function newEntity(array $attributes = []);

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param array $extraFields
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request, $only = [], $extraFields = [], $redirect_url = null)
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
                $props = array_merge($props,$extraFields);
            }

            $entity = $this->newEntity($props);
            $entity->save();

            return $this->success_result('添加成功', $entity, $redirect_url);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
                $props = array_merge($props,$extraFields);
            }
            $entity = $this->newEntity()->newQuery()->find($id);
            $entity->fill($props);
            $entity->save();

            return $this->success_result('编辑成功', $entity, $redirect_url);
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
    public function pagination(Request $request, $searchCols = [], $with = [], $conditionCall = null, $dataHandleCall = null, $all_columns = false)
    {
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $columns = $request->input('columns', []);
        $order = $request->input('order', []);
        $search = $request->input('search', []);
        $draw = $request->input('draw', 0);
        $filters = $request->input('filter', []);

        $queryBuilder = $this->entityQuery(); //$this->newEntity()->newQuery();

        if (!empty($with)) {
            $queryBuilder->with($with);
        }

        $fields = [];
        $conditions = [];
        foreach ($columns as $column) {
            if (!$all_columns)
                $fields[] = $column['data'];
            if (!empty($column['search']['value'])) {
                $conditions[$column['data']] = $column['search']['value'];
            }
        }

        $total = $queryBuilder->count();

        $queryBuilder->orderBy('created_at','desc');
        if ($conditionCall != null && is_callable($conditionCall)) {
            $conditionCall($queryBuilder);
        }
        foreach ($conditions as $col => $val) {
            $queryBuilder->where($col, $val);
        }

        $this->filterQuery($filters, $queryBuilder);

        //模糊查询
        if (!empty($searchCols) && !empty($search['value'])) {
            $queryBuilder->where(function ($query) use ($search, $searchCols) {
                foreach ($searchCols as $sc) {
                    $query->orWhere($sc, 'like binary', '%' . $search['value'] . '%');
                }
            });
        }

        $filterCount = $queryBuilder->count();

        foreach ($order as $o) {
            $index = $o['column'];
            $dir = $o['dir'];
            $queryBuilder->orderBy($columns[$index]['data'], $dir);
        }

        if (!empty($fields)) {
            $queryBuilder->select($fields);
        }
        $entities = $queryBuilder->skip($start)->take($length)->get();

        //数据处理
        if ($dataHandleCall != null && is_callable($dataHandleCall)) {
            $dataHandleCall($entities);
        }

        $result = [
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $filterCount,
            'data' => $entities
        ];
        return response()->json($result);
    }

    public function exportExcel(Request $request, $searchCols = [], $with = [], $conditionCall = null)
    {
        $filters = $request->input('filter', []);

        $queryBuilder = $this->entityQuery(); //$this->newEntity()->newQuery();

        if (!empty($with)) {
            $queryBuilder->with($with);
        }

        $queryBuilder->orderBy('created_at','desc');
        if ($conditionCall != null && is_callable($conditionCall)) {
            $conditionCall($queryBuilder);
        }

        $this->filterQuery($filters, $queryBuilder);

        //模糊查询
        if (!empty($searchCols) && !empty($search['value'])) {
            $queryBuilder->where(function ($query) use ($search, $searchCols) {
                foreach ($searchCols as $sc) {
                    $query->orWhere($sc, 'like binary', '%' . $search['value'] . '%');
                }
            });
        }

        $entities = $queryBuilder->get();

        $this->export($entities);
    }

    public function export($entities){
        throw new \Exception("need implement");
    }

    protected function validateFields($data, $rules=[])
    {
        $fieldErrors = [];
        $entity = $this->newEntity();

        if (empty($rules) && isset($entity->validateRules))
            $rules = $entity->validateRules;
        if(!empty($rules)) {
            $validator = Validator::make($data, $rules, $entity->validateMessages);

            if ($validator->fails()) {
                $fieldErrors = implode('<br/>', $validator->errors()->all());
            }
        }
        return $fieldErrors;
    }

    public function success($data, $msg = '')
    {
        return response()->json(['data' => [$data], 'cancelled' => 0 , 'success' => true, 'msg' => $msg]);
    }

    public function fail($error, $fieldErrors = [])
    {
        return response()->json(['data' => [], 'error' => $error, 'cancelled' => 1, 'fieldErrors' => $fieldErrors,  'success' => false]);
    }

    public function flash_success($msg)
    {
        Session::flash('success', $msg);
    }

    public function flash_alert($msg)
    {
        Session::flash('message', $msg);
    }

    public function flash_error($msg)
    {
        Session::flash('error', $msg);
    }

    public function success_result($msg, $data = [], $redirect_url = null)
    {
        $result = [];
        Session::flash('success', $msg);

        $result['success'] = true;
        $result['msg'] = $msg;
        $result['data'] = $data;
        if (!empty($redirect_url))
            $result['redirect_url'] = $redirect_url;

        return response()->json($result);
    }

    public function fail_result($msg)
    {
        return response()->json([
            'success' => false,
            'error' => $msg
        ]);
    }

    /**
     * 将实体数据转换成树形（bootstrap treeview）数据
     * @param $entity
     * @param $props 属性映射集合 ['text' => 'name', 'data-id' => 'id']
     * @param bool $expanded
     * @return array
     */
    public function toBootstrapTreeViewData($entity, $props, $expanded = true)
    {
        $data = ['item' => $entity];
        if (!empty($entity)) {
            foreach ($props as $k => $val) {
                $data[$k] = $entity->{$val};
                $data['state']['expanded'] = $expanded;
            }

            if (!empty($entity->children)) {
                $nodes = [];
                foreach ($entity->children as $child) {
                    $nodes[] = $this->toBootstrapTreeViewData($child, $props, $expanded);
                }
                if (!empty($nodes))
                    $data['nodes'] = $nodes;
            }
        }
        return $data;
    }

    /**
     *
     * @param $entity
     * @param $props
     * @param $options
     * @param string $prefix
     */
    public function toSelectOption($entity, $props, &$options, $prefix = '|--')
    {
        //$options = [];
        if (!empty($entity)) {
            $data = [];
            foreach ($props as $k => $val) {
                if ($k == 'label') {
                    $data[$k] = $prefix . ' ' . $entity->{$val};
                } else {
                    $data[$k] = $entity->{$val};
                }
            }
            $options[] = $data;
            if (!empty($entity->children)) {
                foreach ($entity->children as $child) {
                    $this->toSelectOption($child, $props, $options, $prefix . '-----|--');
                }
            }
        }
        //return $options;
    }

    /*
     * 查询过滤器
     */
    public function filter($queryBuilder, $filterdata)
    {
        foreach ($filterdata as $f) {
            if (!empty($f['value'])) {
                $operator = !empty($f['operator']) ? $f['operator'] : '=';

                if ($operator == 'like')
                    $queryBuilder->where($f['name'], $operator, '%' . $f['value'] . '%');
                else
                    $queryBuilder->where($f['name'], $operator, $f['value']);
            }
        }
    }

    /**
     * 保存前, 过滤只读字段
     * @param $props
     * @return array
     */
    protected function beforeSave($props)
    {
        $result = [];
        //parent::beforeSave($props); // TODO: Change the autogenerated stub
        if (!empty($props)) {
            foreach ($props as $k => $v) {
                if (str_contains($k, 'readonly_'))
                    continue;
                $result[$k] = $v;
            }
        }
        return $result;
    }

    protected function afterSave($model)
    {

    }

}
