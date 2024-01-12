<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetRequest;
use App\Http\Resources\SetResource;
use App\Models\Set;
use Illuminate\Http\Request;

class SetController extends BaseController
{

    public function index()
    {
        return $this->success('all sets',SetResource::collection(Set::all()));
    }

    public function store(SetRequest $request)
    {
        $data = $request->validated();
        $set = Set::create($data);
        return $this->success('create successfully!',new SetResource($set));
    }

    public function show( $id)
    {
        $set = Set::find($id);
        if (!$set) {
            return $this->error( "set has not been found",[]);
        }
        return $this->success('Details of set',new SetResource($set));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(SetRequest $request, string $id)
    {
        $set = Set::where('id', $id)->first();
        if (!$set) {
            return $this->error( "set has not been found",[]);
        }
        $data = $request->validated();
        $set->update($data);
        return $this->success('updated',new SetResource($set));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $set = Set::where('id', $id)->first();

        if (!$set) {
            return $this->error("set has not been found",[]);
        }
        $set->delete();
        return response()->json([
            'condition'=> true,
            'message' => "Delete!",
        ],200);      
    }
}
