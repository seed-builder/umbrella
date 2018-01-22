<?php
/**
* @SWG\Resource(
*  resourcePath="/partner",
*  description="Partner"
* )
*/
Route::group(['prefix' => 'partner', 'middleware' => 'api.sign'], function () {

    /**
    * @SWG\Api(
    *     path="/api/partner",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="partner-list",
    *      summary="page list",
    *      notes="page list",
    *      type="array",
    *     items="$ref:Partner",
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
    Route::get('/', ['as' => 'Partner.index', 'uses' => 'PartnerController@index']);

    /**
    * @SWG\Api(
    *     path="/api/partner/{id}",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="partner-show",
    *      summary="信息详情",
    *      notes="信息详情",
    *      type="Partner",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="id", description="id", required=true, type="integer", paramType="path", defaultValue="1"),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="query", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::get('/{id}', ['as' => 'Partner.show', 'uses' => 'PartnerController@show']);

    /**
    * @SWG\Api(
    *     path="/api/partner",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="partner-store",
    *      summary="新增",
    *      notes="新增",
    *      type="Partner",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="address", description="地址", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="created_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="full_name", description="经销商全称", required=false,type="string", paramType="form", defaultValue="" ),
                    *          @SWG\Parameter(name="linkman", description="联系人", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="mobile", description="手机号", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="name", description="登陆账号", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="password", description="密码", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="remember_token", description="remember_token", required=true,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="status", description="状态 1-启用 2-禁用", required=false,type="integer", paramType="form", defaultValue="1" ),
            *          @SWG\Parameter(name="updated_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
        *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/', ['as' => 'Partner.store', 'uses' => 'PartnerController@store']);

    /**
    * @SWG\Api(
    *     path="/api/partner/{id}",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="partner-update",
    *      summary="更新",
    *      notes="更新",
    *      type="Partner",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="address", description="地址", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="created_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="full_name", description="经销商全称", required=false,type="string", paramType="form", defaultValue="" ),
                    *          @SWG\Parameter(name="linkman", description="联系人", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="mobile", description="手机号", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="name", description="登陆账号", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="password", description="密码", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="remember_token", description="remember_token", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="status", description="状态 1-启用 2-禁用", required=false,type="integer", paramType="form", defaultValue="1" ),
            *          @SWG\Parameter(name="updated_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
        *          @SWG\Parameter(name="id", description="id", required=true,type="integer", paramType="path", defaultValue="" ),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/{id}', ['as' => 'Partner.update', 'uses' => 'PartnerController@update']);

    /**
    * @SWG\Api(
    *     path="/api/partner/{id}",
    *     @SWG\Operation(
    *      method="DELETE",
    *      nickname="partner-delete",
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
    Route::delete('/{id}', ['as' => 'Partner.delete', 'uses' => 'PartnerController@destroy']);

});