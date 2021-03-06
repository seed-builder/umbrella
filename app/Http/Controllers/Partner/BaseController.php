<?php
/**
 * Created by PhpStorm.
 * User: asus1
 * Date: 2018/1/11
 * Time: 11:05
 */

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\DataTableController;


class BaseController extends DataTableController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function newEntity(array $attributes = [])
    {
        // TODO: Implement newEntity() method.
    }

    public function filterQuery($filters,$queryBuilder){
        foreach ($filters as $filter) {
            foreach ($filter as $k => $v)
                if (!empty($v)) {
                    $queryBuilder->where($k, 'like binary', '%' . $v . '%');
                }
        }
    }
}