<?php
/**
* @SWG\Resource(
*  resourcePath="/comment",
*  description="Comment"
* )
*/
Route::group(['prefix' => 'wechat', 'middleware' => 'api.sign'], function () {

    /**
     * @SWG\Api(
     *     path="/api/wechat/notify/{key}",
     *     @SWG\Operation(
     *      method="ANY",
     *      nickname="wechat-notify",
     *      summary="微信支付异步回调",
     *      notes="微信支付异步回调",
     *      type="array",
     *      @SWG\Parameters(
     *      )
     *    )
     * )
     */
    Route::any('/notify/{key}', [ 'uses' => 'WechatController@payNotify']);

    /**
     * @SWG\Api(
     *     path="/api/wechat/return/{id}",
     *     @SWG\Operation(
     *      method="GET",
     *      nickname="wechat-return",
     *      summary="微信支付同步回调",
     *      notes="微信支付同步回调",
     *      type="array",
     *      @SWG\Parameters(
     *      )
     *    )
     * )
     */
    Route::get('/return/{id}', [ 'uses' => 'WechatController@payReturn']);

});