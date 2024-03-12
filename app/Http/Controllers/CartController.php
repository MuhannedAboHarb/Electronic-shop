<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str; //////////////////////

class CartController extends Controller
{
    // List of cart products (itme)
    public function index(CartRepository $cart)
    {
        return view('store.cart' , [
            'cart' => $cart
        ]);
    }

    // Add Product to cart
    public function store(Request $request , CartRepository $cart)
    {
        $request->validate([
            'product_id' => ['required','integer','exists:products,id'] ,
            'quantity' => ['integer','min:1']
        ]);

        $cart->add($request->post('product_id') , $request->post('quantity'));

        return redirect()->back()->with('success' , 'Product added to Cart');
    }

    public function destroy(CartRepository $cart , $id )
    {
        $cart->remove($id);
        return redirect()->back()->with('success' , 'Item removed from the Cart');
    }


}
