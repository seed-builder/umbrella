<?php
/**
* @SWG\Resource(
*  resourcePath="/customer",
*  description="Customer"
* )
*/
Route::group(['prefix' => 'customer', 'middleware' => 'api.sign'], function () {

    /**
     * @SWG\Api(
     *     path="/api/customer/login",
     *     @SWG\Operation(
     *      method="GET",
     *      nickname="customer-login",
     *      summary="customer-login",
     *      notes="customer-login",
     *      type="Customer",
     *      @SWG\Parameters(
     *          @SWG\Parameter(name="code", description="code", required=true, type="string", paramType="query", defaultValue=""),
     *      )
     *    )
     * )
     */
    Route::get('/login', ['as' => 'Customer.login', 'uses' => 'CustomerController@login']);

    /**
    * @SWG\Api(
    *     path="/api/customer",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="customer-list",
    *      summary="page list",
    *      notes="page list",
    *      type="array",
    *     items="$ref:Customer",
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
    Route::get('/', ['as' => 'Customer.index', 'uses' => 'CustomerController@index']);

    /**
    * @SWG\Api(
    *     path="/api/customer/{id}",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="customer-show",
    *      summary="信息详情",
    *      notes="信息详情",
    *      type="Customer",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="id", description="id", required=true, type="integer", paramType="path", defaultValue="1"),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="query", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::get('/{id}', ['as' => 'Customer.show', 'uses' => 'CustomerController@show']);

    /**
    * @SWG\Api(
    *     path="/api/customer",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="customer-store",
    *      summary="新增",
    *      notes="新增",
    *      type="Customer",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="address", description="地址", required=true,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="birth_day", description="生日", required=true,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="created_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="creator_id", description="创建用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
    *          @SWG\Parameter(name="deleted_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="gender", description="性别(2-女,1-男，0-未知", required=true,type="integer", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="head_img_url", description="微信头像", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="login_time", description="", required=false,type="integer", paramType="form", defaultValue="0" ),
    *          @SWG\Parameter(name="mobile", description="手机号", required=true,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="modifier_id", description="修改用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
    *          @SWG\Parameter(name="nickname", description="微信昵称", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="openid", description="微信openid", required=true,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="password", description="密码", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="remark", description="备注", required=true,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="updated_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/', ['as' => 'Customer.store', 'uses' => 'CustomerController@store']);

    /**
    * @SWG\Api(
    *     path="/api/customer/{id}",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="customer-update",
    *      summary="更新",
    *      notes="更新",
    *      type="Customer",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="address", description="地址", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="birth_day", description="生日", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="created_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="creator_id", description="创建用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
    *          @SWG\Parameter(name="deleted_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="gender", description="性别(2-女,1-男，0-未知", required=false,type="integer", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="head_img_url", description="微信头像", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="login_time", description="", required=false,type="integer", paramType="form", defaultValue="0" ),
    *          @SWG\Parameter(name="mobile", description="手机号", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="modifier_id", description="修改用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
    *          @SWG\Parameter(name="nickname", description="微信昵称", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="openid", description="微信openid", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="password", description="密码", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="remark", description="备注", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="updated_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="id", description="id", required=true,type="integer", paramType="path", defaultValue="" ),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/{id}', ['as' => 'Customer.update', 'uses' => 'CustomerController@update']);

    /**
    * @SWG\Api(
    *     path="/api/customer/{id}",
    *     @SWG\Operation(
    *      method="DELETE",
    *      nickname="customer-delete",
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
    Route::delete('/{id}', ['as' => 'Customer.delete', 'uses' => 'CustomerController@destroy']);

    /**
     * @SWG\Api(
     *     path="/api/customer/info",
     *     @SWG\Operation(
     *      method="GET",
     *      nickname="customer-info",
     *      summary="信息详情",
     *      notes="信息详情",
     *      type="Customer",
     *      @SWG\Parameters(
     *          @SWG\Parameter(name="id", description="id", required=false, type="integer", paramType="query", defaultValue="1"),
     *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="query", defaultValue="****")
     *      )
     *  )
     * )
     */
    Route::get('/info', ['as' => 'Customer.info', 'uses' => 'CustomerController@info']);

});