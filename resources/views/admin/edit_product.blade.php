<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh sửa sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card shadow p-4">
        <h3 class="mb-4">✏️ Chỉnh sửa sản phẩm</h3>

        <form method="POST" action="{{ url('/admin/products/' . $product->id . '/update') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Tên sản phẩm</label>
                <input type="text" name="product_name" class="form-control" value="{{ $product->product_name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Giá tiền (VNĐ)</label>
                <input type="number" name="product_price" class="form-control" value="{{ $product->product_price }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Ảnh hiện tại</label><br>
                @if($product->product_image)
                    <img src="{{ url('uploads/product/' . $product->product_image) }}" width="120" class="img-thumbnail mb-2">
                @else
                    <p class="text-muted">Chưa có ảnh</p>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">Cập nhật ảnh mới (nếu có)</label>
                <input type="file" name="product_image" class="form-control">
            </div>

            <button type="submit" class="btn btn-success"> Lưu thay đổi</button>
            <a href="{{ url('/dashboard') }}" class="btn btn-dark">← Quay lại Dashboard</a>


        </form>
    </div>
</div>
</body>
</html>
