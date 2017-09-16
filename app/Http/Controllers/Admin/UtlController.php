<?php

namespace App\Http\Controllers\Admin;

use App\Models\Resource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Response;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Resources;

class UtlController extends Controller
{
    //
    public function uploadImage(Request $request){
        $file = $request->file('imageFile');
        if($file->isValid())
        {
            $path = $file->store('upload/images');
            if($path){
                $res = Resource::create([
                    'name' => $file->getClientOriginalName(),
                    'ext' => $file->getClientOriginalExtension(),
                    'size' => $file->getSize(),
                    'path' => 'app/' . $path ,
                    'mimetype' => $file->getMimeType(),
                ]);
            }
        }
        return response($res, 200);
    }

    public function showImage(Request $request,$id){
        $h = $request->input('h', null);
        $w = $request->input('w', null);
        $image = Resource::find($id);
        $image = $image->path;
        if(!empty($image)) {
	        $img = Image::make($image);
	        if ($h || $w) {
		        $img->resize($w, $h);
	        }
	        return $img->response();
        }else{
        	return response('not image', 404);
        }
    }

	public function uploadFile(Request $request){
        $file = $request->file('sourceFile');
        //var_dump($file);
        if($file->isValid())
        {
            $path = $file->store('upload/message-files');
            if($path){
                $res = Resource::create([
                    'name' => $file->getClientOriginalName(),
                    'ext' => $file->getClientOriginalExtension(),
                    'size' => $file->getSize(),
                    'path' => 'app/' . $path ,
                    'mimetype' => $file->getMimeType(),
                ]);
            }
        }
        return response()->json([
            'data' => $res->id
        ]);

	}

	public function downloadFile(Request $request){
		$id = $request->input('id');
		$file = Resource::find($id);
		if(!empty($file)) {
			$path = storage_path($file->path);
			return response()->download($path, $file->name, ['Content-Type' => $file->mimetype]);
		}else{
			return response('has no file', 200);
		}
	}


}
