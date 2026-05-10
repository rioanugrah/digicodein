<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItems extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'order_items';
    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(\App\Models\Product::class, 'order_item','product_name')->select('product_link','product_link_description');
    }

}
