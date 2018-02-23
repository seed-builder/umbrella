<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use App\Models\Comment;

class CommentController extends ApiController
{
	//
	public function newEntity(array $attributes = [])
	{
		// TODO: Implement newEntity() method.
		return new Comment($attributes);
	}

	public function store(Request $request)
    {
        $data = $request->all();
        unset($data['_sign']);
        unset($data['token']);
        $customer = $this->request->customer;
        $entity = $this->newEntity($data + ['customer_id' => $customer->id]);
        $fieldErrors = $this->validateFields($data);
        if (!empty($fieldErrors)) {
            $msg = $this->formatFieldErrors($fieldErrors, $entity->fieldNames);
            return $this->fail($msg);
        }

        $res = $entity->save();
        return $res ? $this->success($entity) : $this->fail('store fail');
    }
}