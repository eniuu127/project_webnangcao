<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

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
    public function processCheckout(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'payment_method' => 'required|string',
        ]);

        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        $total = $cartItems->sum(fn($item) => $item->product->product_price * $item->quantity);

        $order = Order::create([
            'user_id' => Auth::id(),
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'total' => $total,
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->product_price,
            ]);
        }

        Cart::where('user_id', Auth::id())->delete();

         return redirect()->route('cart.view')->with('success', 'Đơn hàng đã được đặt thành công!');

    }
    public function placeOrder(Request $request)
    {
        return redirect('/')->with('success', 'Đặt hàng thành công!');
    }

}
