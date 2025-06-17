<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card shadow p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3> Danh sách sản phẩm</h3>
            <a href="{{ url('/admin/products/create') }}" class="btn btn-primary">+ Thêm sản phẩm</a>
        </div>

        <table class="table table-bordered align-middle table-hover">
            <thead class="table-light text-center">
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Giá</th>
                    <th>Ảnh</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
            @foreach($products as $item)
                <tr class="text-center">
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td class="text-danger">{{ number_format($item->product_price) }}đ</td>
                    <td>
                        @if($item->product_image)
                            <img src="{{ url('uploads/product/' . $item->product_image) }}" width="80" class="img-thumbnail">
                        @else
                            <span class="text-muted">Không có ảnh</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ url('/admin/products/' . $item->id . '/edit') }}" class="btn btn-sm btn-warning"> Sửa</a>
                        <a href="{{ url('/admin/products/' . $item->id . '/delete') }}" onclick="return confirm('Xoá sản phẩm?')" class="btn btn-sm btn-danger">Xoá</a>
                    </td>
                </tr>
            @endforeach
            @if($products->isEmpty())
                <tr>
                    <td colspan="5" class="text-center text-muted">Không có sản phẩm nào</td>
                </tr>
                @endif
            </tbody>
        </table>

        <a href="{{ url('/admin/dashboard') }}" class="btn btn-secondary mt-2">← Quay lại Dashboard</a>
    </div>
</div>
</body>
</html>