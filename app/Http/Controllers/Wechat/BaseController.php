<?php

namespace App\Http\Controllers\Wechat;

use App\Models\Resources;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Closure;
use Validator;
use Illuminate\Support\Facades\Session;

abstract class BaseController extends Controller
{

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('api.sign');
    }

    public abstract function newEntity(array $attributes = []);

    /**
     * 数据新增
     * @param null $redirect_url
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $extraFields = [])
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
                $props = array_merge($props, $extraFields);
            }

            $entity = $this->newEntity($props);
            $entity->save();

            return $this->success_result('添加成功', $entity);
        }
    }

    /**
     * 数据修改
     * @param $id
     * @param null $redirect_url
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id, $extraFields = [])
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
                $props = array_merge($props, $extraFields);
            }
            $entity = $this->newEntity()->newQuery()->find($id);
            $entity->fill($props);
            $entity->save();

            return $this->success_result('编辑成功', $entity);
        }

    }

    /**
     * 数据删除
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {

        $this->newEntity()->newQuery()->where('id', $id)->delete();

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
     * 数据查询&过滤&分页
     * @return \Illuminate\Http\JsonResponse
     */
    public function pagination(Request $request, $with = [], $conditionCall = null, $dataHandleCall = null)
    {
        $start = $request->input('start', 0);
        $length = $request->input('length', -1);
        $draw = $request->input('draw', 0);

        $queryBuilder = $this->entityQuery(); //$this->newEntity()->newQuery();

        if (!empty($with)) {
            $queryBuilder->with($with);
        }

        $queryBuilder->orderBy('created_at', 'desc');
        if ($conditionCall != null && is_callable($conditionCall)) {
            $conditionCall($queryBuilder);
        }

        if ($length == -1)
            $entities = $queryBuilder->get();
        else
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

    /**
     * 数据验证
     * @param $data
     * @param array $rules
     * @return array|string
     */
    protected function validateFields($data, $rules = [])
    {
        $fieldErrors = [];
        $entity = $this->newEntity();

        if (empty($rules) && isset($entity->validateRules))
            $rules = $entity->validateRules;

        if (session('lang') == 'en')
            $entity->validateMessages = [];

        $validator = Validator::make($data, $rules, $entity->validateMessages);

        if ($validator->fails()) {
            $fieldErrors = implode('<br/>', $validator->errors()->all());
        }

        return $fieldErrors;
    }

    /**
     *
     */
    public function show($id, $call = null)
    {
        $entity = $this->newEntity()->newQuery()->find($id);

        if ($call != null && is_callable($call)) {
            $call($entity);
        }

        return $this->success_result('success', $entity);
    }

    /**
     * 成功时返回
     * @param $msg
     * @param array $data
     * @param null $redirect_url
     * @return \Illuminate\Http\JsonResponse
     */
    public function success_result($msg, $data = [])
    {
        $result = [];

        $result['result_code'] = 0;
        $result['result_msg'] = $msg;
        $result['data'] = $data;

        return response()->json($result);
    }

    /**
     * 失败时返回
     * @param $msg
     * @return \Illuminate\Http\JsonResponse
     */
    public function fail_result($msg, $code = 500)
    {
        $result = [];

        $result['result_code'] = $code;
        $result['result_msg'] = $msg;

        return response()->json($result);
    }


}
