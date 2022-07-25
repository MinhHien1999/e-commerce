<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Cart;

class CartController extends Controller
{
    //
    public function store(Request $request)
    {
        try {
            $product = Product::getProductById($request->id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['msg' => 'fail']);
        }
        Cart::add($product->id, $product->title, 1, 
        ($product->price - ($product->price * $product->discount/100)) ,0,
        ['discount' => $product->discount, 'image' =>$product->image]);
        
        return response()->json(['msg' => 'success']);
    }
    public function delete(Request $request){
        $result = Cart::remove($request->id);
        return response()->json(['data' => [
            'count' => Cart::count(),
            'subtotal' => Cart::subtotal(0,'.',',').' đ',
        ]]);
    }
    public function cart(Request $request){
        // dd($request->qty);
        foreach($request->qty as $rowId => $value){
            Cart::update($rowId, $value);
        }
        return redirect()->route('cart');
    }
}