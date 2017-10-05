<?php
/**
* @SWG\Resource(
*  resourcePath="/sys-config",
*  description="SysConfig"
* )
*/
Route::group(['prefix' => 'sys-config', 'middleware' => 'api.sign'], function () {

    /**
    * @SWG\Api(
    *     path="/api/sys-config",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="sys-config-list",
    *      summary="page list",
    *      notes="page list",
    *      type="array",
    *     items="$ref:SysConfig",
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
    Route::get('/', ['as' => 'SysConfig.index', 'uses' => 'SysConfigController@index']);

    /**
    * @SWG\Api(
    *     path="/api/sys-config/{id}",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="sys-config-show",
    *      summary="信息详情",
    *      notes="信息详情",
    *      type="SysConfig",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="id", description="id", required=true, type="integer", paramType="path", defaultValue="1"),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="query", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::get('/{id}', ['as' => 'SysConfig.show', 'uses' => 'SysConfigController@show']);

    /**
    * @SWG\Api(
    *     path="/api/sys-config",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="sys-config-store",
    *      summary="新增",
    *      notes="新增",
    *      type="SysConfig",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="category", description="类型", required=true,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="created_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="deleted_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="desc", description="描述", required=true,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="name", description="配置项名称", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="updated_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="value", description="值", required=true,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/', ['as' => 'SysConfig.store', 'uses' => 'SysConfigController@store']);

    /**
    * @SWG\Api(
    *     path="/api/sys-config/{id}",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="sys-config-update",
    *      summary="更新",
    *      notes="更新",
    *      type="SysConfig",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="category", description="类型", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="created_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="deleted_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="desc", description="描述", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="name", description="配置项名称", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="updated_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="value", description="值", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="id", description="id", required=true,type="integer", paramType="path", defaultValue="" ),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/{id}', ['as' => 'SysConfig.update', 'uses' => 'SysConfigController@update']);

    /**
    * @SWG\Api(
    *     path="/api/sys-config/{id}",
    *     @SWG\Operation(
    *      method="DELETE",
    *      nickname="sys-config-delete",
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
    Route::delete('/{id}', ['as' => 'SysConfig.delete', 'uses' => 'SysConfigController@destroy']);


    /**
     * @SWG\Api(
     *     path="/api/sys-config/get-by-name/{name}",
     *     @SWG\Operation(
     *      method="GET",
     *      nickname="sys-config-get-by-name",
     *      summary="信息详情",
     *      notes="信息详情",
     *      type="SysConfig",
     *      @SWG\Parameters(
     *          @SWG\Parameter(name="name", description="name", required=true, type="string", paramType="path", defaultValue=""),
     *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="query", defaultValue="****")
     *      )
     *  )
     * )
     */
    Route::get('/get-by-name/{name}', ['as' => 'SysConfig.getByName', 'uses' => 'SysConfigController@getByName']);

});