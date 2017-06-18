<?php
/**
* @SWG\Resource(
*  resourcePath="/customer-account",
*  description="CustomerAccount"
* )
*/
Route::group(['prefix' => 'customer-account', 'middleware' => 'api.sign'], function () {

    /**
    * @SWG\Api(
    *     path="/api/customer-account",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="customer-account-list",
    *      summary="page list",
    *      notes="page list",
    *      type="array",
    *     items="$ref:CustomerAccount",
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
    Route::get('/', ['as' => 'CustomerAccount.index', 'uses' => 'CustomerAccountController@index']);

    /**
    * @SWG\Api(
    *     path="/api/customer-account/{id}",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="customer-account-show",
    *      summary="信息详情",
    *      notes="信息详情",
    *      type="CustomerAccount",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="id", description="id", required=true, type="integer", paramType="path", defaultValue="1"),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="query", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::get('/{id}', ['as' => 'CustomerAccount.show', 'uses' => 'CustomerAccountController@show']);

    /**
    * @SWG\Api(
    *     path="/api/customer-account",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="customer-account-store",
    *      summary="新增",
    *      notes="新增",
    *      type="CustomerAccount",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="balance_amt", description="余额", required=false,type="number", paramType="form", defaultValue="0.00" ),
            *          @SWG\Parameter(name="created_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="creator_id", description="创建用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="customer_id", description="customers id", required=false,type="integer", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="deleted_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="freeze_amt", description="冻结金额", required=false,type="number", paramType="form", defaultValue="0.00" ),
                    *          @SWG\Parameter(name="modifier_id", description="修改用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="sn", description="账户号", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="updated_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
        *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/', ['as' => 'CustomerAccount.store', 'uses' => 'CustomerAccountController@store']);

    /**
    * @SWG\Api(
    *     path="/api/customer-account/{id}",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="customer-account-update",
    *      summary="更新",
    *      notes="更新",
    *      type="CustomerAccount",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="balance_amt", description="余额", required=false,type="number", paramType="form", defaultValue="0.00" ),
            *          @SWG\Parameter(name="created_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="creator_id", description="创建用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="customer_id", description="customers id", required=false,type="integer", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="deleted_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="freeze_amt", description="冻结金额", required=false,type="number", paramType="form", defaultValue="0.00" ),
                    *          @SWG\Parameter(name="modifier_id", description="修改用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="sn", description="账户号", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="updated_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
        *          @SWG\Parameter(name="id", description="id", required=true,type="integer", paramType="path", defaultValue="" ),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/{id}', ['as' => 'CustomerAccount.update', 'uses' => 'CustomerAccountController@update']);

    /**
    * @SWG\Api(
    *     path="/api/customer-account/{id}",
    *     @SWG\Operation(
    *      method="DELETE",
    *      nickname="customer-account-delete",
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
    Route::delete('/{id}', ['as' => 'CustomerAccount.delete', 'uses' => 'CustomerAccountController@destroy']);

});