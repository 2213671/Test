-- Thiết lập Database
CREATE DATABASE IF NOT EXISTS `fahasa` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `fahasa`;

-- Drop Tables (Đảm bảo thứ tự drop để tránh lỗi khóa ngoại)
DROP TABLE IF EXISTS Shipment_Order;
DROP TABLE IF EXISTS Order_Voucher;
DROP TABLE IF EXISTS Order_Product;
DROP TABLE IF EXISTS Cart_Product;
DROP TABLE IF EXISTS Flashsale_Product;
DROP TABLE IF EXISTS Categorizes;
DROP TABLE IF EXISTS Category_Product;
DROP TABLE IF EXISTS Author_of_product;
DROP TABLE IF EXISTS ProductReview;
DROP TABLE IF EXISTS Product_Image;
DROP TABLE IF EXISTS User_phone;
DROP TABLE IF EXISTS User_address;
DROP TABLE IF EXISTS Staff;
DROP TABLE IF EXISTS Customer;
DROP TABLE IF EXISTS Orders;
DROP TABLE IF EXISTS Payment;
DROP TABLE IF EXISTS Cart;
DROP TABLE IF EXISTS Shipment;
DROP TABLE IF EXISTS Product;
DROP TABLE IF EXISTS FlashSale;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS Voucher;
DROP TABLE IF EXISTS Users;


-- 1. Users
CREATE TABLE Users (
    user_id INT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL,
    fname VARCHAR(50) NOT NULL,
    lname VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    note TEXT, -- Đã sửa VARCHAR(MAX) thành TEXT
    created_date DATE
    -- Đã loại bỏ ràng buộc CHECK động (GETDATE/CURDATE) để tránh lỗi cú pháp phiên bản cũ
);

-- 2. Staff
CREATE TABLE Staff (
    user_id INT PRIMARY KEY,
    branch VARCHAR(100),
    hired_date DATE,
    salary DECIMAL(12,2),
    is_admin TINYINT(1) DEFAULT 0, -- Đã sửa BIT thành TINYINT(1)

    CONSTRAINT FK_Staff_User FOREIGN KEY (user_id) REFERENCES Users(user_id),
    CONSTRAINT CHK_Staff_Salary CHECK (salary >= 0) -- Giữ nguyên CHECK, nhưng có thể bị MariaDB cũ bỏ qua
);

-- 3. Customer
CREATE TABLE Customer (
    user_id INT PRIMARY KEY,
    member_type VARCHAR(50), 
    total_fpoint INT DEFAULT 0,
    CONSTRAINT FK_Customer_User FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- 4. User_phone
CREATE TABLE User_phone (
    user_id INT NOT NULL,
    phone VARCHAR(20) NOT NULL,
    PRIMARY KEY (user_id, phone),
    CONSTRAINT FK_UserPhone_User FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- 5. User_address
CREATE TABLE User_address (
    user_id INT NOT NULL,
    address VARCHAR(255) NOT NULL,
    PRIMARY KEY (user_id, address),
    CONSTRAINT FK_UserAddress_User FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- 6. Payment
CREATE TABLE Payment (
    payment_id INT PRIMARY KEY AUTO_INCREMENT, -- Đã sửa IDENTITY(1,1) thành AUTO_INCREMENT
    customer_id INT NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    created_date DATE,
    CONSTRAINT FK_Payment_Customer FOREIGN KEY (customer_id) REFERENCES Customer(user_id)
);

-- 7. Orders
CREATE TABLE Orders (
    order_id INT PRIMARY KEY AUTO_INCREMENT, -- Đã sửa IDENTITY(1,1) thành AUTO_INCREMENT
    payment_id INT,
    shipping_fee DECIMAL(12,2) DEFAULT 0,
    note TEXT, -- Đã sửa VARCHAR(MAX) thành TEXT
    created_date DATE,
    status VARCHAR(50),
    point_earned INT DEFAULT 0,
    point_used INT DEFAULT 0,
    total DECIMAL(12, 2) DEFAULT 0, 

    CONSTRAINT FK_Order_Payment FOREIGN KEY (payment_id) REFERENCES Payment(payment_id),
    CONSTRAINT CHK_Order_Total CHECK (total >= 0)
);

-- 8. Voucher
CREATE TABLE Voucher (
    voucher_code VARCHAR(50) PRIMARY KEY,
    usage_limit INT,
    used_count INT DEFAULT 0,
    start_time DATETIME,
    end_time DATETIME,
    min_order_value DECIMAL(12,2),
    max_sale_value DECIMAL(12,2),
    discount DECIMAL(10, 2) NOT NULL,

    CONSTRAINT CHK_Voucher_Time CHECK (start_time < end_time),
    CONSTRAINT CHK_Voucher_Values CHECK (min_order_value >= 0 AND max_sale_value >= 0 AND discount >= 0)
);

-- 9. Order_Voucher (Bảng quan hệ N:N)
CREATE TABLE Order_Voucher (
    order_id INT, 
    voucher_code VARCHAR(50),
    PRIMARY KEY (order_id, voucher_code),
    CONSTRAINT FK_OV_Order FOREIGN KEY (order_id) REFERENCES Orders(order_id),
    CONSTRAINT FK_OV_Voucher FOREIGN KEY (voucher_code) REFERENCES Voucher(voucher_code)
);

-- 10. Cart
CREATE TABLE Cart (
    cart_id VARCHAR(20) PRIMARY KEY,
    quantity INT,
    customer_id INT NOT NULL,

    CONSTRAINT FK_Cart_Customer FOREIGN KEY (customer_id) REFERENCES Customer(user_id) 
);

-- 11. Product
CREATE TABLE Product (
    product_id INT PRIMARY KEY AUTO_INCREMENT, -- Đã sửa IDENTITY(1,1) thành AUTO_INCREMENT
    title VARCHAR(255) NOT NULL,
    publisher VARCHAR(100),
    supplier VARCHAR(100),
    description TEXT, -- Đã sửa VARCHAR(MAX) thành TEXT
    year INT,
    language VARCHAR(50),
    product_type VARCHAR(50),
    stock_quantity INT NOT NULL,
    price DECIMAL(12,2) NOT NULL,
    weight DECIMAL(10, 2),
    size VARCHAR(255), -- Đã sửa VARCHAR(2) thành VARCHAR(255)

    CONSTRAINT CHK_Product_Price CHECK (price >= 0),
    CONSTRAINT CHK_Product_Stock CHECK (stock_quantity >= 0)
);

-- 12. Author_of_product (Bảng quan hệ N:N)
CREATE TABLE Author_of_product (
    product_id INT NOT NULL,
    author_name VARCHAR(50) NOT NULL,
    PRIMARY KEY (product_id, author_name),

    CONSTRAINT FK_Au_Product FOREIGN KEY (product_id) REFERENCES Product(product_id)
);

-- 13. Order_Product (Bảng quan hệ N:N)
CREATE TABLE Order_Product (
    order_id INT,
    product_id INT,
    quantity INT NOT NULL, 
    PRIMARY KEY (order_id, product_id),

    CONSTRAINT FK_OP_Order FOREIGN KEY (order_id) REFERENCES Orders(order_id),
    CONSTRAINT FK_OP_Product FOREIGN KEY (product_id) REFERENCES Product(product_id),
    CONSTRAINT CHK_OP_Quantity CHECK (quantity > 0)
);

-- 14. Cart_Product (Bảng quan hệ N:N)
CREATE TABLE Cart_Product (
    card_id VARCHAR(20),
    product_id INT,
    PRIMARY KEY (card_id, product_id),

    CONSTRAINT FK_CP_Cart FOREIGN KEY (card_id) REFERENCES Cart(cart_id),
    CONSTRAINT FK_CP_Product FOREIGN KEY (product_id) REFERENCES Product(product_id)
);

-- 15. ProductReview
CREATE TABLE ProductReview (
    review_id INT,
    product_id INT NOT NULL,
    customer_id INT NOT NULL,
    rating INT CHECK (rating BETWEEN 1 AND 5), -- Giữ nguyên CHECK
    review_text TEXT, -- Đã sửa VARCHAR(MAX) thành TEXT
    review_date DATETIME,
    image_url VARCHAR(255), 
    PRIMARY KEY (product_id, review_id),

    CONSTRAINT FK_PR_Product FOREIGN KEY (product_id) REFERENCES Product(product_id),
    CONSTRAINT FK_PR_Customer FOREIGN KEY (customer_id) REFERENCES Customer(user_id)
);

-- 16. Product_Image
CREATE TABLE Product_Image (
    product_id INT NOT NULL,
    image_url VARCHAR(255) NOT NULL, 
    ordinal_number INT,
    upload_date DATETIME,
    PRIMARY KEY (product_id, image_url),

    CONSTRAINT FK_PI_Product FOREIGN KEY (product_id) REFERENCES Product(product_id)
);

-- 17. FlashSale
CREATE TABLE FlashSale (
    sale_id INT PRIMARY KEY,
    start_time DATETIME NOT NULL, -- Đã sửa DATETIME2 thành DATETIME
    end_time DATETIME NOT NULL,   -- Đã sửa DATETIME2 thành DATETIME
    description TEXT,             -- Đã sửa VARCHAR(MAX) thành TEXT

    CONSTRAINT CHK_Flashsale_Time CHECK (start_time < end_time)
);

-- 18. Flashsale_Product (Bảng quan hệ N:N)
CREATE TABLE Flashsale_Product (
    sale_id INT,
    product_id INT,
    discount_value DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL,
    PRIMARY KEY (sale_id, product_id),

    CONSTRAINT FK_FSP_Flashsale FOREIGN KEY (sale_id) REFERENCES FlashSale(sale_id),
    CONSTRAINT FK_FSP_Product FOREIGN KEY (product_id) REFERENCES Product(product_id),
    CONSTRAINT CHK_FSP_Values CHECK (discount_value >= 0 AND quantity >= 0)
);

-- 19. Category
CREATE TABLE Category (
    category_id INT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT -- Đã sửa VARCHAR(MAX) thành TEXT
);

-- 20. Categorizes (Quan hệ phân cấp/cha con trong Category)
CREATE TABLE Categorizes (
    categoryA_id INT NOT NULL,
    categoryB_id INT PRIMARY KEY,

    CONSTRAINT FK_Cg_CategoryA FOREIGN KEY (categoryA_id) REFERENCES Category(category_id),
    CONSTRAINT FK_Cg_CategoryB FOREIGN KEY (categoryB_id) REFERENCES Category(category_id),
    CONSTRAINT CHK_Categorizes_SelfRef CHECK (categoryA_id <> categoryB_id)
);

-- 21. Category_Product (Bảng quan hệ N:N)
CREATE TABLE Category_Product (
    category_id INT NOT NULL,
    product_id INT NOT NULL,
    PRIMARY KEY (category_id, product_id),

    CONSTRAINT FK_CtP_Category FOREIGN KEY (category_id) REFERENCES Category(category_id),
    CONSTRAINT FK_CtP_Product FOREIGN KEY (product_id) REFERENCES Product(product_id)
);

-- 22. Shipment
CREATE TABLE Shipment (
    ship_code VARCHAR(50) PRIMARY KEY, 
    shipping_unit VARCHAR(100) NOT NULL, 
    tracking_num VARCHAR(100), 
    weight DECIMAL(10, 2),
    status VARCHAR(50) NOT NULL, 
    last_update DATETIME, -- Đã sửa DATETIME2 thành DATETIME
    shipping_address VARCHAR(50),
    note TEXT, -- Đã sửa VARCHAR(MAX) thành TEXT
    
    CONSTRAINT CHK_Shipment_Weight CHECK (weight >= 0)
);

-- 23. Shipment_Order
CREATE TABLE Shipment_Order (
    ship_code VARCHAR(50) PRIMARY KEY,
    order_id INT, 

    CONSTRAINT FK_SO_Shipment FOREIGN KEY (ship_code) REFERENCES Shipment(ship_code),
    CONSTRAINT FK_SO_Order FOREIGN KEY (order_id) REFERENCES Orders(order_id)
);

--
-- Dữ liệu (INSERT Statements)
--

-- 1. Users
INSERT INTO Users (user_id, username, password, fname, lname, email, created_date) VALUES
(101, 'khachhang_A', 'pass123', 'Nguyễn Văn', 'A', 'nguyen.a@example.com', '2023-01-15'),
(102, 'khachhang_B', 'pass123', 'Trần Thị', 'B', 'tran.b@example.com', '2023-03-20'),
(103, 'khachhang_C', 'pass123', 'Lê Hoàng', 'C', 'le.c@example.com', '2024-01-10'),
(104, 'khachhang_D', 'pass123', 'Phạm Minh', 'D', 'pham.d@example.com', '2024-05-01'),
(105, 'khachhang_E', 'pass123', 'Võ Thanh', 'E', 'vo.e@example.com', '2024-06-12'),
(106, 'admin', 'admin', 'Đỗ Văn', 'Fahasa', 'do.f@fahasa.com', '2022-10-01'),
(107, 'staff_sales', 'staffpass', 'Hoàng Thị', 'G', 'hoang.g@fahasa.com', '2023-05-15'),
(108, 'staff_warehouse', 'staffpass', 'Bùi Xuân', 'H', 'bui.h@fahasa.com', '2023-08-22'),
(109, 'staff_support', 'staffpass', 'Dương Văn', 'I', 'duong.i@fahasa.com', '2024-02-14'),
(110, 'staff_packing', 'staffpass', 'Mai Thị', 'K', 'mai.k@fahasa.com', '2024-04-10');


-- 2. Staff
INSERT INTO Staff (user_id, branch, hired_date, salary, is_admin) VALUES
(106, 'Chi nhánh Q.1', '2022-10-01', 50000000.00, 1),
(107, 'Chi nhánh Q.1', '2023-05-15', 15000000.00, 0),
(108, 'Kho Thủ Đức', '2023-08-22', 12000000.00, 0),
(109, 'Trụ sở chính', '2024-02-14', 18000000.00, 0),
(110, 'Kho Thủ Đức', '2024-04-10', 11000000.00, 0);

-- 3. Customer
INSERT INTO Customer (user_id, member_type, total_fpoint) VALUES
(101, 'Gold', 1500),
(102, 'Silver', 500),
(103, 'Diamond', 3500),
(104, 'Silver', 200),
(105, 'Gold', 1000);


-- 4. User_phone
INSERT INTO User_phone (user_id, phone) VALUES
(101, '0901234567'), (101, '0909999999'),
(102, '0912345678'),
(106, '0987654321'),
(110, '0977666555');

-- 5. User_address
INSERT INTO User_address (user_id, address) VALUES
(101, '123 Đường Nguyễn Huệ, Quận 1, TP.HCM'),
(102, '45/6 Đường Hậu Giang, Quận 6, TP.HCM'),
(103, 'Tòa nhà A, Đường Phan Văn Trị, Gò Vấp'),
(104, '300 Ký Con, Quận 1, TP.HCM'),
(105, 'Căn hộ B, Đường 3/2, Quận 10, TP.HCM');


-- 6. Payment (ID Tự động tăng: 1, 2, 3, 4, 5)
INSERT INTO Payment (customer_id, payment_method, created_date) VALUES
(101, 'Credit Card', '2024-11-10'),
(102, 'COD', '2024-11-11'),
(103, 'E-Wallet', '2024-11-12'),
(104, 'Credit Card', '2024-11-13'),
(105, 'COD', '2024-11-14');

-- 7. Orders (ID Tự động tăng: 1, 2, 3, 4, 5)
INSERT INTO Orders (payment_id, shipping_fee, created_date, status, point_earned, point_used, total) VALUES
(1, 15000.00, '2024-11-10', 'Completed', 250, 0, 250000.00), 
(2, 0.00, '2024-11-11', 'Paid', 0, 0, 85000.00), 
(3, 20000.00, '2024-11-12', 'Pending', 0, 500, 370000.00),
(4, 0.00, '2024-11-13', 'Cancelled', 0, 0, 100000.00),
(5, 30000.00, '2024-11-14', 'Paid', 500, 0, 500000.00);

-- 8. Voucher
INSERT INTO Voucher (voucher_code, usage_limit, used_count, start_time, end_time, min_order_value, max_sale_value, discount) VALUES
('FREE_SHIP', 500, 10, '2024-10-01 00:00:00', '2025-01-01 23:59:59', 150000.00, 30000.00, 15000.00),
('SALE_10K', 1000, 50, '2024-11-20 00:00:00', '2024-12-31 23:59:59', 100000.00, 10000.00, 10000.00),
('VIP_20', 50, 5, '2024-11-01 00:00:00', '2025-11-01 23:59:59', 500000.00, 50000.00, 20000.00),
('NO_MIN_01', 200, 150, '2024-05-01 00:00:00', '2024-12-31 23:59:59', 0.00, 5000.00, 5000.00),
('TEST_OK', 10, 0, '2025-01-01 00:00:00', '2025-03-01 23:59:59', 200000.00, 25000.00, 10000.00);

-- 9. Order_Voucher
INSERT INTO Order_Voucher (order_id, voucher_code) VALUES
(1, 'FREE_SHIP'),
(5, 'VIP_20');

-- 10. Cart
INSERT INTO Cart (cart_id, quantity, customer_id) VALUES
('C-104', 3, 104),
('C-105', 1, 105);

-- 11. Product (ID Tự động tăng: 1, 2, 3, 4, 5)
INSERT INTO Product (product_id, title, publisher, supplier, year, product_type, stock_quantity, price) VALUES
(1, 'Đắc Nhân Tâm', 'NXB Tổng Hợp TP.HCM', 'First News', 2020, 'softcover', 150, 100000.00),
(2, 'Nhà Giả Kim', 'NXB Văn Học', 'Alpha Books', 2018, 'softcover', 80, 85000.00),
(3, 'Thuyết Tương Đối', 'NXB Khoa Học', 'Mekong Books', 2022, 'hardcover', 20, 250000.00),
(4, 'Sổ Tay Kế Toán', 'NXB Tài Chính', 'Tài Chính Group', 2023, 'softcover', 5, 120000.00),
(5, 'One Piece Vol 100', 'NXB Kim Đồng', 'Kim Đồng', 2024, 'softcover', 300, 25000.00);

-- 12. Author_of_product
INSERT INTO Author_of_product (product_id, author_name) VALUES
(1, 'Dale Carnegie'), (1, 'Nguyễn Hiến Lê'), 
(2, 'Paulo Coelho'),
(3, 'Albert Einstein'),
(4, 'Trần Minh Quang'),
(5, 'Eiichiro Oda');

-- 13. Order_Product
INSERT INTO Order_Product (order_id, product_id, quantity) VALUES
(1, 1, 2), 
(1, 5, 2), 
(2, 2, 1), 
(3, 3, 1), 
(3, 4, 1), 
(4, 1, 1), 
(5, 3, 2); 

-- 14. Cart_Product
INSERT INTO Cart_Product (card_id, product_id) VALUES
('C-104', 1),
('C-104', 2),
('C-104', 4),
('C-105', 5),
('C-105', 3);

-- 15. ProductReview
INSERT INTO ProductReview (review_id, product_id, customer_id, rating, review_text, review_date) VALUES
(1, 1, 101, 5, 'Sách hay, giao hàng nhanh.', '2024-11-12 15:00:00'),
(2, 5, 101, 4, 'Truyện đẹp, đóng gói cẩn thận.', '2024-11-12 16:30:00'),
(1, 2, 102, 5, 'Bản dịch tuyệt vời.', '2024-11-13 10:00:00'),
(1, 3, 103, 5, 'Nội dung khoa học, đóng gói chắc chắn.', '2024-11-14 09:00:00'),
(2, 3, 105, 5, 'Mua tặng sếp, sếp rất thích.', '2024-11-15 08:00:00');

-- 16. Product_Image
INSERT INTO Product_Image (product_id, image_url, ordinal_number, upload_date) VALUES
(1, 'image_url/product1/main.jpg', 1, '2023-01-01 10:00:00'),
(1, 'image_url/product1/back.jpg', 2, '2023-01-01 10:00:00'),
(2, 'image_url/product2/main.jpg', 1, '2023-01-05 10:00:00'),
(3, 'image_url/product3/main.jpg', 1, '2023-02-01 10:00:00'),
(4, 'image_url/product4/main.jpg', 1, '2023-03-01 10:00:00'),
(5, 'image_url/product5/main.jpg', 1, '2023-04-01 10:00:00');

-- 17. FlashSale
INSERT INTO FlashSale (sale_id, start_time, end_time, description) VALUES
(1, '2024-11-20 18:00:00', '2024-11-20 20:00:00', 'Sale Black Friday 2 tiếng'),
(2, '2024-12-12 00:00:00', '2024-12-12 23:59:59', 'Sale 12.12');

-- 18. Flashsale_Product
INSERT INTO Flashsale_Product (sale_id, product_id, discount_value, quantity) VALUES
(1, 1, 10000.00, 50),
(1, 2, 8500.00, 30),
(2, 5, 5000.00, 100),
(2, 4, 12000.00, 10),
(2, 3, 25000.00, 5);

-- 19. Category
INSERT INTO Category (category_id, category_name) VALUES
(1, 'Sách Trong Nước'),
(2, 'Văn Học'),
(3, 'Kinh Tế'),
(4, 'Văn Phòng Phẩm'),
(5, 'Truyện Tranh');


-- 20. Categorizes
INSERT INTO Categorizes (categoryA_id, categoryB_id) VALUES
(1, 2), 
(1, 3); 

-- 21. Category_Product
INSERT INTO Category_Product (category_id, product_id) VALUES
(2, 1), 
(2, 2),
(3, 4), 
(5, 5),
(1, 3);

-- 22. Shipment
INSERT INTO Shipment (ship_code, shipping_unit, status, last_update, shipping_address, weight) VALUES
('S-1001', 'GHN', 'Delivered', '2024-11-12 10:00:00', '123 Đường Nguyễn Huệ, Quận 1', 1.50),
('S-1002', 'GHTK', 'Shipping', '2024-11-12 15:30:00', '45/6 Đường Hậu Giang, Quận 6', 0.80),
('S-1003', 'Viettel Post', 'Received', '2024-11-13 09:00:00', 'Tòa nhà A, Gò Vấp', 2.10),
('S-1004', 'GHN', 'Pending', '2024-11-15 11:00:00', 'Căn hộ B, Quận 10', 3.20),
('S-1005', 'GHTK', 'Shipping', '2024-11-15 16:00:00', 'Tòa nhà A, Gò Vấp', 0.75);


-- 23. Shipment_Order
INSERT INTO Shipment_Order (ship_code, order_id) VALUES
('S-1001', 1), 
('S-1002', 2), 
('S-1003', 3), 
('S-1004', 5);