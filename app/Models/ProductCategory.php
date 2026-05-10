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
}
