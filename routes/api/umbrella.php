<?php
/**
* @SWG\Resource(
*  resourcePath="/umbrella",
*  description="Umbrella"
* )
*/
Route::group(['prefix' => 'umbrella', 'middleware' => 'api.sign'], function () {

    /**
     * @SWG\Api(
     *     path="/api/umbrella/unlock",
     *     @SWG\Operation(
     *      method="GET",
     *      nickname="umbrella-unlock",
     *      summary="手动输入伞号解锁",
     *      notes="手动输入伞号解锁",
     *      type="array",
     *    )
     * )
     */
    Route::get('/unlock', ['as' => 'Umbrella.unlock', 'uses' => 'UmbrellaController@unlock']);
    /**
    * @SWG\Api(
    *     path="/api/umbrella",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="umbrella-list",
    *      summary="page list",
    *      notes="page list",
    *      type="array",
    *     items="$ref:Umbrella",
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
    Route::get('/', ['as' => 'Umbrella.index', 'uses' => 'UmbrellaController@index']);

    /**
    * @SWG\Api(
    *     path="/api/umbrella/{id}",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="umbrella-show",
    *      summary="信息详情",
    *      notes="信息详情",
    *      type="Umbrella",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="id", description="id", required=true, type="integer", paramType="path", defaultValue="1"),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="query", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::get('/{id}', ['as' => 'Umbrella.show', 'uses' => 'UmbrellaController@show']);

    /**
    * @SWG\Api(
    *     path="/api/umbrella",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="umbrella-store",
    *      summary="新增",
    *      notes="新增",
    *      type="Umbrella",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="color", description="颜色", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="created_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="creator_id", description="创建用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
    *          @SWG\Parameter(name="deleted_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="equipment_id", description="equipments id", required=false,type="integer", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="logo", description="logo", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="modifier_id", description="修改用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
    *          @SWG\Parameter(name="name", description="伞名称", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="site_id", description="sites id", required=false,type="integer", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="sn", description="伞编号", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="status", description="状态 1-未发放 2-待借中 3-借出中 4-失效（超过还伞时间）", required=false,type="integer", paramType="form", defaultValue="1" ),
    *          @SWG\Parameter(name="updated_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/', ['as' => 'Umbrella.store', 'uses' => 'UmbrellaController@store']);

    /**
    * @SWG\Api(
    *     path="/api/umbrella/{id}",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="umbrella-update",
    *      summary="更新",
    *      notes="更新",
    *      type="Umbrella",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="color", description="颜色", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="created_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="creator_id", description="创建用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
    *          @SWG\Parameter(name="deleted_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="equipment_id", description="equipments id", required=false,type="integer", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="logo", description="logo", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="modifier_id", description="修改用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
    *          @SWG\Parameter(name="name", description="伞名称", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="site_id", description="sites id", required=false,type="integer", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="sn", description="伞编号", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="status", description="状态 1-未发放 2-待借中 3-借出中 4-失效（超过还伞时间）", required=false,type="integer", paramType="form", defaultValue="1" ),
    *          @SWG\Parameter(name="updated_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="id", description="id", required=true,type="integer", paramType="path", defaultValue="" ),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/{id}', ['as' => 'Umbrella.update', 'uses' => 'UmbrellaController@update']);

    /**
    * @SWG\Api(
    *     path="/api/umbrella/{id}",
    *     @SWG\Operation(
    *      method="DELETE",
    *      nickname="umbrella-delete",
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
    Route::delete('/{id}', ['as' => 'Umbrella.delete', 'uses' => 'UmbrellaController@destroy']);

});