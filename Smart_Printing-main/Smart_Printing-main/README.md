# Smart Printing Service - Android Application

## 📝 Giới thiệu
Hệ thống hỗ trợ dịch vụ in ấn thông minh dành cho sinh viên và quản trị viên trong môi trường đại học. Ứng dụng giúp tối ưu hóa quy trình đặt lệnh in, quản lý tệp tin và thanh toán trực tuyến.

## 🏗 Kiến trúc & Kỹ thuật (Tech Stack)
Dự án được xây dựng dựa trên các tiêu chuẩn phát triển Android hiện đại:
- **Kiến trúc:** Clean Architecture (Domain, Data, Presentation layers) giúp tách biệt logic nghiệp vụ và dễ dàng bảo trì.
- **UI Framework:** Jetpack Compose (100% Declarative UI).
- **Pattern:** MVVM (Model-View-ViewModel) kết hợp với State Management.
- **Dependency Injection:** Dagger Hilt.
- **Xử lý bất đồng bộ:** Kotlin Coroutines & Flow.

## ✨ Tính năng tiêu biểu
- **Đa vai trò (Role-based):** Phân quyền người dùng giữa Sinh viên (đặt in, mua trang in) và Admin (quản lý máy in, phê duyệt yêu cầu).
- **Quản lý máy in thời gian thực:** Theo dõi trạng thái hoạt động và lịch sử in ấn của từng thiết bị.
- **Quy trình đặt in (Printing Workflow):** Cho phép chọn tệp, cấu hình thông số in (loại giấy, số bản) và chọn máy in khả dụng.
- **Hệ thống thanh toán & Giao dịch:** Quản lý số dư trang in và lịch sử giao dịch của sinh viên.

## 🛠 Cài đặt
1. Clone repository.
2. Mở bằng Android Studio (Ladybug hoặc mới hơn).
3. Build dự án thông qua Gradle.
