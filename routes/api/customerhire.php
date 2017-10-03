<?php
/**
* @SWG\Resource(
*  resourcePath="/customer-hire",
*  description="CustomerHire"
* )
*/
Route::group(['prefix' => 'customer-hire', 'middleware' => 'api.sign'], function () {

    /**
     * @SWG\Api(
     *     path="/api/customer-hire/check-nph",
     *     @SWG\Operation(
     *      method="GET",
     *      nickname="customer-hire-check-nph",
     *      summary="查询用户未完成租借单",
     *      notes="查询用户未完成租借单",
     *      type="",
     *      @SWG\Parameters(
     *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="query", defaultValue="****")
     *      )
     *  )
     * )
     */
    Route::get('/customer/no-completes', ['uses' => 'CustomerHireController@customerNoCompletes']);

    /**
    * @SWG\Api(
    *     path="/api/customer-hire",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="customer-hire-list",
    *      summary="page list",
    *      notes="page list",
    *      type="array",
    *     items="$ref:CustomerHire",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="page", description="当前页", required=false, type="integer", paramType="query", defaultValue="1"),
    *          @SWG\Parameter(name="pageSize", description="页大小", required=false, type="integer", paramType="query", defaultValue="10"),
    *          @SWG\Parameter(name="sort", description="排序", required=false, type="string", paramType="query", defaultValue="id asc"),
    *          @SWG\Parameter(name="search", description="查询条件（数组的json格式, 键里面可带有比较符号，不带默认为: =）", required=false, type="string", paramType="query", defaultValue="{&quot;id >=&quot;:1}"),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="query", defaultValue="****")
    *      )
    *    )
    * )
    */
    Route::get('/', ['as' => 'CustomerHire.index', 'uses' => 'CustomerHireController@index']);

    /**
    * @SWG\Api(
    *     path="/api/customer-hire/{id}",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="customer-hire-show",
    *      summary="信息详情",
    *      notes="信息详情",
    *      type="CustomerHire",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="id", description="id", required=true, type="integer", paramType="path", defaultValue="1"),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="query", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::get('/{id}', ['as' => 'CustomerHire.show', 'uses' => 'CustomerHireController@show']);

    /**
    * @SWG\Api(
    *     path="/api/customer-hire",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="customer-hire-store",
    *      summary="新增",
    *      notes="新增",
    *      type="CustomerHire",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="created_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="creator_id", description="创建用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="customer_id", description="customer id", required=false,type="integer", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="deleted_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="expired_at", description="到期时间", required=true,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="expire_day", description="有效期（天）", required=false,type="integer", paramType="form", defaultValue="15" ),
            *          @SWG\Parameter(name="hire_amt", description="租借费用", required=false,type="number", paramType="form", defaultValue="0.00" ),
            *          @SWG\Parameter(name="hire_at", description="借伞时间", required=false,type="string", paramType="form", defaultValue="CURRENT_TIMESTAMP" ),
            *          @SWG\Parameter(name="hire_day", description="租用时长", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="hire_equipment_id", description="equipments id 借伞设备id", required=false,type="integer", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="hire_site_id", description="sites id 借伞网点id", required=false,type="integer", paramType="form", defaultValue="" ),
                    *          @SWG\Parameter(name="margin_amt", description="缴纳的保证金", required=false,type="number", paramType="form", defaultValue="0.00" ),
            *          @SWG\Parameter(name="modifier_id", description="修改用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="return_at", description="还伞时间", required=false,type="string", paramType="form", defaultValue="0000-00-00 00:00:00" ),
            *          @SWG\Parameter(name="return_equipment_id", description="equipments id 还伞设备id", required=false,type="integer", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="return_site_id", description="sites id 还伞网点id", required=false,type="integer", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="status", description="状态(1-正常出租, 2-按时归还, 3-逾期未归还)", required=false,type="integer", paramType="form", defaultValue="1" ),
            *          @SWG\Parameter(name="umbrella_id", description="umbrellas id", required=false,type="integer", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="updated_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
        *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/', ['as' => 'CustomerHire.store', 'uses' => 'CustomerHireController@store']);

    /**
    * @SWG\Api(
    *     path="/api/customer-hire/{id}",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="customer-hire-update",
    *      summary="更新",
    *      notes="更新",
    *      type="CustomerHire",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="created_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="creator_id", description="创建用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="customer_id", description="customer id", required=false,type="integer", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="deleted_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="expired_at", description="到期时间", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="expire_day", description="有效期（天）", required=false,type="integer", paramType="form", defaultValue="15" ),
            *          @SWG\Parameter(name="hire_amt", description="租借费用", required=false,type="number", paramType="form", defaultValue="0.00" ),
            *          @SWG\Parameter(name="hire_at", description="借伞时间", required=false,type="string", paramType="form", defaultValue="CURRENT_TIMESTAMP" ),
            *          @SWG\Parameter(name="hire_day", description="租用时长", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="hire_equipment_id", description="equipments id 借伞设备id", required=false,type="integer", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="hire_site_id", description="sites id 借伞网点id", required=false,type="integer", paramType="form", defaultValue="" ),
                    *          @SWG\Parameter(name="margin_amt", description="缴纳的保证金", required=false,type="number", paramType="form", defaultValue="0.00" ),
            *          @SWG\Parameter(name="modifier_id", description="修改用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="return_at", description="还伞时间", required=false,type="string", paramType="form", defaultValue="0000-00-00 00:00:00" ),
            *          @SWG\Parameter(name="return_equipment_id", description="equipments id 还伞设备id", required=false,type="integer", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="return_site_id", description="sites id 还伞网点id", required=false,type="integer", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="status", description="状态(1-正常出租, 2-按时归还, 3-逾期未归还)", required=false,type="integer", paramType="form", defaultValue="1" ),
            *          @SWG\Parameter(name="umbrella_id", description="umbrellas id", required=false,type="integer", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="updated_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
        *          @SWG\Parameter(name="id", description="id", required=true,type="integer", paramType="path", defaultValue="" ),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/{id}', ['as' => 'CustomerHire.update', 'uses' => 'CustomerHireController@update']);

    /**
    * @SWG\Api(
    *     path="/api/customer-hire/{id}",
    *     @SWG\Operation(
    *      method="DELETE",
    *      nickname="customer-hire-delete",
    *      summary="删除",
    *      notes="删除",
    *      type="",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="id", description="id", required=true,type="integer", paramType="path", defaultValue="1" ),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="query", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::delete('/{id}', ['as' => 'CustomerHire.delete', 'uses' => 'CustomerHireController@destroy']);

});