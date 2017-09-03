<?php
/**
 * @SWG\Resource(
 *  resourcePath="/price",
 *  description="Price"
 * )
 */
Route::group(['prefix' => 'utl', 'middleware' => 'api.sign'], function () {

	/**
	 * @SWG\Api(
	 *   path="/api/utl/sms-verify",
	 *   @SWG\Operation(
	 *      method="POST",
	 *      consumes={"multipart/form-data"},
	 *      nickname="sms-verify",
	 *      summary="发送验证码短信",
	 *      notes="发送验证码短信",
	 *      type="",
	 *      @SWG\Parameters(
	 *          @SWG\Parameter(
	 *              name="phone",
	 *              description="手机号",
	 *              required=true,
	 *              type="string",
	 *              paramType="form",
	 *              defaultValue=""
	 *          ),
	 *          @SWG\Parameter(
	 *              name="_sign",
	 *              description="签名",
	 *              required=true,
	 *              type="string",
	 *              paramType="form",
	 *              defaultValue="****"
	 *          )
	 *      ),
	 *      @SWG\ResponseMessages(
	 *          @SWG\ResponseMessage(code=401, message="签名验证错误！"),
	 *          @SWG\ResponseMessage(code=200, message="成功。")
	 *      )
	 *   )
	 * )
	 */
	Route::post('/sms-verify', ['uses' => 'UtlController@sendVerifyCode']);

	/**
	 * @SWG\Api(
	 *   path="/api/utl/check-verify",
	 *   @SWG\Operation(
	 *      method="POST",
	 *      consumes={"multipart/form-data"},
	 *      nickname="check-verify",
	 *      summary="判断验证码是否正确",
	 *      notes="判断验证码是否正确",
	 *      type="",
	 *      @SWG\Parameters(
	 *          @SWG\Parameter(
	 *              name="phone",
	 *              description="手机号",
	 *              required=true,
	 *              type="string",
	 *              paramType="form",
	 *              defaultValue=""
	 *          ),
	 *          @SWG\Parameter(
	 *              name="code",
	 *              description="验证码",
	 *              required=true,
	 *              type="string",
	 *              paramType="form",
	 *              defaultValue=""
	 *          ),
	 *          @SWG\Parameter(
	 *              name="_sign",
	 *              description="签名",
	 *              required=true,
	 *              type="string",
	 *              paramType="form",
	 *              defaultValue="****"
	 *          )
	 *      ),
	 *      @SWG\ResponseMessages(
	 *          @SWG\ResponseMessage(code=401, message="签名验证错误！"),
	 *          @SWG\ResponseMessage(code=200, message="成功。")
	 *      )
	 *   )
	 * )
	 */
	Route::post('/check-verify', ['uses' => 'UtlController@checkVerifyCode']);

});
