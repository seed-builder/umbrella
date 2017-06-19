<?php
/**
* @SWG\Resource(
*  resourcePath="/customer-account-record",
*  description="CustomerAccountRecord"
* )
*/
Route::group(['prefix' => 'customer-account-record', 'middleware' => 'api.sign'], function () {

    /**
    * @SWG\Api(
    *     path="/api/customer-account-record",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="customer-account-record-list",
    *      summary="page list",
    *      notes="page list",
    *      type="array",
    *     items="$ref:CustomerAccountRecord",
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
    Route::get('/', ['as' => 'CustomerAccountRecord.index', 'uses' => 'CustomerAccountRecordController@index']);

    /**
    * @SWG\Api(
    *     path="/api/customer-account-record/{id}",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="customer-account-record-show",
    *      summary="信息详情",
    *      notes="信息详情",
    *      type="CustomerAccountRecord",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="id", description="id", required=true, type="integer", paramType="path", defaultValue="1"),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="query", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::get('/{id}', ['as' => 'CustomerAccountRecord.show', 'uses' => 'CustomerAccountRecordController@show']);

    /**
    * @SWG\Api(
    *     path="/api/customer-account-record",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="customer-account-record-store",
    *      summary="新增",
    *      notes="新增",
    *      type="CustomerAccountRecord",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="amt", description="流水金额", required=false,type="number", paramType="form", defaultValue="0.00" ),
            *          @SWG\Parameter(name="created_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="creator_id", description="创建用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="customer_account_id", description="accounts id", required=false,type="integer", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="customer_id", description="customer id", required=false,type="integer", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="deleted_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
                    *          @SWG\Parameter(name="modifier_id", description="修改用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="remark", description="备注", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="status", description="状态(1-未完成，2-已完成, 3-取消)", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="type", description="流水类型 1-充值（收入） 2-支出", required=false,type="integer", paramType="form", defaultValue="1" ),
            *          @SWG\Parameter(name="updated_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
        *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/', ['as' => 'CustomerAccountRecord.store', 'uses' => 'CustomerAccountRecordController@store']);

    /**
    * @SWG\Api(
    *     path="/api/customer-account-record/{id}",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="customer-account-record-update",
    *      summary="更新",
    *      notes="更新",
    *      type="CustomerAccountRecord",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="amt", description="流水金额", required=false,type="number", paramType="form", defaultValue="0.00" ),
            *          @SWG\Parameter(name="created_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="creator_id", description="创建用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="customer_account_id", description="accounts id", required=false,type="integer", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="customer_id", description="customer id", required=false,type="integer", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="deleted_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
                    *          @SWG\Parameter(name="modifier_id", description="修改用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="remark", description="备注", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="status", description="状态(1-未完成，2-已完成, 3-取消)", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="type", description="流水类型 1-充值（收入） 2-支出", required=false,type="integer", paramType="form", defaultValue="1" ),
            *          @SWG\Parameter(name="updated_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
        *          @SWG\Parameter(name="id", description="id", required=true,type="integer", paramType="path", defaultValue="" ),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/{id}', ['as' => 'CustomerAccountRecord.update', 'uses' => 'CustomerAccountRecordController@update']);

    /**
    * @SWG\Api(
    *     path="/api/customer-account-record/{id}",
    *     @SWG\Operation(
    *      method="DELETE",
    *      nickname="customer-account-record-delete",
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
    Route::delete('/{id}', ['as' => 'CustomerAccountRecord.delete', 'uses' => 'CustomerAccountRecordController@destroy']);

});