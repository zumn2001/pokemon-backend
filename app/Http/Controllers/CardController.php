<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardRequest;
use App\Http\Resources\CardResource;
use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->success('all cards',CardResource::collection(Card::all()));
    }

    public function store(CardRequest $request)
    {
        $data = $request->validated();
        $card = Card::create($data);
        return $this->success('created successfully',new CardResource($card)); 
    }

    public function show($id)
    {
        $card = Card::find($id);
        if(!$card){
            return $this->error('card has not been found',[]);
        }
        return $this->success('details of card',new CardResource($card));
    }


    public function update(CardRequest $request, string $id)
    {
        $card = Card::where('id',$id)->first();
        if (!$card) {
            return $this->error('card has not been found!',[]);
        }
        $data = $request->validated();
        $card->update($data);
        return $this->success('updated successfully!',new CardResource($card));
    }

    public function destroy(string $id)
    {
        $card = Card::where('id', $id)->first();

        if (!$card) {
            return $this->error("card has not been found",[]);
        }
        $card->delete();
        return response()->json([
            'condition'=> true,
            'message' => "Delete!",
        ],200);      
    }
}
