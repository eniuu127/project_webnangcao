<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card shadow p-4">
        <h3 class="mb-4">🆕 Thêm sản phẩm mới</h3>

        {{-- Hiển thị lỗi nếu có --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url('/admin/products') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="product_name" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" name="product_name" id="product_name" required>
            </div>

            <div class="mb-3">
                <label for="product_price" class="form-label">Giá tiền (VNĐ)</label>
                <input type="number" class="form-control" name="product_price" id="product_price" required min="0">
            </div>

            <div class="mb-3">
                <label for="product_image" class="form-label">Ảnh sản phẩm</label>
                <input type="file" class="form-control" name="product_image" id="product_image" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">💾 Lưu sản phẩm</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">← Quay lại Dashboard</a>
        </form>
    </div>
</div>
</body>
</html>
