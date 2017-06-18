<?php
/**
* @SWG\Resource(
*  resourcePath="/sys-log",
*  description="SysLog"
* )
*/
Route::group(['prefix' => 'sys-log', 'middleware' => 'api.sign'], function () {

    /**
    * @SWG\Api(
    *     path="/api/sys-log",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="sys-log-list",
    *      summary="page list",
    *      notes="page list",
    *      type="array",
    *     items="$ref:SysLog",
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
    Route::get('/', ['as' => 'SysLog.index', 'uses' => 'SysLogController@index']);

    /**
    * @SWG\Api(
    *     path="/api/sys-log/{id}",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="sys-log-show",
    *      summary="信息详情",
    *      notes="信息详情",
    *      type="SysLog",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="id", description="id", required=true, type="integer", paramType="path", defaultValue="1"),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="query", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::get('/{id}', ['as' => 'SysLog.show', 'uses' => 'SysLogController@show']);

    /**
    * @SWG\Api(
    *     path="/api/sys-log",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="sys-log-store",
    *      summary="新增",
    *      notes="新增",
    *      type="SysLog",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="action", description="操作", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="content", description="内容", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="created_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="creator_id", description="创建用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="deleted_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
                    *          @SWG\Parameter(name="modifier_id", description="修改用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="module", description="模块名 （表名|请求接口名）", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="updated_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
        *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/', ['as' => 'SysLog.store', 'uses' => 'SysLogController@store']);

    /**
    * @SWG\Api(
    *     path="/api/sys-log/{id}",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="sys-log-update",
    *      summary="更新",
    *      notes="更新",
    *      type="SysLog",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="action", description="操作", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="content", description="内容", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="created_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="creator_id", description="创建用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="deleted_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
                    *          @SWG\Parameter(name="modifier_id", description="修改用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="module", description="模块名 （表名|请求接口名）", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="updated_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
        *          @SWG\Parameter(name="id", description="id", required=true,type="integer", paramType="path", defaultValue="" ),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/{id}', ['as' => 'SysLog.update', 'uses' => 'SysLogController@update']);

    /**
    * @SWG\Api(
    *     path="/api/sys-log/{id}",
    *     @SWG\Operation(
    *      method="DELETE",
    *      nickname="sys-log-delete",
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
    Route::delete('/{id}', ['as' => 'SysLog.delete', 'uses' => 'SysLogController@destroy']);

});