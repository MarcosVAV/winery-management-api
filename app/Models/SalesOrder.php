<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_price',
        'freight_value',
        'delivery_distance_in_km',
    ];

    public function products()
    {
        return
            $this->belongsToMany(Product::class, 'sales_order_product', 'sales_order_id', 'product_id')
            ->withPivot('quantity');
    }
}
