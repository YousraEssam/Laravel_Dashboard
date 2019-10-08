<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait Uploads
{
    public function uploadFile(Request $request, $modelInstance)
    {
        if($this->checkSingleOrMultipleFile($request)){
            $paths = [];
            foreach($request->file('file') as $file){
                $paths[] = $file->store('public/uploads/files/'.explode('\\',get_class($modelInstance))[1]);
            }
            return $paths;
        }else{
            $path = $request->file('file')->store('public/uploads/files/'.explode('\\',get_class($modelInstance))[1]);
            return $path;
        }
    }

    public function uploadImage(Request $request, $modelInstance)
    {
        if($this->checkSingleOrMultipleImage($request)){
            $paths = [];
            foreach($request->file('image') as $file){
                $paths[] = $file->store('public/uploads/images/'.explode('\\',get_class($modelInstance))[1]);
            }
            return $paths;
        }else{
            $path = $request->file('image')->store('public/uploads/images/'.explode('\\',get_class($modelInstance))[1]);
            return $path;
        }
    }

    public function checkSingleOrMultipleFile(Request $request){
        return is_array($request->file('file')) ? true : false;
    }

    public function checkSingleOrMultipleImage(Request $request){
        return is_array($request->file('image')) ? true : false;
    }
}