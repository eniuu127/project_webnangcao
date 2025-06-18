@extends('layouts.header')

@section('content')
<div class="container" style="max-width: 1100px; margin: 40px auto; font-size: 18px;">

    <h2 style="text-align: center; margin-bottom: 30px;">🧾 Lịch sử đơn hàng</h2>

    @foreach ($orders as $order)
    <div style="border: 1px solid #ccc; border-radius: 8px; margin-bottom: 20px; padding: 20px;">
        <p><strong>📦 Mã đơn:</strong> {{ $order->id }}</p>
        <p><strong>💰 Tổng tiền:</strong> {{ number_format($order->total) }}đ</p>
        <p><strong>📅 Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
        <p><strong>🛒 Sản phẩm:</strong></p>

        <div style="padding-left: 10px;">
            @foreach ($order->orderItems as $item)
                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px;">
                    <img src="{{ asset('uploads/product/' . $item->product->product_image) }}" alt="{{ $item->product->product_name }}" width="60" height="60" style="border-radius: 6px; border: 1px solid #ddd;">
                    <div>
                        <p style="margin: 0;"><strong>{{ $item->product->product_name }}</strong></p>
                        <p style="margin: 0;">SL: {{ $item->quantity }} x {{ number_format($item->price) }}đ</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>
@endsection
