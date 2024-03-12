<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OrderItem extends Model
{
    use HasFactory;

    public $incrementing = false ; // عشني حاطط uuid

    protected $keyType = 'string';

    public $timestamps = false ;


    protected $fillable = [
        'order_id' , 'product_id' , 'product_name' , 'price' , 'quantity'
    ];

    protected static function booted()
    {
        static::creating(function(OrderItem $item){
            $item->id = Str::uuid();
        });
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
