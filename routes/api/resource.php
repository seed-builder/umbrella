<?php
/**
* @SWG\Resource(
*  resourcePath="/resource",
*  description="Resource"
* )
*/
Route::group(['prefix' => 'resource', 'middleware' => 'api.sign'], function () {

    /**
    * @SWG\Api(
    *     path="/api/resource",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="resource-list",
    *      summary="page list",
    *      notes="page list",
    *      type="array",
    *     items="$ref:Resource",
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
    Route::get('/', ['as' => 'Resource.index', 'uses' => 'ResourceController@index']);

    /**
    * @SWG\Api(
    *     path="/api/resource/{id}",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="resource-show",
    *      summary="信息详情",
    *      notes="信息详情",
    *      type="Resource",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="id", description="id", required=true, type="integer", paramType="path", defaultValue="1"),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="query", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::get('/{id}', ['as' => 'Resource.show', 'uses' => 'ResourceController@show']);

    /**
    * @SWG\Api(
    *     path="/api/resource",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="resource-store",
    *      summary="新增",
    *      notes="新增",
    *      type="Resource",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="content", description="", required=true,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="created_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="creator_id", description="", required=false,type="integer", paramType="form", defaultValue="0" ),
    *          @SWG\Parameter(name="ext", description="", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="mimetype", description="", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="name", description="", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="path", description="", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="res_id", description="", required=false,type="integer", paramType="form", defaultValue="0" ),
    *          @SWG\Parameter(name="res_type", description="", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="size", description="", required=false,type="integer", paramType="form", defaultValue="0" ),
    *          @SWG\Parameter(name="updated_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/', ['as' => 'Resource.store', 'uses' => 'ResourceController@store']);

    /**
    * @SWG\Api(
    *     path="/api/resource/{id}",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="resource-update",
    *      summary="更新",
    *      notes="更新",
    *      type="Resource",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="content", description="", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="created_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="creator_id", description="", required=false,type="integer", paramType="form", defaultValue="0" ),
    *          @SWG\Parameter(name="ext", description="", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="mimetype", description="", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="name", description="", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="path", description="", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="res_id", description="", required=false,type="integer", paramType="form", defaultValue="0" ),
    *          @SWG\Parameter(name="res_type", description="", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="size", description="", required=false,type="integer", paramType="form", defaultValue="0" ),
    *          @SWG\Parameter(name="updated_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="id", description="id", required=true,type="integer", paramType="path", defaultValue="" ),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/{id}', ['as' => 'Resource.update', 'uses' => 'ResourceController@update']);

    /**
    * @SWG\Api(
    *     path="/api/resource/{id}",
    *     @SWG\Operation(
    *      method="DELETE",
    *      nickname="resource-delete",
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
    Route::delete('/{id}', ['as' => 'Resource.delete', 'uses' => 'ResourceController@destroy']);

});