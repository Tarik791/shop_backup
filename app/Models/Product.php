<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'product_price', 'product_handle', 'product_uuid',
        'created_at', 'updated_at'
    ];

    public function variants()
    {
        return $this->hasMany(Variant::class, 'product_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}
