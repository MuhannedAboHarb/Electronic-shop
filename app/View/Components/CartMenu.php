<?php

namespace App\View\Components;

use App\Models\Cart;
use App\Repositories\Cart\CartRepository;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\Component;
use Illuminate\Support\Str;

class CartMenu extends Component
{
    public $cart ;

    public $total = 0 ; 
    /**
     * Create a new component instance.
     */
    public function __construct(CartRepository $cart)
    {
       
       // $cart = App::make(CartRepository::class);
        $this->cart = $cart->all();
        $this->total = $cart->total();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cart-menu');
    }

   
}
