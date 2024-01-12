<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    public function order_item()  
    {
        return $this->hasMany(OrderItem::class);
    }
    public function card(){
        return $this->hasMany(Card::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
