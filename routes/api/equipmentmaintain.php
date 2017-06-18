<?php
/**
* @SWG\Resource(
*  resourcePath="/equipment-maintain",
*  description="EquipmentMaintain"
* )
*/
Route::group(['prefix' => 'equipment-maintain', 'middleware' => 'api.sign'], function () {

    /**
    * @SWG\Api(
    *     path="/api/equipment-maintain",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="equipment-maintain-list",
    *      summary="page list",
    *      notes="page list",
    *      type="array",
    *     items="$ref:EquipmentMaintain",
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
    Route::get('/', ['as' => 'EquipmentMaintain.index', 'uses' => 'EquipmentMaintainController@index']);

    /**
    * @SWG\Api(
    *     path="/api/equipment-maintain/{id}",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="equipment-maintain-show",
    *      summary="信息详情",
    *      notes="信息详情",
    *      type="EquipmentMaintain",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="id", description="id", required=true, type="integer", paramType="path", defaultValue="1"),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="query", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::get('/{id}', ['as' => 'EquipmentMaintain.show', 'uses' => 'EquipmentMaintainController@show']);

    /**
    * @SWG\Api(
    *     path="/api/equipment-maintain",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="equipment-maintain-store",
    *      summary="新增",
    *      notes="新增",
    *      type="EquipmentMaintain",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="created_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="creator_id", description="创建用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="deleted_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="engineer", description="维修人员", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="equipment_id", description="equipments id", required=false,type="integer", paramType="form", defaultValue="0" ),
                    *          @SWG\Parameter(name="maintain_content", description="维修内容", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="modifier_id", description="修改用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="site_id", description="equipments id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="updated_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
        *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/', ['as' => 'EquipmentMaintain.store', 'uses' => 'EquipmentMaintainController@store']);

    /**
    * @SWG\Api(
    *     path="/api/equipment-maintain/{id}",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="equipment-maintain-update",
    *      summary="更新",
    *      notes="更新",
    *      type="EquipmentMaintain",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="created_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="creator_id", description="创建用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="deleted_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="engineer", description="维修人员", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="equipment_id", description="equipments id", required=false,type="integer", paramType="form", defaultValue="0" ),
                    *          @SWG\Parameter(name="maintain_content", description="维修内容", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="modifier_id", description="修改用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="site_id", description="equipments id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="updated_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
        *          @SWG\Parameter(name="id", description="id", required=true,type="integer", paramType="path", defaultValue="" ),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/{id}', ['as' => 'EquipmentMaintain.update', 'uses' => 'EquipmentMaintainController@update']);

    /**
    * @SWG\Api(
    *     path="/api/equipment-maintain/{id}",
    *     @SWG\Operation(
    *      method="DELETE",
    *      nickname="equipment-maintain-delete",
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
    Route::delete('/{id}', ['as' => 'EquipmentMaintain.delete', 'uses' => 'EquipmentMaintainController@destroy']);

});