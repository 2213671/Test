# Restaurant POS & Management System

## 📝 Giới thiệu
Hệ thống quản lý điểm bán hàng (POS) toàn diện cho nhà hàng, hỗ trợ quản lý đa chi nhánh, điều phối ca làm việc và tối ưu hóa quy trình gọi món - thanh toán. Dự án chú trọng vào việc xây dựng một hệ thống cơ sở dữ liệu chặt chẽ và hiệu năng cao.

## 🏗 Kiến trúc kỹ thuật (Tech Stack)
- **Back-end:** Java Spring Boot, Spring Security (JWT), Hibernate/JPA.
- **Front-end:** React (TypeScript), Vite, Tailwind CSS, Ant Design.
- **Database:** MySQL (Sử dụng chuyên sâu Trigger, Store Procedure, Function).
- **API Documentation:** Swagger/OpenAPI.

## ✨ Điểm nhấn kỹ thuật (Key Technical Highlights)
- **Database Logic:** Triển khai các ràng buộc nghiệp vụ phức tạp trực tiếp dưới tầng DB thông qua Trigger (ví dụ: tự động log lịch sử thay đổi, kiểm tra trạng thái bàn).
- **Phân quyền (RBAC):** Hệ thống phân quyền chặt chẽ (Admin, Manager, Staff) sử dụng Spring Security và JWT.
- **Quản lý ca làm việc (Shift Management):** Logic đóng/mở ca làm việc, tính toán doanh thu thực tế và chênh lệch tiền mặt tại quầy.
- **Hệ thống khuyến mãi linh hoạt:** Xử lý logic áp dụng nhiều loại khuyến mãi (giảm giá phần trăm, giảm giá tiền mặt) cho từng món hoặc cả hóa đơn.

## 🛠 Hướng dẫn cài đặt
1. **Database:** Chạy các file SQL trong thư mục `src/main/resources/sql` theo thứ tự: Table -> Function -> Procedure -> Trigger -> Data.
2. **Back-end:** Cấu hình thông tin DB trong `application.yaml` và chạy dự án bằng Gradle.
3. **Front-end:** Chạy `npm install` và `npm run dev` trong thư mục `pos-hcsdl-web`.
