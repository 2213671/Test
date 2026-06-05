# 🍽️ Restaurant Management API

Hệ thống API phục vụ quản lý nhà hàng: user, nhà hàng, menu, sản phẩm, order, shift, promotion,…

---

##  Chức năng chính

# 1.  Authentication (Auth)

- Đăng nhập ✅
- Đăng xuất (Bỏ)
- Lấy user hiện tại ✅
- Refresh token ✅

---

# 2.  User (Bỏ)

- Tạo nhân viên
- Chỉnh sửa nhân viên
- Xoá nhân viên (logic)
- Lấy nhân viên theo nhà hàng (có phân trang)
- Lấy nhân viên theo id

---

# 3.  Restaurant

- Tạo nhà hàng (kèm tạo user chủ nhà hàng) ✅
- Tạo nhân viên nhà hàng ✅
- Chỉnh sửa nhà hàng
- Lấy thông tin nhà hàng theo id 
- Lấy tất cả nhà hàng (không phân trang – chỉ id và name)✅
- Lấy tất cả nhà hàng (có phân trang)

---

# 4.  Table

- Tạo table trong nhà hàng ✅
- Chỉnh sửa table
- Cập nhật vị trí table (layout)
- Xoá table (vật lý)
- Lấy table theo nhà hàng ✅
- Lấy table theo id

---

# 5.  Menu

- Tạo menu ✅
- Chỉnh sửa menu
- Xoá menu (vật lý)
- Lấy menu theo nhà hàng ✅
- Lấy menu theo id ✅

---

# 6.  Product

- Tạo product ✅
- Chỉnh sửa product
- Xoá product (logic)
- Lấy product theo nhà hàng (phân trang)
- Lấy product theo menu (phân trang)
- Lấy product theo id

---

# 7.  Option

- Tạo option ✅
- Chỉnh sửa option
- Xoá option (vật lý)
- Lấy option theo nhà hàng ✅
- Lấy option theo id

---

# 8.  Topping

- Tạo topping
- Chỉnh sửa topping
- Xoá topping (vật lý)
- Lấy topping theo nhà hàng ✅
- Lấy topping theo id

---

# 9.  Order

- Tạo order (nhiều orderItem: mỗi item gồm product, option và topping) ✅ (Tạo được nhưng đang xem lại)
- Chỉnh sửa order (cập nhật nhiều orderItem)
- Thêm orderItem
- Xoá orderItem
- Áp dụng khuyến mãi lên order
- Thanh toán order
- Lấy order theo id
- Lấy order lookup (phân trang) theo:
    - khoảng thời gian
    - trạng thái
    - nhà hàng
    - shift

---

# 10.  Promotion

- Tạo promotion
- Chỉnh sửa promotion
- Xoá promotion (vật lý)
- Lấy promotion theo nhà hàng (phân trang)
- Lấy promotion theo id

---

# 11.  Payment Method

- Tạo paymentMethod
- Chỉnh sửa paymentMethod
- Xoá paymentMethod (vật lý)
- Lấy paymentMethod theo nhà hàng (phân trang)
- Lấy paymentMethod theo id

---

# 12.  Shift

- Mở shift
- Đóng shift
- Lấy shift lookup theo:
    - khoảng thời gian
    - nhà hàng  
      (có phân trang)

---

##  Tổng quan module

| Module         | Mô tả |
|----------------|-------|
| Auth           | Xác thực & phân quyền |
| User           | Quản lý nhân viên & chủ nhà hàng |
| Restaurant     | Quản lý nhà hàng |
| Table          | Bố trí bàn |
| Menu           | Nhóm món ăn |
| Product        | Món ăn / đồ uống |
| Option         | Tuỳ chọn món |
| Topping        | Topping |
| Order          | Gọi món, xử lý đơn |
| Promotion      | Khuyến mãi |
| PaymentMethod  | Phương thức thanh toán |
| Shift          | Ca làm việc |

---

##  Ghi chú

- Một số entity sử dụng **xoá logic** (soft delete) để giữ lịch sử.
- Các API có phân trang sử dụng chuẩn:  
  `page`, `size`, `sort`.
- Các request/response chuẩn hoá theo cấu trúc chung.
