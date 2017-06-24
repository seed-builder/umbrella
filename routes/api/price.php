<?php
/**
* @SWG\Resource(
*  resourcePath="/price",
*  description="Price"
* )
*/
Route::group(['prefix' => 'price', 'middleware' => 'api.sign'], function () {

    /**
    * @SWG\Api(
    *     path="/api/price",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="price-list",
    *      summary="page list",
    *      notes="page list",
    *      type="array",
    *     items="$ref:Price",
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
    Route::get('/', ['as' => 'Price.index', 'uses' => 'PriceController@index']);

    /**
    * @SWG\Api(
    *     path="/api/price/{id}",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="price-show",
    *      summary="信息详情",
    *      notes="信息详情",
    *      type="Price",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="id", description="id", required=true, type="integer", paramType="path", defaultValue="1"),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="query", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::get('/{id}', ['as' => 'Price.show', 'uses' => 'PriceController@show']);

    /**
    * @SWG\Api(
    *     path="/api/price",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="price-store",
    *      summary="新增",
    *      notes="新增",
    *      type="Price",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="begin", description="有效期开始日期", required=true,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="created_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="creator_id", description="创建用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="deleted_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="deposit_cash", description="保证金", required=false,type="number", paramType="form", defaultValue="0.00" ),
            *          @SWG\Parameter(name="end", description="有效期结束日期", required=true,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="hire_day_cash", description="日租金", required=false,type="number", paramType="form", defaultValue="0.00" ),
            *          @SWG\Parameter(name="hire_expire_days", description="租借逾期天数(逾期则扣除保证金)", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="hire_free_days", description="租借免费天数", required=false,type="integer", paramType="form", defaultValue="0" ),
                    *          @SWG\Parameter(name="is_default", description="是否默认(1-是， 2-否)", required=false,type="integer", paramType="form", defaultValue="1" ),
            *          @SWG\Parameter(name="modifier_id", description="修改用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="name", description="名称", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="status", description="状态（1-启用， 2-禁用）", required=false,type="integer", paramType="form", defaultValue="1" ),
            *          @SWG\Parameter(name="updated_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
        *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/', ['as' => 'Price.store', 'uses' => 'PriceController@store']);

    /**
    * @SWG\Api(
    *     path="/api/price/{id}",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="price-update",
    *      summary="更新",
    *      notes="更新",
    *      type="Price",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="begin", description="有效期开始日期", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="created_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="creator_id", description="创建用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="deleted_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="deposit_cash", description="保证金", required=false,type="number", paramType="form", defaultValue="0.00" ),
            *          @SWG\Parameter(name="end", description="有效期结束日期", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="hire_day_cash", description="日租金", required=false,type="number", paramType="form", defaultValue="0.00" ),
            *          @SWG\Parameter(name="hire_expire_days", description="租借逾期天数(逾期则扣除保证金)", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="hire_free_days", description="租借免费天数", required=false,type="integer", paramType="form", defaultValue="0" ),
                    *          @SWG\Parameter(name="is_default", description="是否默认(1-是， 2-否)", required=false,type="integer", paramType="form", defaultValue="1" ),
            *          @SWG\Parameter(name="modifier_id", description="修改用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
            *          @SWG\Parameter(name="name", description="名称", required=false,type="string", paramType="form", defaultValue="" ),
            *          @SWG\Parameter(name="status", description="状态（1-启用， 2-禁用）", required=false,type="integer", paramType="form", defaultValue="1" ),
            *          @SWG\Parameter(name="updated_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
        *          @SWG\Parameter(name="id", description="id", required=true,type="integer", paramType="path", defaultValue="" ),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/{id}', ['as' => 'Price.update', 'uses' => 'PriceController@update']);

    /**
    * @SWG\Api(
    *     path="/api/price/{id}",
    *     @SWG\Operation(
    *      method="DELETE",
    *      nickname="price-delete",
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
    Route::delete('/{id}', ['as' => 'Price.delete', 'uses' => 'PriceController@destroy']);

});