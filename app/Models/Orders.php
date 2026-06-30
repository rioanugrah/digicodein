<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'orders';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function payments()
    {
        return $this->belongsTo(\App\Models\Payments::class, 'payment_id','id');
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'order_item','product_name');
    }

    public function orderItems()
    {
        return $this->hasMany(\App\Models\OrderItems::class, 'order_id','id');
    }
}
