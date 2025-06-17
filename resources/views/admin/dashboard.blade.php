<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar {
            height: 100vh;
            background-color: #4d82a6;
            color: white;
            padding: 20px;
        }
        .sidebar h2 {
            color: #fffbfd;
            font-size: 40px;
            font-weight: bold ;
        }
        .sidebar a {
            color: white;
            display: block;
            margin: 10px 0;
            text-decoration: none;
            font-size: 20px;
        }
        .sidebar a:hover {
            text-decoration: underline;
            color: #ffc107;
        }
        .status-waiting { background: #ffc107; color: #000; padding: 3px 10px; border-radius: 10px; }
        .status-done { background: #28a745; color: #fff; padding: 3px 10px; border-radius: 10px; }
        .status-shipping { background: #17a2b8; color: #fff; padding: 3px 10px; border-radius: 10px; }

        
    </style>
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar col-md-2">
        <h2>Dashboard</h2>
        <a href="{{ url('/admin/dashboard') }}"> Trang chính</a>
        <a href="{{ url('/admin/products') }}">Quản lý sản phẩm</a>
        <a href="{{ url('/admin/orders') }}" ></a>Quản lý đơn hàng</a>
        <a href="{{ url('/logout') }}"> Đăng xuất</a>
    </div>

    <!-- Main content -->
    <div class="p-4 col-md-10">
        <h3>Quản lý sản phẩm</h3>
        <a href="{{ url('/admin/products/create') }}" class="btn btn-primary mb-3">+ Thêm mới sản phẩm</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Ảnh</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td class="text-danger">{{ number_format($item->product_price) }}đ</td>
                    <td>
                        @if ($item->product_image && file_exists(public_path('uploads/product/' . $item->product_image)))
    <img src="{{ asset('uploads/product/' . $item->product_image) }}" width="60">
@else
    <span class="text-muted">Không có ảnh</span>
@endif

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


        <hr>
        <h3>Quản lý đơn hàng</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Tên khách hàng</th>
                    <th>Tình trạng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders ?? [] as $order)
                <tr>
                    <td>{{ $order->order_code }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>
                        @if($order->status == 'cho_xu_ly')
                            <span class="status-waiting">Chờ xử lý</span>
                        @elseif($order->status == 'da_hoan_thanh')
                            <span class="status-done">Đã hoàn thành</span>
                        @elseif($order->status == 'dang_giao')
                            <span class="status-shipping">Đang giao</span>
                        @endif
                    </td>
                    <td><a href="{{ url('/admin/orders/'.$order->id) }}" class="btn btn-sm btn-primary">Xem</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
