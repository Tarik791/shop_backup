<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    protected $fillable = [
        'product_id', 'product_uuid', 'variant_price', 'variant_handle',
        'variant_uuid', 'variant_image_id', 'created_at', 'updated_at'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
