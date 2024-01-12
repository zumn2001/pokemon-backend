<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $guarded=[];
    use HasFactory;
    public function payment(){
        return $this->belongsTo(Payment::class);
    }
    public function cards(){
        return $this->hasMany(Card::class);
    }
}
