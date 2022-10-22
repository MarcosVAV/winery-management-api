<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'product_type_id',
        'weight',
        'price',
        'brand',
    ];

    public function salesOrders()
    {
        return
            $this->belongsToMany(SalesOrder::class, 'sales_order_product', 'product_id', 'sales_order_id')
            ->withPivot('quantity');
    }
}
