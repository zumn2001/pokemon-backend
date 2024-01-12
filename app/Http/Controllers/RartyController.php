<?php

namespace App\Http\Controllers;

use App\Http\Requests\RarityRequest;
use App\Http\Resources\RarityResource;
use App\Models\Rarity;
use Illuminate\Http\Request;

class RartyController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->success('all rarties',RarityResource::collection(Rarity::all()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RarityRequest $request)
    {
        $data = $request->validated();
        $rarity = Rarity::create($data);
        return $this->success('create successfully!',new RarityResource($rarity));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rarity = Rarity::find($id);
        if (!$rarity) {
            return $this->error( "rarity has not been found",[]);
        }
        return $this->success('Details of rarity',new RarityResource($rarity));
    }
    public function update(RarityRequest $request, $id)
    {
        $rarity = Rarity::where('id', $id)->first();
        if (!$rarity) {
            return $this->error( "rarity has not been found",[]);
        }
        $data = $request->validated();
        $rarity->update($data);
        return $this->success('updated',new RarityResource($rarity));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rarity = Rarity::where('id', $id)->first();

        if (!$rarity) {
            return $this->error("rarity has not been found",[]);
        }
        $rarity->delete();
        return response()->json([
            'condition'=> true,
            'message' => "Delete!",
        ],200);    
    }
}
