<?php
/**
* @SWG\Resource(
*  resourcePath="/customer-withdraw",
*  description="CustomerWithdraw"
* )
*/
Route::group(['prefix' => 'customer-withdraw', 'middleware' => 'api.sign'], function () {

    /**
    * @SWG\Api(
    *     path="/api/customer-withdraw",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="customer-withdraw-list",
    *      summary="page list",
    *      notes="page list",
    *      type="array",
    *     items="$ref:CustomerWithdraw",
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
    Route::get('/', ['as' => 'CustomerWithdraw.index', 'uses' => 'CustomerWithdrawController@index']);

    /**
    * @SWG\Api(
    *     path="/api/customer-withdraw/{id}",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="customer-withdraw-show",
    *      summary="信息详情",
    *      notes="信息详情",
    *      type="CustomerWithdraw",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="id", description="id", required=true, type="integer", paramType="path", defaultValue="1"),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="query", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::get('/{id}', ['as' => 'CustomerWithdraw.show', 'uses' => 'CustomerWithdrawController@show']);

    /**
    * @SWG\Api(
    *     path="/api/customer-withdraw",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="customer-withdraw-store",
    *      summary="新增",
    *      notes="新增",
    *      type="CustomerWithdraw",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="amt", description="提现押金", required=false,type="number", paramType="form", defaultValue="0.00" ),
            *          @SWG\Parameter(name="created_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="customer_id", description="customer_id *customers", required=false,type="integer", paramType="form", defaultValue="0" ),
                    *          @SWG\Parameter(name="payment_id", description="payment_id *customer_payments", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="remark", description="备注", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="sn", description="内部订单号 系统内部的订单号", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="status", description="状态(1-已申请，2-已打款, 3-打款失败 )", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="updated_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
        *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/', ['as' => 'CustomerWithdraw.store', 'uses' => 'CustomerWithdrawController@store']);

    /**
    * @SWG\Api(
    *     path="/api/customer-withdraw/{id}",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="customer-withdraw-update",
    *      summary="更新",
    *      notes="更新",
    *      type="CustomerWithdraw",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="amt", description="提现押金", required=false,type="number", paramType="form", defaultValue="0.00" ),
            *          @SWG\Parameter(name="created_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="customer_id", description="customer_id *customers", required=false,type="integer", paramType="form", defaultValue="0" ),
                    *          @SWG\Parameter(name="payment_id", description="payment_id *customer_payments", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="remark", description="备注", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="sn", description="内部订单号 系统内部的订单号", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="status", description="状态(1-已申请，2-已打款, 3-打款失败 )", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="updated_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
        *          @SWG\Parameter(name="id", description="id", required=true,type="integer", paramType="path", defaultValue="" ),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/{id}', ['as' => 'CustomerWithdraw.update', 'uses' => 'CustomerWithdrawController@update']);

    /**
    * @SWG\Api(
    *     path="/api/customer-withdraw/{id}",
    *     @SWG\Operation(
    *      method="DELETE",
    *      nickname="customer-withdraw-delete",
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
    Route::delete('/{id}', ['as' => 'CustomerWithdraw.delete', 'uses' => 'CustomerWithdrawController@destroy']);

});