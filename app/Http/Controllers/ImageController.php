<?php

namespace App\Http\Controllers;

use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->success('all images' , ImageResource::collection(Image::all()));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'image' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->errors($validator->errors() , "validation error");
        }

        $image = new Image();   
        $filename = time()."_".$req->file('image')->getClientOriginalName();
        $req->file('image')->move(public_path('image'),$filename);
        $image->image = $filename;
        $image->save();

        return $this->success('created successfully!' , new ImageResource($image));
    }

}
