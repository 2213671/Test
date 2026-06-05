# Hệ thống quản lý nhà hàng

## 1. Đăng nhập

- **ADMIN_RESTAURANT**: Đăng nhập bằng tài khoản nhà hàng do ADMIN tạo.
- **STAFF**: Đăng nhập bằng tài khoản nhân viên do chủ nhà hàng tạo.

---

## 2. Quản lý bàn (Luồng chính)

### 2.1 Danh sách bàn
- Hiển thị trạng thái bàn:
  - Số tiền, số lượng món, số khách
  - Trạng thái bàn (BLANK, ACTIVE, DISABLE,...)
- Nhấn vào bàn trống:
  - Hiển thị popup chọn số lượng khách
  - Nhấn xác nhận → chuyển sang màn hình gọi món

### 2.2 Màn hình quản lý bàn
- Tạo bàn: nhập tên bàn
- Chỉnh sửa bàn (chưa có)
- Bật/tắt trạng thái bàn (chỉ bàn BLANK mới chuyển thành DISABLE) (chưa có)
- Xoá bàn (chưa có)

---

## 3. Gọi món

### 3.1 Màn hình gọi món
- Hiển thị danh sách menu hoạt động
- Hiển thị món ăn theo menu được chọn
- Chọn món ăn → hiển thị popup món ăn:
  - Tên món ăn
  - Tăng/giảm số lượng món
  - Các option (required sẽ tự động chọn)
  - Các topping, tăng giảm số lượng (tối đa được set)
- Xác nhận → thêm món vào giỏ hàng

### 3.2 Giỏ hàng
- Hiển thị danh sách món đã chọn
- Khi nhận đặt:
  - Nếu bàn trống → tạo order mới
  - Nếu bàn có order → thêm mới vào order

---

## 4. Thanh toán

- Hiển thị các item trong order (giá, số lượng, option, topping)
- Hiển thị tổng tiền, giá khuyến mãi, giá cuối cùng
- Hiển thị số tiền nhận từ khách và tiền thối lại
- Hiển thị các khuyến mãi hiện có trong nhà hàng và khả dụng
- Hiển thị các phương thức thanh toán
- Hiển thị giá gốc và giá sau giảm trên từng item nếu khuyến mãi áp dụng
- Kiểm tra khuyến mãi trên từng item theo menuId
- Thanh toán chỉ khi số tiền nhận ≥ tổng tiền cuối cùng

---

## 5. Quản lý menu

- Tạo menu: tên, mô tả
- Bật/tắt trạng thái menu (chưa có)
- Xoá menu (chưa có)

---

## 6. Quản lý topping

- Tạo topping: tên, số lượng tối đa, giá
- Chỉnh sửa topping (chưa có)
- Xoá topping (chưa có)

---

## 7. Quản lý option

- Tạo option: tên, bắt buộc, giá
- Chỉnh sửa option (chưa có)
- Xoá option (chưa có)

---

## 8. Quản lý sản phẩm

- Tạo sản phẩm: tên, tag, giá, ảnh, menu, option, topping
- Sản phẩm được gắn vào menu đã chọn
- Chỉnh sửa sản phẩm (chưa có)
- Xoá sản phẩm (chưa có)

---

## 9. Quản lý khuyến mãi

- Tạo khuyến mãi:
  - Tên, loại (PERCENT, VALUE)
  - Áp dụng cho (ORDER, ORDER_ITEM)
  - Thời gian khuyến mãi (start, end)
  - Khung giờ khuyến mãi (start, end)
  - Các menu được áp dụng
- Chỉnh sửa khuyến mãi (chưa có)
- Cập nhật trạng thái (chưa có)
- Xoá khuyến mãi (chưa có)

---

## 10. Quản lý phương thức thanh toán

- Tạo phương thức: tên (code decode từ tên)
- Chỉnh sửa phương thức
- Cập nhật trạng thái
- Xoá phương thức

---

## 11. Quản lý nhân viên

- Tạo nhân viên: username, mật khẩu, địa chỉ, số điện thoại, email
- Chỉnh sửa nhân viên (chưa có)
- Cập nhật trạng thái (ACTIVE, INACTIVE) (chưa có)

---

## 12. Quản lý nhà hàng

- Tạo nhà hàng: username, mật khẩu, địa chỉ, số điện thoại, email, ảnh nhà hàng (Chỉ ADMIN)
- Chỉnh sửa thông tin nhà hàng (chưa có)
- Xem số liệu nhà hàng: tổng đơn, tổng item, tổng khách

---

## 13. Shift hiện tại

- Hiển thị thông tin ca hiện tại:
  - Nếu không có ca nào đang mở → ca hiện tại là ca đóng cuối cùng
- Thông tin hiển thị:
  - Tổng tiền, tổng item, tổng khách
  - Số tiền nhận từ khách, số tiền thối lại
  - Số tiền nhận theo từng phương thức thanh toán
- Nút thao tác:
  - **Đóng ca**: chỉ khi ca hiện tại chưa đóng
  - **Mở ca**: chỉ xuất hiện khi chưa có ca nào hoặc ca đã đóng

---

## 14. Màn hình quản lý ca

- Xem danh sách các ca trong ngày
- Thông tin hiển thị giống **Shift hiện tại**
- Có thể lọc theo ngày
- Xem chi tiết ca:
  - Hiển thị các đơn trong ca đó

---

## 15. Màn hình quản lý đơn

- Xem danh sách đơn
- Lọc theo:
  - Ngày
  - Ca
  - Trạng thái đơn
