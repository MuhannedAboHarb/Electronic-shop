<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'number' ,'user_id' ,  'status' , 'payment_status' , 'payment_method' ,  
        'payment_transaction_id', 'payment_data'  , 'discount' , 'tax' , 'total' , 
        'ip' , 'user_agent' 
    ];

    protected static function booted() //بضيف فيها قلوبل سكوب وبالاضافة لليفنت
    {
        static::creating(function(Order $order){
            // الرقم راح يكون رقم السنة الحالية منو الرقم تاع الطلب
            
            $now = Carbon::now();
            // SELECT MAX(number) FROM orders WHERE YEAR(created_at) = 2023
           $number = Order::whereYear('created_at' , $now->year )->max('number');
           if(!$number)
                {
                    $number = $now->year . '00001';
                }
           else
                {
                    $number++;
                }
            
            $order->number = $number ;     
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function  addresses()  // الطلب له علاقة مع العنوان ومع العنصر نفسه بحيث عندي الطلب الواحد له عدة عناويين يعني واحد لمتعدد
    {
        return $this->hasMany(OrderAddress::class , 'order_id' , 'id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
    

    public function products()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id')->with('product');
    }
    
}
