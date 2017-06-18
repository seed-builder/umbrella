<?php
/**
* @SWG\Resource(
*  resourcePath="/site",
*  description="Site"
* )
*/
Route::group(['prefix' => 'site', 'middleware' => 'api.sign'], function () {

    /**
    * @SWG\Api(
    *     path="/api/site",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="site-list",
    *      summary="page list",
    *      notes="page list",
    *      type="array",
    *     items="$ref:Site",
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
    Route::get('/', ['as' => 'Site.index', 'uses' => 'SiteController@index']);

    /**
    * @SWG\Api(
    *     path="/api/site/{id}",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="site-show",
    *      summary="信息详情",
    *      notes="信息详情",
    *      type="Site",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="id", description="id", required=true, type="integer", paramType="path", defaultValue="1"),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="query", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::get('/{id}', ['as' => 'Site.show', 'uses' => 'SiteController@show']);

    /**
    * @SWG\Api(
    *     path="/api/site",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="site-store",
    *      summary="新增",
    *      notes="新增",
    *      type="Site",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="address", description="详细地址", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="city", description="城市", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="created_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="creator_id", description="创建用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="deleted_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="district", description="区域", required=false,type="string", paramType="form", defaultValue="" ),
                    *          @SWG\Parameter(name="latitude", description="纬度", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="longitude", description="经度", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="modifier_id", description="修改用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="name", description="网点名", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="province", description="省份", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="type", description="网点类别 1-设备网点 2-还伞网点", required=false,type="integer", paramType="form", defaultValue="1" ),
            *          @SWG\Parameter(name="updated_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
        *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/', ['as' => 'Site.store', 'uses' => 'SiteController@store']);

    /**
    * @SWG\Api(
    *     path="/api/site/{id}",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="site-update",
    *      summary="更新",
    *      notes="更新",
    *      type="Site",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="address", description="详细地址", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="city", description="城市", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="created_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="creator_id", description="创建用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="deleted_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="district", description="区域", required=false,type="string", paramType="form", defaultValue="" ),
                    *          @SWG\Parameter(name="latitude", description="纬度", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="longitude", description="经度", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="modifier_id", description="修改用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="name", description="网点名", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="province", description="省份", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="type", description="网点类别 1-设备网点 2-还伞网点", required=false,type="integer", paramType="form", defaultValue="1" ),
            *          @SWG\Parameter(name="updated_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
        *          @SWG\Parameter(name="id", description="id", required=true,type="integer", paramType="path", defaultValue="" ),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/{id}', ['as' => 'Site.update', 'uses' => 'SiteController@update']);

    /**
    * @SWG\Api(
    *     path="/api/site/{id}",
    *     @SWG\Operation(
    *      method="DELETE",
    *      nickname="site-delete",
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
    Route::delete('/{id}', ['as' => 'Site.delete', 'uses' => 'SiteController@destroy']);

});