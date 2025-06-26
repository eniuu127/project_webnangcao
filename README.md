# 🧥 Website Bán Quần Áo - Clothing Shop

## 👩‍🎓 Thông tin sinh viên
- **Họ và tên:** Vũ Thị Hải Yến  
- **Mã sinh viên:** 23010421  
- **Lớp:** K17-CNTT4  
- **Môn học:** Thiết kế Web nâng cao (TH3)

---
## 📄 Giới thiệu dự án

**Clothing Shop** là website thương mại điện tử đơn giản bán các mặt hàng thời trang như váy, bikini, đồ hè, đồ mặc đi biển,... Dự án được phát triển bằng Laravel Framework với thiết kế hiện đại, dễ sử dụng và tích hợp các công nghệ phổ biến:

- **Laravel Breeze** – Đăng ký / đăng nhập người dùng và phân quyền cơ bản
- **Blade Template Engine** – Tạo bố cục và view tái sử dụng
- **Tailwind CSS** – Thiết kế giao diện responsive, hiện đại
- **Eloquent ORM** – Quản lý dữ liệu theo mô hình đối tượng
- **MySQL (Cloud – Aiven)** – Cơ sở dữ liệu lưu trực tuyến
- **Bảo mật hệ thống**:
    - Token CSRF – bảo vệ form
    - Session & Cookie – quản lý trạng thái đăng nhập
    - Validation – kiểm tra dữ liệu đầu vào
    - Phòng chống **SQL Injection** & **XSS**

## 🧩 Chức năng chính
### 👤 Người dùng
- Đăng ký / đăng nhập
- Xem sản phẩm (quần áo)
- Thêm sản phẩm vào giỏ hàng
- Thanh toán đơn hàng
- Xem lịch sử mua hàng
### 🛠 Quản trị viên (Admin)
- Đăng nhập riêng biệt
- CRUD sản phẩm (quần áo)
- Quản lý đơn hàng
- Quản lý người dùng
## ⚙️ Công nghệ sử dụng

| Công nghệ         | Mô tả                                              |
|------------------|----------------------------------------------------|
| Laravel          | Framework PHP chính                                |
| Laravel Breeze   | Xác thực người dùng, session                        |
| Blade + Bootstrap| Giao diện người dùng hiện đại                       |
| Eloquent ORM     | Truy vấn và thao tác dữ liệu theo mô hình OOP      |
| MySQL (Aiven)    | Cơ sở dữ liệu trực tuyến (cloud database)          |
| Middleware       | Phân quyền, kiểm tra truy cập, CSRF token          |
---
## Sơ đồ khối
![Biểu đồ không có tiêu đề drawio (3)](https://github.com/user-attachments/assets/065663b7-303e-4d0b-a33f-b80654adc587)
---
## Sơ đồ chức năng
![Biểu đồ không có tiêu đề drawio (6)](https://github.com/user-attachments/assets/04d5f583-12e9-4fa7-9f34-278ac2544055)
---
## Class Diagram of Objects 
![1 drawio](https://github.com/user-attachments/assets/9b8c1758-4ffb-4e3f-bb07-c30fbaed4133)
![2 drawio](https://github.com/user-attachments/assets/a8dde2d1-f981-4ebe-879f-8635198ed0da)
![3 drawio](https://github.com/user-attachments/assets/6f16f81d-b700-4cfc-be7c-fde89de6ca9a)
![4 drawio](https://github.com/user-attachments/assets/d06198f8-841d-4104-b0b1-8b279e189c71)


## Một số Code chính minh họa
### Model - Product

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name',
        'product_price',
        'product_image',
    ];
}

```
### Model - Cart
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Cart extends Model
{
    protected $table = 'cart';

    protected $fillable = ['user_id', 'product_id', 'quantity'];

    // Quan hệ: 1 Cart thuộc về 1 Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

```

### Model Order
```php
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'name', 'phone', 'email', 'address', 'note',
        'delivery_method', 'payment_method', 'total', 'status'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

### Model OrderItem
```php
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price'
    ];

   
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
```
### Controller - Product
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('admin.all_product', compact('products'));
    }

    public function create() {
        return view('admin.add_product');
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/product'), $imageName);
            $product->product_image = $imageName;
        }

        $product->save();

        return redirect('/admin/products')->with('success', 'Thêm sản phẩm thành công');
    }   

    public function edit($id) {
        $product = Product::findOrFail($id);
        return view('admin.edit_product', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/product'), $imageName);
            $product->product_image = $imageName;
        }

        $product->save();

        return redirect('/admin/products')->with('success', 'Cập nhật thành công');
    }


    public function destroy($id) {
        Product::destroy($id);
        return redirect('/admin/products');
    }

    public function showProducts()
    {
         $products = Product::all();
        return view('pages.Product', compact('products'));
    }
}
```
### Controller - Admin
``` php
<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
    
            if (auth()->user()->is_admin) {
                return redirect()->route('admin.dashboard');
            }

            Auth::logout();
            return back()->withErrors(['email' => 'Bạn không có quyền vào admin']);
        }

        return back()->withErrors(['email' => 'Thông tin đăng nhập không hợp lệ']);
    }

    public function dashboard()
    {   
        $products = Product::all(); 
        return view('admin.dashboard', compact('products'));
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        return view('admin.dashboard');
    }
}
```
### Controller - Cart
```php
<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    public function addToCart($id)
    {
        $cart = Cart::where('user_id', Auth::id())
                    ->where('product_id', $id)
                    ->first();

        if ($cart) {
            $cart->quantity += 1;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
    }
    
    public function removeFromCart($id)
    {
        $cart = Cart::find($id);
        if ($cart && $cart->user_id == Auth::id()) {
            $cart->delete();
        }

        return redirect()->route('cart.view')->with('success', 'Đã xóa sản phẩm');
    }

    public function viewCart()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item->product->product_price * $item->quantity;
        }

        return view('pages.cart', compact('cartItems', 'total'));
    }


    public function updateQuantity(Request $request)
    {
        foreach ($request->cart_ids as $index => $id) {
            $cart = Cart::find($id);
            if ($cart && $cart->user_id == Auth::id()) {
                $cart->quantity = $request->quantities[$index];
                $cart->save();
            }
        }

        return redirect()->back()->with('success', 'Đã cập nhật số lượng');
    }
        public function checkout()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item->product->product_price * $item->quantity;
        }

        return view('pages.checkout', compact('cartItems', 'total'));
    }
    public function ajaxUpdateQuantity(Request $request)
    {
        $cart = Cart::find($request->cart_id);

        if ($cart && $cart->user_id == Auth::id()) {
            $cart->quantity = $request->quantity;
            $cart->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 403);
    }
    public function processCheckout(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'payment_method' => 'required|string',
        ]);

        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        $total = $cartItems->sum(fn($item) => $item->product->product_price * $item->quantity);

        $order = Order::create([
            'user_id' => Auth::id(),
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'total' => $total,
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->product_price,
            ]);
        }

        Cart::where('user_id', Auth::id())->delete();

         return redirect()->route('cart.view')->with('success', 'Đơn hàng đã được đặt thành công!');

    }
    public function placeOrder(Request $request)
    {
        return redirect('/')->with('success', 'Đặt hàng thành công!');
    }

}
```
### Controller - Order
``` php
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
```

### Route
``` php
<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminOrderController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/trang-chu', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    abort(403, 'Không có quyền truy cập.');
})->middleware(['auth', 'verified', 'admin']);
Route::get('/dashboard', function () {
    return redirect('/san-pham'); 
})->middleware(['auth'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// backend
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');

// product

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/products', [ProductController::class, 'index']);
Route::get('/admin/products/create', [ProductController::class, 'create']);
Route::post('/admin/products', [ProductController::class, 'store']);
Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit']);
Route::post('/admin/products/{id}/update', [ProductController::class, 'update']);
Route::get('/admin/products/{id}/delete', [ProductController::class, 'destroy']);
Route::get('/admin/orders', [AdminOrderController::class, 'index']);


// admin them san pham
Route::get('/san-pham', [ProductController::class, 'showProducts']);
require __DIR__.'/auth.php';

// cart
Route::post('/them-gio-hang/{id}', [CartController::class, 'addToCart'])->middleware('auth')->name('cart.add');

Route::get('/gio-hang', [CartController::class, 'viewCart'])->name('cart.view');
Route::get('/gio-hang/xoa/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/gio-hang/cap-nhat', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::get('/thanh-toan', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/update-quantity', [CartController::class, 'ajaxUpdateQuantity'])->name('cart.ajax.update');

// checkout
Route::get('/thanh-toan', [CartController::class, 'checkout']);
//Route::get('/thanh-toan', [CartController::class, 'checkoutForm'])->name('cart.checkout');
Route::post('/thanh-toan', [CartController::class, 'processCheckout'])->name('cart.processCheckout');
Route::post('/dat-hang', [OrderController::class, 'placeOrder'])->name('order.place');
Route::get('/thanh-toan', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/gio-hang', [CartController::class, 'viewCart'])->name('cart.show');

// lich su don hang
Route::post('/dat-hang', [OrderController::class, 'placeOrder'])->name('order.place');
Route::get('/lich-su-don-hang', [OrderController::class, 'orderHistory'])->name('order.history');
Route::put('/admin/orders/{id}/approve', [AdminOrderController::class, 'approve']);
Route::delete('/admin/orders/{id}', [AdminOrderController::class, 'destroy']);
```


## Blade Template ( View )
![image](https://github.com/user-attachments/assets/06eda160-5ad8-4fa5-86aa-7ebf3c7e8be4)


## 🔐 Security Setup
### CSRF
```php
 <form method="POST" action="{{ url('/admin/products') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="product_name" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" name="product_name" id="product_name" required>
            </div>
```
### Kiểm tra đầu vào
```php
$request->validate([
    'address' => 'required|string|max:255',
    'payment_method' => 'required|string',
]);
```
### Chống XSS. Ví dụ : order_history.blade.php
```php
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
```
### SQL Injection. Ví dụ AdminController
```php
 public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
    
            if (auth()->user()->is_admin) {
                return redirect()->route('admin.dashboard');
            }

            Auth::logout();
            return back()->withErrors(['email' => 'Bạn không có quyền vào admin']);
        }

        return back()->withErrors(['email' => 'Thông tin đăng nhập không hợp lệ']);
    }
```
## Middleware phân quyền cho Admin
```php
 public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->is_admin) {
            return $next($request);
        }

        return redirect('/'); // hoặc abort(403);
    }
```
## Một số hình ảnh chức năng chính
### Trang đăng nhập ( xác thực ) 

- **🔒 Đăng nhập :**
![image](https://github.com/user-attachments/assets/bd91d47c-b789-464e-a8f7-b7f0ddb2ab1a)

- **🔒 Đăng ký :**
![image](https://github.com/user-attachments/assets/7201e623-7e9f-4123-ba17-516f4b1dcec1)

- **Trang chủ :**
![image](https://github.com/user-attachments/assets/2dabc28d-8051-47e1-8e69-168e66f6c911)

- **Trang sản phẩm :**
![image](https://github.com/user-attachments/assets/7711a54b-9a80-454d-94b5-c5eb00599608)

- **Trang giỏ hàng :**
![image](https://github.com/user-attachments/assets/c117c9df-aca9-4408-b595-307a68e85207)

- **Trang thanh toán :**
![image](https://github.com/user-attachments/assets/31effac7-f897-4f25-88b9-ff41fcf5208e)

- **Trang dashboard :**
![image](https://github.com/user-attachments/assets/7af36e4a-8835-4d1f-95db-f92c6191a3f4)

- **Trang quản lý sản phẩm ( CRUD product ) :**
![image](https://github.com/user-attachments/assets/80973e6e-2451-4c99-a4d2-9ba280acab0c)

- **Trang quản lý đơn hàng :**
![image](https://github.com/user-attachments/assets/82e353d4-cacf-495c-958f-463c67f74fc1)


- **Link Demo :**  [Youtube link](https://youtu.be/4DpNjZAzmkI?si=ek-PCW7GFHgGrnwC)
- **Link Github :** https://github.com/eniuu127/project_webnangcao.git
- **Link Github pages:**[ https://github.com/eniuu127/project_webnangcao.git](https://eniuu127.github.io/project_webnangcao/)

License & Copy Rights

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
