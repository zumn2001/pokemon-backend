<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rarity extends Model
{
    protected $guarded=[];
    use HasFactory;
    public function card(){
        return $this->hasMany(Card::class);
    }
}
