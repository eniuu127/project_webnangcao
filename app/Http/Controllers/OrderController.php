<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    // Hàm xử lý thanh toán
    public function checkout()
    {
        // Lấy danh sách sản phẩm trong giỏ hàng
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        // Nếu giỏ hàng trống
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        // Tính tổng tiền
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->product->product_price * $item->quantity;
        }

        // Tạo đơn hàng mới
        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $total,
        ]);

        // Tạo các mục trong đơn hàng
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->product_price,
            ]);
        }

        // Xóa giỏ hàng sau khi thanh toán
        Cart::where('user_id', Auth::id())->delete();

        // Redirect với thông báo
        return redirect()->route('cart.view')->with('success', 'Đặt hàng thành công!');
    }

    public function placeOrder(Request $request)
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Giỏ hàng trống!');
        }

        // 1. Tạo đơn hàng
        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'note' => $request->note,
            'delivery_method' => $request->delivery_method,
            'total' => $cartItems->sum(fn($item) => $item->product->product_price * $item->quantity) + 20000,
        ]);

        // 2. Tạo từng sản phẩm trong đơn
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product->id,
                'quantity' => $item->quantity,
                'price' => $item->product->product_price,
            ]);
        }

        // 3. Xoá giỏ hàng
        Cart::where('user_id', Auth::id())->delete();

        // 4. Chuyển hướng kèm thông báo
        return redirect()->route('order.history')->with('success', 'Đặt hàng thành công!');
    }

    public function orderHistory()
    {
        $orders = Order::where('user_id', Auth::id())->with('orderItems.product')->get();
        return view('pages.order_history', compact('orders'));
    }
}
