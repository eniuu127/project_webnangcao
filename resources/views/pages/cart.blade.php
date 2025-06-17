@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2 class="mb-4">🛒 Giỏ hàng của bạn</h2> <br>

    @if(count($cartItems) > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Ảnh</th>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Xóa</th>
            </tr>
        </thead>

        <tbody>
            @foreach($cartItems as $item)
            <tr>
                <td>
                    <img src="{{ asset('uploads/product/' . $item->product->product_image) }}" width="60" height="60" class="img-thumbnail">
                </td>
                <td>{{ $item->product->product_name }}</td>
                <td class="price-cell" data-price="{{ $item->product->product_price }}">
                    {{ number_format($item->product->product_price * $item->quantity) }}đ
                </td>

                <td>
                    <input type="hidden" name="cart_ids[]" value="{{ $item->id }}">
                    <input type="number" name="quantities[]" value="{{ $item->quantity }}" min="1"
                        class="form-control quantity-input" style="width: 80px;">
                </td>
                <td>
                    <a href="{{ route('cart.remove', $item->id) }}" class="btn btn-danger btn-sm"
                    onclick="return confirm('Xóa sản phẩm này?')">Xóa</a>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

        <div class="text-end">
            <h5><strong>Tổng tiền: <span id="cart-total">{{ number_format($total) }}</span>đ</strong></h5>
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ route('cart.checkout') }}" class="btn btn-success">🧾 Thanh toán</a>
        </div>
        @else
            <p class="text-muted">Giỏ hàng của bạn đang trống.</p>
        @endif
    </div>

    <!--jQuery + AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
        const quantityInputs = document.querySelectorAll('.quantity-input');
        const priceCells = document.querySelectorAll('.price-cell');

        const formatCurrency = number =>
            new Intl.NumberFormat('vi-VN').format(number);

        function updatePrices() {
            let total = 0;
            quantityInputs.forEach((input, index) => {
                const quantity = parseInt(input.value);
                const unitPrice = parseInt(priceCells[index].dataset.price);
                const newPrice = unitPrice * quantity;

                // Cập nhật giá từng dòng
                priceCells[index].innerText = formatCurrency(newPrice) + 'đ';

                // Cộng tổng
                total += newPrice;
            });

            // Cập nhật tổng tiền
            document.getElementById('cart-total').innerText = formatCurrency(total);
        }

        // Gắn sự kiện onchange cho ô số lượng
        quantityInputs.forEach(input => input.addEventListener('input', updatePrices));
    </script>
@endsection
