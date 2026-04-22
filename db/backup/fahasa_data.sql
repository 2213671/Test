-- 1 -- USERS
INSERT INTO Users (user_id, username, password, fname, lname, email, created_date) VALUES
(101, 'khachhang_A', 'pass123', 'Nguyễn Văn', 'A', 'nguyen.a@example.com', '2023-01-15'),
(102, 'khachhang_B', 'pass123', 'Trần Thị', 'B', 'tran.b@example.com', '2023-03-20'),
(103, 'khachhang_C', 'pass123', 'Lê Hoàng', 'C', 'le.c@example.com', '2024-01-10'),
(104, 'khachhang_D', 'pass123', 'Phạm Minh', 'D', 'pham.d@example.com', '2024-05-01'),
(105, 'khachhang_E', 'pass123', 'Võ Thanh', 'E', 'vo.e@example.com', '2024-06-12'),
(106, 'staff_manager', 'adminpass', 'Đỗ Văn', 'F', 'do.f@fahasa.com', '2022-10-01'), -- Admin
(107, 'staff_sales', 'staffpass', 'Hoàng Thị', 'G', 'hoang.g@fahasa.com', '2023-05-15'),
(108, 'staff_warehouse', 'staffpass', 'Bùi Xuân', 'H', 'bui.h@fahasa.com', '2023-08-22'),
(109, 'staff_support', 'staffpass', 'Dương Văn', 'I', 'duong.i@fahasa.com', '2024-02-14'),
(110, 'staff_packing', 'staffpass', 'Mai Thị', 'K', 'mai.k@fahasa.com', '2024-04-10');


-- 2 -- STAFF 
INSERT INTO Staff (user_id, branch, hired_date, salary, is_admin) VALUES
(106, 'Chi nhánh Q.1', '2022-10-01', 50000000.00, 1), -- Quản trị viên (Admin)
(107, 'Chi nhánh Q.1', '2023-05-15', 15000000.00, 0),
(108, 'Kho Thủ Đức', '2023-08-22', 12000000.00, 0),
(109, 'Trụ sở chính', '2024-02-14', 18000000.00, 0),
(110, 'Kho Thủ Đức', '2024-04-10', 11000000.00, 0);

-- 3 -- CUSTOMER
INSERT INTO Customer (user_id, member_type, total_fpoint) VALUES
(101, 'Gold', 1500),
(102, 'Silver', 500),
(103, 'Diamond', 3500),
(104, 'Silver', 200),
(105, 'Gold', 1000);


-- 4 -- USER_PHONE
INSERT INTO User_phone (user_id, phone) VALUES
(101, '0901234567'), (101, '0909999999'),
(102, '0912345678'),
(106, '0987654321'),
(110, '0977666555');

-- 5 -- USER_ADDRESS
INSERT INTO User_address (user_id, address) VALUES
(101, '123 Đường Nguyễn Huệ, Quận 1, TP.HCM'),
(102, '45/6 Đường Hậu Giang, Quận 6, TP.HCM'),
(103, 'Tòa nhà A, Đường Phan Văn Trị, Gò Vấp'),
(104, '300 Ký Con, Quận 1, TP.HCM'),
(105, 'Căn hộ B, Đường 3/2, Quận 10, TP.HCM');


-- 6 -- PAYMENT
INSERT INTO Payment (customer_id, payment_method, created_date) VALUES
(101, 'Credit Card', '2024-11-10'),
(102, 'COD', '2024-11-11'),
(103, 'E-Wallet', '2024-11-12'),
(104, 'Credit Card', '2024-11-13'),
(105, 'COD', '2024-11-14');

-- 7 -- ORDERS 
INSERT INTO Orders (payment_id, shipping_fee, created_date, status, point_earned, point_used, total) VALUES
(1, 15000.00, '2024-11-10', 'Completed', 250, 0, 250000.00), 
(2, 0.00, '2024-11-11', 'Paid', 0, 0, 85000.00), 
(3, 20000.00, '2024-11-12', 'Pending', 0, 500, 370000.00),
(4, 0.00, '2024-11-13', 'Cancelled', 0, 0, 100000.00),
(5, 30000.00, '2024-11-14', 'Paid', 500, 0, 500000.00);

-- 8 -- VOUCHER
-- start_time < end_time, min_order_value >= 0
INSERT INTO Voucher (voucher_code, usage_limit, used_count, start_time, end_time, min_order_value, max_sale_value, discount) VALUES
('FREE_SHIP', 500, 10, '2024-10-01 00:00:00', '2025-01-01 23:59:59', 150000.00, 30000.00, 15000.00),
('SALE_10K', 1000, 50, '2024-11-20 00:00:00', '2024-12-31 23:59:59', 100000.00, 10000.00, 10000.00),
('VIP_20', 50, 5, '2024-11-01 00:00:00', '2025-11-01 23:59:59', 500000.00, 50000.00, 20000.00),
('NO_MIN_01', 200, 150, '2024-05-01 00:00:00', '2024-12-31 23:59:59', 0.00, 5000.00, 5000.00),
('TEST_OK', 10, 0, '2025-01-01 00:00:00', '2025-03-01 23:59:59', 200000.00, 25000.00, 10000.00);

-- 9 -- ORDER_VOUCHER
INSERT INTO Order_Voucher (order_id, voucher_code) VALUES
(1, 'FREE_SHIP'),
(5, 'VIP_20');

-- 10 -- CART
INSERT INTO Cart (cart_id, quantity, customer_id) VALUES
('C-104', 3, 104),
('C-105', 1, 105);

-- 11 -- PRODUCT     
INSERT INTO Product (product_id, title, publisher, supplier, year, product_type, stock_quantity, price) VALUES
(1, 'Đắc Nhân Tâm', 'NXB Tổng Hợp TP.HCM', 'First News', 2020, 'softcover', 150, 100000.00),
(2, 'Nhà Giả Kim', 'NXB Văn Học', 'Alpha Books', 2018, 'softcover', 80, 85000.00),
(3, 'Thuyết Tương Đối', 'NXB Khoa Học', 'Mekong Books', 2022, 'hardcover', 20, 250000.00),
(4, 'Sổ Tay Kế Toán', 'NXB Tài Chính', 'Tài Chính Group', 2023, 'softcover', 5, 120000.00),
(5, 'One Piece Vol 100', 'NXB Kim Đồng', 'Kim Đồng', 2024, 'softcover', 300, 25000.00);

-- 12 -- AUTHOR_OF_PRODUCT
INSERT INTO Author_of_product (product_id, author_name) VALUES
(1, 'Dale Carnegie'), (1, 'Nguyễn Hiến Lê'), 
(2, 'Paulo Coelho'),
(3, 'Albert Einstein'),
(4, 'Trần Minh Quang'),
(5, 'Eiichiro Oda');

-- 13 -- ORDER_PRODUCT
INSERT INTO Order_Product (order_id, product_id, quantity) VALUES
(1, 1, 2), 
(1, 5, 2), 
(2, 2, 1), 
(3, 3, 1), 
(3, 4, 1), 
(4, 1, 1), 
(5, 3, 2); 

-- 14. CART_PRODUCT
INSERT INTO Cart_Product (cart_id, product_id) VALUES
('C-104', 1),
('C-104', 2),
('C-104', 4),
('C-105', 5),
('C-105', 3);

-- 15. PRODUCT_REVIEW 
-- Chỉ được đánh giá khi Order.status = 'Completed'
INSERT INTO ProductReview (review_id, product_id, customer_id, rating, review_text, review_date) VALUES
(1, 1, 101, 5, 'Sách hay, giao hàng nhanh.', '2024-11-12 15:00:00'),
(2, 5, 101, 4, 'Truyện đẹp, đóng gói cẩn thận.', '2024-11-12 16:30:00'),
(1, 2, 102, 5, 'Bản dịch tuyệt vời.', '2024-11-13 10:00:00'),
(1, 3, 103, 5, 'Nội dung khoa học, đóng gói chắc chắn.', '2024-11-14 09:00:00'),
(2, 3, 105, 5, 'Mua tặng sếp, sếp rất thích.', '2024-11-15 08:00:00');

-- 16 -- PRODUCT_IMAGE 
INSERT INTO Product_Image (product_id, image_url, ordinal_number, upload_date) VALUES
(1, 'image_url/product1/main.jpg', 1, '2023-01-01 10:00:00'),
(1, 'image_url/product1/back.jpg', 2, '2023-01-01 10:00:00'),
(2, 'image_url/product2/main.jpg', 1, '2023-01-05 10:00:00'),
(3, 'image_url/product3/main.jpg', 1, '2023-02-01 10:00:00'),
(4, 'image_url/product4/main.jpg', 1, '2023-03-01 10:00:00'),
(5, 'image_url/product5/main.jpg', 1, '2023-04-01 10:00:00');

-- 17 -- FLASH SALE 
INSERT INTO FlashSale (sale_id, start_time, end_time, description) VALUES
(1, '2024-11-20 18:00:00', '2024-11-20 20:00:00', 'Sale Black Friday 2 tiếng'),
(2, '2024-12-12 00:00:00', '2024-12-12 23:59:59', 'Sale 12.12');

-- 18 -- FLASH SALE PRODUCT
INSERT INTO Flashsale_Product (sale_id, product_id, discount_value, quantity) VALUES
(1, 1, 10000.00, 50),
(1, 2, 8500.00, 30),
(2, 5, 5000.00, 100),
(2, 4, 12000.00, 10),
(2, 3, 25000.00, 5);

-- 19 -- CATEGORY
INSERT INTO Category (category_id, category_name) VALUES
(1, 'Sách Trong Nước'),
(2, 'Văn Học'),
(3, 'Kinh Tế'),
(4, 'Văn Phòng Phẩm'),
(5, 'Truyện Tranh');


-- 20 -- CATEGORIZES 
INSERT INTO Categorizes (categoryA_id, categoryB_id) VALUES
(1, 2), 
(1, 3); 

-- 21 -- CATEGORY_PRODUCT
INSERT INTO Category_Product (category_id, product_id) VALUES
(2, 1), 
(2, 2),
(3, 4), 
(5, 5),
(1, 3);

-- 22 -- SHIPMENT 
INSERT INTO Shipment (ship_code, shipping_unit, status, last_update, shipping_address, weight) VALUES
('S-1001', 'GHN', 'Delivered', '2024-11-12 10:00:00', '123 Đường Nguyễn Huệ, Quận 1', 1.50),
('S-1002', 'GHTK', 'Shipping', '2024-11-12 15:30:00', '45/6 Đường Hậu Giang, Quận 6', 0.80),
('S-1003', 'Viettel Post', 'Received', '2024-11-13 09:00:00', 'Tòa nhà A, Gò Vấp', 2.10),
('S-1004', 'GHN', 'Pending', '2024-11-15 11:00:00', 'Căn hộ B, Quận 10', 3.20),
('S-1005', 'GHTK', 'Shipping', '2024-11-15 16:00:00', 'Tòa nhà A, Gò Vấp', 0.75);


-- 23 -- SHIPMENT_ORDER 
INSERT INTO Shipment_Order (ship_code, order_id) VALUES
('S-1001', 1), 
('S-1002', 2), 
('S-1003', 3), 
('S-1004', 5), 


















  

















