<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class Resource extends BaseModel
{
	//
	protected $table = 'resources';
	protected $guarded = ['id'];

    public function createResource($file)
    {
        $dir = storage_path() . '/site-images/';

        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        $filename = date("YmdHis").uniqid().'.'.$file->getClientOriginalExtension();

        $path = storage_path('site-images/' .  $filename);

        $resource = Resource::create([
            'name' => $file->getClientOriginalName(),
            'ext' => $file->getClientOriginalExtension(),
            'size' => $file->getSize(),
            'path' => $path ,
            'mimetype' => $file->getMimeType(),
        ]);

        $file->move(
            $dir,
            $filename
        );

        return $resource->id;
    }
}
