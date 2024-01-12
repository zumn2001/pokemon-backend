<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'image_id'=>$this->image->image,
            'price'=> $this->price,
            'quantity'=>$this->quantity,
            'rarity_id'=>$this->rarity->rarity,
            'set_id'=>$this->set->set,
            'type_id'=>$this->type->type,
            'status'=>$this->status

        ];
    }
}
