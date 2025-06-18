@extends('layouts.header') {{-- nếu bạn có layout riêng --}}
@section('content')
<div class="container" style="max-width: 768px; margin: 20px auto;">
    <h2 style="text-align: center;">Xác nhận đặt hàng</h2>

    <form action="{{ route('order.place') }}" method="POST">
        @csrf

        {{-- Thông tin người nhận --}}
        <div class="form-group">
            <label>Nhập tên khách hàng</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Nhập số điện thoại</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Nhập địa chỉ email (không bắt buộc)</label>
            <input type="email" name="email" class="form-control">
        </div>

        {{-- Hình thức nhận hàng --}}
        <div class="form-group">
            <label>Hình thức nhận hàng</label><br>
            <input type="radio" name="delivery_method" value="home" checked> Giao tận nơi
            <input type="radio" name="delivery_method" value="store"> Nhận tại cửa hàng
        </div>

        <div class="form-group">
            <label>Tỉnh/Thành phố, Quận/Huyện, Phường/Xã</label>
            <input type="text" name="address" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Nhập ghi chú (không bắt buộc)</label>
            <textarea name="note" class="form-control"></textarea>
        </div>

        {{-- Chi tiết đơn hàng --}}
        <h4>Chi tiết đơn hàng</h4>
        @foreach ($cartItems as $item)
        <div style="display: flex; gap: 10px; align-items: center; margin-bottom: 10px;">
           <img src="{{ asset('uploads/product/' . $item->product->product_image) }}" width="70">

            <div>
                <p><strong>{{ $item->product->product_name }}</strong></p>
                <p>SL: {{ $item->quantity }}</p>
                <p>{{ number_format($item->product->product_price) }}đ</p>
            </div>
        </div>
        @endforeach

        {{-- Tổng kết thanh toán --}}
        <div class="payment-summary" style="border-top: 1px solid #ccc; padding-top: 10px;">
            <p><strong>Tổng tiền:</strong> {{ number_format($total) }}đ</p>
            <p><strong>Phí vận chuyển:</strong> 20.000đ</p>
            <p><strong>Thành tiền:</strong> <span style="color: red;">{{ number_format($total + 20000) }}đ</span></p>
        </div>

        <div style="text-align: right; margin-top: 20px;">
            <button type="submit" class="btn btn-warning">Đặt hàng</button>
        </div>
    </form>
</div>
@endsection
