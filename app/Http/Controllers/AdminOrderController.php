<?php

namespace App\Http\Controllers;

use App\Models\Order;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        return view('admin.orders', compact('orders'));
    }
    public function approve($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'da_hoan_thanh';
        $order->save();

        return redirect()->back()->with('success', '✔ Đơn hàng đã được duyệt!');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->back()->with('success', '🗑 Đã xoá đơn hàng!');
    }

}


