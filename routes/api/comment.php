<?php
/**
* @SWG\Resource(
*  resourcePath="/comment",
*  description="Comment"
* )
*/
Route::group(['prefix' => 'comment', 'middleware' => 'api.sign'], function () {

    /**
    * @SWG\Api(
    *     path="/api/comment",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="comment-list",
    *      summary="page list",
    *      notes="page list",
    *      type="array",
    *     items="$ref:Comment",
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
    Route::get('/', ['as' => 'Comment.index', 'uses' => 'CommentController@index']);

    /**
    * @SWG\Api(
    *     path="/api/comment/{id}",
    *     @SWG\Operation(
    *      method="GET",
    *      nickname="comment-show",
    *      summary="信息详情",
    *      notes="信息详情",
    *      type="Comment",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="id", description="id", required=true, type="integer", paramType="path", defaultValue="1"),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="query", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::get('/{id}', ['as' => 'Comment.show', 'uses' => 'CommentController@show']);

    /**
    * @SWG\Api(
    *     path="/api/comment",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="comment-store",
    *      summary="新增",
    *      notes="新增",
    *      type="Comment",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="address", description="事发地点", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="content", description="", required=true,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="created_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="creator_id", description="创建用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
    *          @SWG\Parameter(name="customer_id", description="客户id", required=false,type="integer", paramType="form", defaultValue="0" ),
    *          @SWG\Parameter(name="deleted_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="modifier_id", description="修改用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
    *          @SWG\Parameter(name="photos", description="图片", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="service_id", description="1-故障申报 2-损坏举报 3-疑问咨询", required=false,type="integer", paramType="form", defaultValue="0" ),
    *          @SWG\Parameter(name="updated_at", description="", required=true,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/', ['as' => 'Comment.store', 'uses' => 'CommentController@store']);

    /**
    * @SWG\Api(
    *     path="/api/comment/{id}",
    *     @SWG\Operation(
    *      method="POST",
    *      nickname="comment-update",
    *      summary="更新",
    *      notes="更新",
    *      type="Comment",
    *      @SWG\Parameters(
    *          @SWG\Parameter(name="address", description="事发地点", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="content", description="", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="created_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="creator_id", description="创建用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
    *          @SWG\Parameter(name="customer_id", description="客户id", required=false,type="integer", paramType="form", defaultValue="0" ),
    *          @SWG\Parameter(name="deleted_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="modifier_id", description="修改用户id", required=false,type="integer", paramType="form", defaultValue="0" ),
    *          @SWG\Parameter(name="photos", description="图片", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="service_id", description="1-故障申报 2-损坏举报 3-疑问咨询", required=false,type="integer", paramType="form", defaultValue="0" ),
    *          @SWG\Parameter(name="updated_at", description="", required=false,type="string", paramType="form", defaultValue="" ),
    *          @SWG\Parameter(name="id", description="id", required=true,type="integer", paramType="path", defaultValue="" ),
    *          @SWG\Parameter(name="_sign", description="签名", required=true, type="string", paramType="form", defaultValue="****")
    *      )
    *  )
    * )
    */
    Route::post('/{id}', ['as' => 'Comment.update', 'uses' => 'CommentController@update']);

    /**
    * @SWG\Api(
    *     path="/api/comment/{id}",
    *     @SWG\Operation(
    *      method="DELETE",
    *      nickname="comment-delete",
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
    Route::delete('/{id}', ['as' => 'Comment.delete', 'uses' => 'CommentController@destroy']);

});