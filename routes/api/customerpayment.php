<?php
/**
* @SWG\Resource(
*  resourcePath="/customer-payment",
*  description="CustomerPayment"
* )
*/
Route::group(['prefix' => 'customer-payment', 'middleware' => 'api.sign'], function () {

    /**
    * @SWG\Api(
    *     path="/api/customer-payment",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="customer-payment-list",
    *      summary="page list",
    *      notes="page list",
    *      type="array",
    *     items="$ref:CustomerPayment",
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
    Route::get('/', ['as' => 'CustomerPayment.index', 'uses' => 'CustomerPaymentController@index']);

    /**
    * @SWG\Api(
    *     path="/api/customer-payment/{id}",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="customer-payment-show",
    *      summary="信息详情",
    *      notes="信息详情",
    *      type="CustomerPayment",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="id", description="id", required=true, type="integer", paramType="path", defaultValue="1"),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="query", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::get('/{id}', ['as' => 'CustomerPayment.show', 'uses' => 'CustomerPaymentController@show']);

    /**
    * @SWG\Api(
    *     path="/api/customer-payment",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="customer-payment-store",
    *      summary="新增",
    *      notes="新增",
    *      type="CustomerPayment",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="amt", description="订单金额", required=false,type="number", paramType="form", defaultValue="0.00" ),
            *          @SWG\Parameter(name="created_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="creator_id", description="创建用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="customer_id", description="customer id", required=false,type="integer", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="deleted_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
                    *          @SWG\Parameter(name="modifier_id", description="修改用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="outer_order_sn", description="外部订单号 支付宝|微信生成的订单号", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="payment_channel", description="支付渠道 1-微信支付 2-支付宝", required=false,type="integer", paramType="form", defaultValue="1" ),
            *          @SWG\Parameter(name="reference_id", description="关联表id", required=true,type="integer", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="reference_type", description="关联表类型", required=true,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="remark", description="备注", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="sn", description="内部订单号 系统内部的订单号", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="status", description="支付状态（1-未支付, 2-已支付, 3-支付失败）", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="type", description="类型(1-定金支付, 2-租金支付, 3-账户充值支付", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="updated_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
        *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/', ['as' => 'CustomerPayment.store', 'uses' => 'CustomerPaymentController@store']);

    /**
    * @SWG\Api(
    *     path="/api/customer-payment/{id}",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="customer-payment-update",
    *      summary="更新",
    *      notes="更新",
    *      type="CustomerPayment",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="amt", description="订单金额", required=false,type="number", paramType="form", defaultValue="0.00" ),
            *          @SWG\Parameter(name="created_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="creator_id", description="创建用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="customer_id", description="customer id", required=false,type="integer", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="deleted_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
                    *          @SWG\Parameter(name="modifier_id", description="修改用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="outer_order_sn", description="外部订单号 支付宝|微信生成的订单号", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="payment_channel", description="支付渠道 1-微信支付 2-支付宝", required=false,type="integer", paramType="form", defaultValue="1" ),
            *          @SWG\Parameter(name="reference_id", description="关联表id", required=false,type="integer", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="reference_type", description="关联表类型", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="remark", description="备注", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="sn", description="内部订单号 系统内部的订单号", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="status", description="支付状态（1-未支付, 2-已支付, 3-支付失败）", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="type", description="类型(1-定金支付, 2-租金支付, 3-账户充值支付", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="updated_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
        *          @SWG\Parameter(name="id", description="id", required=true,type="integer", paramType="path", defaultValue="" ),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/{id}', ['as' => 'CustomerPayment.update', 'uses' => 'CustomerPaymentController@update']);

    /**
    * @SWG\Api(
    *     path="/api/customer-payment/{id}",
    *     @SWG\Operation(
    *      method="DELETE",
    *      nickname="customer-payment-delete",
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
    Route::delete('/{id}', ['as' => 'CustomerPayment.delete', 'uses' => 'CustomerPaymentController@destroy']);

});