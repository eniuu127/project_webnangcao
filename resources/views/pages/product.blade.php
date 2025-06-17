@extends('layouts.app')
@section('content')
<h2 class="text-center mb-4">Tất cả sản phẩm</h2>
<div class="row justify-content-center">
    @foreach($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card product-card">
                <img src="{{ asset('uploads/product/' . $product->product_image) }}"
                     alt="{{ $product->product_name }}"
                     class="card-img-top" style="max-height: 220px; object-fit: contain;">

                <div class="card-body text-center">
                    <div class="product-name">{{ $product->product_name }}</div>
                    <div class="product-price text-danger">{{ number_format($product->product_price) }}đ</div>
                   @auth
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-default add-to-cart">
                                <i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng
                            </button>
                        </form>

                    @endauth

                    @guest
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm mt-2">
                            <i class="fa fa-shopping-cart"></i> Đăng nhập để mua
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
