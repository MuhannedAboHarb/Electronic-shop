<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        $newproducts = Product::latest()->limit(12)->get();
        $topSales = Product::inRandomOrder()->limit(12)->get();

        return view('store.home',[
            'newproducts' => $newproducts ,
            'topSales'=>$topSales
        ]);
    }
}
