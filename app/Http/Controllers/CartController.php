<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart($id)
    {
        $cart = Cart::where('user_id', Auth::id())
                    ->where('product_id', $id)
                    ->first();

        if ($cart) {
            $cart->quantity += 1;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
    }
    
    public function removeFromCart($id)
    {
        $cart = Cart::find($id);
        if ($cart && $cart->user_id == Auth::id()) {
            $cart->delete();
        }

        return redirect()->route('cart.view')->with('success', 'Đã xóa sản phẩm');
    }

    public function viewCart()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item->product->product_price * $item->quantity;
        }

        return view('pages.cart', compact('cartItems', 'total'));
    }


    public function updateQuantity(Request $request)
    {
        foreach ($request->cart_ids as $index => $id) {
            $cart = Cart::find($id);
            if ($cart && $cart->user_id == Auth::id()) {
                $cart->quantity = $request->quantities[$index];
                $cart->save();
            }
        }

        return redirect()->back()->with('success', 'Đã cập nhật số lượng');
    }
        public function checkout()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item->product->product_price * $item->quantity;
        }

        return view('pages.checkout', compact('cartItems', 'total'));
    }
    public function ajaxUpdateQuantity(Request $request)
    {
        $cart = Cart::find($request->cart_id);

        if ($cart && $cart->user_id == Auth::id()) {
            $cart->quantity = $request->quantity;
            $cart->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 403);
    }


}
