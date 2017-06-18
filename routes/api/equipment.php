<?php
/**
* @SWG\Resource(
*  resourcePath="/equipment",
*  description="Equipment"
* )
*/
Route::group(['prefix' => 'equipment', 'middleware' => 'api.sign'], function () {

    /**
    * @SWG\Api(
    *     path="/api/equipment",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="equipment-list",
    *      summary="page list",
    *      notes="page list",
    *      type="array",
    *     items="$ref:Equipment",
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
    Route::get('/', ['as' => 'Equipment.index', 'uses' => 'EquipmentController@index']);

    /**
    * @SWG\Api(
    *     path="/api/equipment/{id}",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="equipment-show",
    *      summary="信息详情",
    *      notes="信息详情",
    *      type="Equipment",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="id", description="id", required=true, type="integer", paramType="path", defaultValue="1"),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="query", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::get('/{id}', ['as' => 'Equipment.show', 'uses' => 'EquipmentController@show']);

    /**
    * @SWG\Api(
    *     path="/api/equipment",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="equipment-store",
    *      summary="新增",
    *      notes="新增",
    *      type="Equipment",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="capacity", description="容量（伞数量）", required=false,type="integer", paramType="form", defaultValue="50" ),
            *          @SWG\Parameter(name="created_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="creator_id", description="创建用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="deleted_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="have", description="当前还有数（伞数量）", required=false,type="integer", paramType="form", defaultValue="0" ),
                    *          @SWG\Parameter(name="ip", description="ip", required=true,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="modifier_id", description="修改用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="site_id", description="sites id", required=false,type="integer", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="sn", description="设备编号", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="status", description="状态（0-未启用, 1-启用, 2-系统故障）", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="type", description="设备类型 1-伞机设备 2-手持设备", required=false,type="integer", paramType="form", defaultValue="1" ),
            *          @SWG\Parameter(name="updated_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
        *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/', ['as' => 'Equipment.store', 'uses' => 'EquipmentController@store']);

    /**
    * @SWG\Api(
    *     path="/api/equipment/{id}",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="equipment-update",
    *      summary="更新",
    *      notes="更新",
    *      type="Equipment",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="capacity", description="容量（伞数量）", required=false,type="integer", paramType="form", defaultValue="50" ),
            *          @SWG\Parameter(name="created_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="creator_id", description="创建用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="deleted_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="have", description="当前还有数（伞数量）", required=false,type="integer", paramType="form", defaultValue="0" ),
                    *          @SWG\Parameter(name="ip", description="ip", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="modifier_id", description="修改用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="site_id", description="sites id", required=false,type="integer", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="sn", description="设备编号", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="status", description="状态（0-未启用, 1-启用, 2-系统故障）", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="type", description="设备类型 1-伞机设备 2-手持设备", required=false,type="integer", paramType="form", defaultValue="1" ),
            *          @SWG\Parameter(name="updated_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
        *          @SWG\Parameter(name="id", description="id", required=true,type="integer", paramType="path", defaultValue="" ),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/{id}', ['as' => 'Equipment.update', 'uses' => 'EquipmentController@update']);

    /**
    * @SWG\Api(
    *     path="/api/equipment/{id}",
    *     @SWG\Operation(
    *      method="DELETE",
    *      nickname="equipment-delete",
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
    Route::delete('/{id}', ['as' => 'Equipment.delete', 'uses' => 'EquipmentController@destroy']);

});