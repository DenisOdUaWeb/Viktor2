<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;

class UploadsController extends Controller
{
    //
    public function store()
    {
        if(! is_dir(public_path('/images'))){
            mkdir(public_path('/images'), 0777); //mode: permition 0777 
        }
        
        //$images = request()->file(key: 'file');
        $images = Collection::wrap(request()->file('file'));
        $images->each(function($image){
            $image -> move(public_path('/images'), 'abc.' . $image->getClientOriginalExtension());
        });
        
        
        //dd($images);
    }
}
