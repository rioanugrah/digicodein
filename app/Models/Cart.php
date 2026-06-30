<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'carts';
    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function cartItems()
    {
        return $this->hasMany(\App\Models\CartItem::class, 'cart_id','id');
    }
}
