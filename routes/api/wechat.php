<?php
/**
* @SWG\Resource(
*  resourcePath="/wechat",
*  description="wechat"
* )
*/
Route::group(['prefix' => 'wechat', 'middleware' => 'api.sign'], function () {

    /**
     * @SWG\Api(
     *     path="/api/wechat/notify/{key}",
     *     @SWG\Operation(
     *      method="GET",
     *      nickname="wechat-notify",
     *      summary="微信支付异步回调",
     *      notes="微信支付异步回调",
     *      type="array",
     *    )
     * )
     */
    Route::any('/notify/{key}', [ 'uses' => 'WeChatController@payNotify']);

    /**
     * @SWG\Api(
     *     path="/api/wechat/return/{id}",
     *     @SWG\Operation(
     *      method="GET",
     *      nickname="wechat-return",
     *      summary="微信支付同步回调",
     *      notes="微信支付同步回调",
     *      type="array",
     *    )
     * )
     */
    Route::get('/return/{id}', [ 'uses' => 'WeChatController@payReturn']);

    /**
     * @SWG\Api(
     *     path="/api/wechat/js-api-config",
     *     @SWG\Operation(
     *      method="GET",
     *      nickname="wechat-js-api-config",
     *      summary="微信jsapi配置",
     *      notes="微信jsapi配置",
     *      type="array",
     *    )
     * )
     */
    Route::get('/js-api-config', [ 'uses' => 'WeChatController@jsApiConfig']);
});