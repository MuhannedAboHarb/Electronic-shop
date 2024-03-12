<?php

namespace App\Repositories\Cart ;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DatabaseRepository implements CartRepository
{   
     protected $items;

     protected $cookie_id ;

     public function __construct($cookie_id)
     {
        $this->cookie_id = $cookie_id ;
     }

     /**
      * @return \Illuminate\Database\Eloquent\Builder;
      */
     protected function query()
     {
         $id = Auth::id();
         $query = Cart::with('product');
         if ($id) {
             $query->where('user_id', '=', $id);
         } else {
             $query->where('cookie_id', '=', $this->cookie_id);
         }
         return $query;
     }

    // بترجع جميع العناصر داخل السلة
    public function all()
    {
        if ($this->items === null) {
            $this->items = $this->query()->get();
        }
        return $this->items;
    }

    public function add ($item , $qty = 1)
    {

        $cook_id = $this->cookie_id;   //تبديل

        $cart = Cart::where([
            'cookie_id'=> $cook_id,
            'product_id'=> $item,
        ])->first();

        if(! $cart)
        {
            Cart::create([
                'id'=> Str::uuid() , //genrate random id 
                'cookie_id'=> $cook_id,
                'user_id'=> Auth::id(), // بترجع نل في حال لايوجد اي دي
                'product_id'=> $item,
                'quantity'=> $qty, // الواحد قيمة افتراضية
            ]);
        } else {
            $cart->increment('quantity', $qty );
        }         
    }
    
    public function remove($id)
    {
        $this->query()->where('id', '=', $id)->delete();
    }

    // حذف كل عناصر السلة
    public function empty()
    {
        $this->query()->delete();
    }
    //مجموع السلة
    public function total()
    {
        return $this->all()->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    }

    public function setUserId($id)
    {
        $user =  Auth::user();  // or this   $user = auth()->user();     

        Cart::where('cookie_id' , '=' ,$this->cookie_id)
            ->whereNull('user_id') // user_id IS NULL
            ->update([
                'user_id' => $id
            ]);
    }

}