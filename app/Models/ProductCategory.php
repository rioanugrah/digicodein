<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'product_category';
    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(\App\Models\Product::class);
    }

    protected static function booted():void
    {
        static::created(function (ProductCategory $product_category){
            Cache::forget('product_category');
        });

        static::updated(function (ProductCategory $product_category){
            Cache::forget('product_category');
        });
    }
}
