<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeRequest;
use App\Http\Resources\TypeResource;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends BaseController
{

    public function index()
    {
        return $this->success('all types',TypeResource::collection(Type::all()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeRequest $request)
    {
        $data = $request->validated();
        $type = Type::create($data);
        return $this->success('create successfully!',new TypeResource($type));
    }

    public function show($id)
    {
        $type = Type::find($id);
        if (!$type) {
            return $this->error( "type has not been found",[]);
        }
        return $this->success('Details of type',new TypeResource($type));
    }


    public function update(TypeRequest $request, string $id)
    {
        $type = Type::where('id', $id)->first();
        if (!$type) {
            return $this->error( "type has not been found",[]);
        }
        $data = $request->validated();
        $type->update($data);
        return $this->success('updated',new TypeResource($type));
    }

    public function destroy(string $id)
    {
        $type = Type::where('id', $id)->first();

        if (!$type) {
            return $this->error("type has not been found",[]);
        }
        $type->delete();
        return response()->json([
            'condition'=> true,
            'message' => "Delete!",
        ],200);  
    }
}
