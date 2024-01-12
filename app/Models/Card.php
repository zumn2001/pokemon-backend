<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $guarded=[];
    use HasFactory;
    public function image(){
        return $this->belongsTo(Image::class);
    }
    public function rarity(){
        return $this->belongsTo(Rarity::class);
    }
    public function set(){
        return $this->belongsTo(Set::class);
    }
    public function type(){
        return $this->belongsTo(Type::class);
    }
}
