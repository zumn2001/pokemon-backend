<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function success($message , $data)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
            'condition' => true
        ] , 200);
    }

    public function error($errors = [] , $message = "" ,)
    {
        return response()->json([
            "message" => $message,
            "errors" => $errors
        ] , 419);
    }
}
