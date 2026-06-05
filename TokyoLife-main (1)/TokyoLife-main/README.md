# TokyoLife - E-Commerce Fullstack Platform

## Giới thiệu
**TokyoLife** là một hệ thống thương mại điện tử toàn diện được xây dựng nhằm mô phỏng các quy trình vận hành thực tế của một doanh nghiệp bán lẻ trực tuyến. Dự án tập trung vào việc tối ưu hóa trải nghiệm người dùng (UX) và xây dựng hệ thống quản trị dữ liệu tập trung.

Hệ thống được chia làm 3 phân hệ chính:
- **Server:** RESTful API xử lý logic nghiệp vụ và kết nối cơ sở dữ liệu.
- **Admin Dashboard:** Trang quản trị dành cho nhân viên vận hành (Quản lý kho, đơn hàng, thống kê).
- **Client App:** Trang mua sắm dành cho khách hàng với giao diện Single Page Application (SPA).

## Công nghệ sử dụng
### Back-End
- **Runtime:** Node.js (ExpressJS framework).
- **Database:** MongoDB với Mongoose ODM.
- **Security:** JSON Web Token (JWT) cho Authentication & Authorization.
- **Services:** Cloudinary (Quản lý hình ảnh đám mây), Nodemailer (Tự động hóa Email).

### Front-End
- **Framework:** AngularJS.
- **Styling:** Bootstrap 5, CSS3 Animation.
- **Libraries:** JWT-decode, ngRoute, ngCookies.

## Tính năng tiêu biểu
- **Quản lý sản phẩm đa năng:** Hỗ trợ phân loại theo danh mục, thương hiệu và quản lý tồn kho.
- **Hệ thống giỏ hàng & Thanh toán:** Quy trình checkout tối ưu, tích hợp mã giảm giá (Coupon).
- **Quản trị thông minh:** Thống kê doanh thu qua biểu đồ (Chart.js), quản lý phản hồi người dùng và trạng thái đơn hàng.
- **Bảo mật:** Mã hóa mật khẩu người dùng (Bcrypt) và bảo vệ các luồng dữ liệu nhạy cảm bằng Middleware.

## 🛠 Hướng dẫn triển khai
Dự án hỗ trợ triển khai nhanh chóng thông qua Docker.

1. **Khởi tạo Database:**
   ```sh
   docker-compose up -d
2. **Cài đặt & Chạy Server:**
   ```sh
   cd Server
   npm install
   npm run dev
3. **Triển khai Client & Admin:**

Sử dụng các công cụ Static Hosting hoặc plugin Live Server trên VS Code để khởi chạy file index.html trong thư mục User và Admin.

* **Thiết kế hệ thống RESTful API:** Xây dựng hơn 10 routes quản lý thực thể (User, Product, Order, Category, Blog, Coupon...) đảm bảo tính nhất quán của dữ liệu.
* **Tích hợp dịch vụ bên thứ ba:** Triển khai thành công Cloudinary API để tối ưu hóa việc upload và xử lý hình ảnh sản phẩm.
* **Phân quyền hệ thống (RBAC):** Sử dụng JWT kết hợp Middleware để phân quyền chặt chẽ giữa tài khoản khách hàng và quản trị viên.
* **Tối ưu hóa UI/UX:** Xây dựng ứng dụng dạng SPA với AngularJS giúp giảm thiểu thời gian tải lại trang và tăng tốc độ tương tác.
