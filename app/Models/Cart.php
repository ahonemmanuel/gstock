<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'status'];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function getTotalAttribute()
    {
        return $this->items->sum(function($item) {
            return $item->quantity * $item->product->price;
        });
    }
}
