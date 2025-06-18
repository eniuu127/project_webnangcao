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
Sơ đồ khối
Sơ đồ chức năng
Class Diagram of Objects

Sơ đồ thuật toán
Create Cart (user / car /user-car) Activity Diagram

Edit Cart Activity Diagram

Delete Cart

Activity Diagram

Authentication/Authorisation

Một số Code chính minh họa
Model
Cart

Controller
Phương thức CRUD

View
blade template Cart

Security Setup
Link
Link Demo : Youtube link
Public Web (deployment) link:
Một số hình ảnh chức năng chính
License & Copy Rights

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
