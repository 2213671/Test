-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 02, 2025 at 10:03 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fahasa`
--

-- --------------------------------------------------------

--
-- Table structure for table `author_of_product`
--

CREATE TABLE `author_of_product` (
  `product_id` int(11) NOT NULL,
  `author_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `author_of_product`
--

INSERT INTO `author_of_product` (`product_id`, `author_name`) VALUES
(1, 'Dale Carnegie'),
(1, 'Nguyễn Hiến Lê'),
(2, 'Paulo Coelho'),
(3, 'Albert Einstein'),
(4, 'Trần Minh Quang'),
(5, 'Eiichiro Oda');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` varchar(20) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `quantity`, `customer_id`) VALUES
('C-104', 3, 104),
('C-105', 1, 105);

-- --------------------------------------------------------

--
-- Table structure for table `cart_product`
--

CREATE TABLE `cart_product` (
  `card_id` varchar(20) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart_product`
--

INSERT INTO `cart_product` (`card_id`, `product_id`) VALUES
('C-104', 1),
('C-104', 2),
('C-104', 4),
('C-105', 3),
('C-105', 5);

-- --------------------------------------------------------

--
-- Table structure for table `categorizes`
--

CREATE TABLE `categorizes` (
  `categoryA_id` int(11) NOT NULL,
  `categoryB_id` int(11) NOT NULL
) ;

--
-- Dumping data for table `categorizes`
--

INSERT INTO `categorizes` (`categoryA_id`, `categoryB_id`) VALUES
(1, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `description`) VALUES
(1, 'Sách Trong Nước', NULL),
(2, 'Văn Học', NULL),
(3, 'Kinh Tế', NULL),
(4, 'Văn Phòng Phẩm', NULL),
(5, 'Truyện Tranh', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`category_id`, `product_id`) VALUES
(1, 3),
(2, 1),
(2, 2),
(3, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `status` varchar(20) DEFAULT 'New',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `status`, `created_at`) VALUES
(1, 'Nguyễn Văn A', 'a@example.com', 'Về vấn đề giao hàng', 'Sản phẩm giao đến bị trễ 2 ngày so với dự kiến.', 'New', '2025-12-02 15:52:40'),
(2, 'Trần Thị B', 'b@example.com', 'Hỏi về sách mới', 'Tôi có thể tìm sách X ở đâu?', 'New', '2025-12-02 15:52:40');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `user_id` int(11) NOT NULL,
  `member_type` varchar(50) DEFAULT NULL,
  `total_fpoint` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`user_id`, `member_type`, `total_fpoint`) VALUES
(101, 'Gold', 1500),
(102, 'Silver', 500),
(103, 'Diamond', 3500),
(104, 'Silver', 200),
(105, 'Gold', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `flashsale`
--

CREATE TABLE `flashsale` (
  `sale_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `description` text DEFAULT NULL
) ;

--
-- Dumping data for table `flashsale`
--

INSERT INTO `flashsale` (`sale_id`, `start_time`, `end_time`, `description`) VALUES
(1, '2024-11-20 18:00:00', '2024-11-20 20:00:00', 'Sale Black Friday 2 tiếng'),
(2, '2024-12-12 00:00:00', '2024-12-12 23:59:59', 'Sale 12.12');

-- --------------------------------------------------------

--
-- Table structure for table `flashsale_product`
--

CREATE TABLE `flashsale_product` (
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `discount_value` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ;

--
-- Dumping data for table `flashsale_product`
--

INSERT INTO `flashsale_product` (`sale_id`, `product_id`, `discount_value`, `quantity`) VALUES
(1, 1, 10000.00, 50),
(1, 2, 8500.00, 30),
(2, 3, 25000.00, 5),
(2, 4, 12000.00, 10),
(2, 5, 5000.00, 100);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `shipping_fee` decimal(12,2) DEFAULT 0.00,
  `note` text DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `point_earned` int(11) DEFAULT 0,
  `point_used` int(11) DEFAULT 0,
  `total` decimal(12,2) DEFAULT 0.00
) ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `payment_id`, `shipping_fee`, `note`, `created_date`, `status`, `point_earned`, `point_used`, `total`) VALUES
(1, 1, 15000.00, NULL, '2024-11-10', 'Completed', 250, 0, 250000.00),
(2, 2, 0.00, NULL, '2024-11-11', 'Paid', 0, 0, 85000.00),
(3, 3, 20000.00, NULL, '2024-11-12', 'Pending', 0, 500, 370000.00),
(4, 4, 0.00, NULL, '2024-11-13', 'Cancelled', 0, 0, 100000.00),
(5, 5, 30000.00, NULL, '2024-11-14', 'Paid', 500, 0, 500000.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`order_id`, `product_id`, `quantity`) VALUES
(1, 1, 2),
(1, 5, 2),
(2, 2, 1),
(3, 3, 1),
(3, 4, 1),
(4, 1, 1),
(5, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_voucher`
--

CREATE TABLE `order_voucher` (
  `order_id` int(11) NOT NULL,
  `voucher_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_voucher`
--

INSERT INTO `order_voucher` (`order_id`, `voucher_code`) VALUES
(1, 'FREE_SHIP'),
(5, 'VIP_20');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `page_name` varchar(50) NOT NULL,
  `content` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_name`, `content`, `created_at`, `updated_at`) VALUES
(1, 'about', 'Đây là nội dung trang giới thiệu về cửa hàng sách Fahasa.', '2025-12-02 15:53:28', '2025-12-02 15:53:28'),
(2, 'terms', 'Các điều khoản sử dụng của website.', '2025-12-02 15:53:28', '2025-12-02 15:53:28');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `created_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `customer_id`, `payment_method`, `created_date`) VALUES
(1, 101, 'Credit Card', '2024-11-10'),
(2, 102, 'COD', '2024-11-11'),
(3, 103, 'E-Wallet', '2024-11-12'),
(4, 104, 'Credit Card', '2024-11-13'),
(5, 105, 'COD', '2024-11-14');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `publisher` varchar(100) DEFAULT NULL,
  `supplier` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `product_type` varchar(50) DEFAULT NULL,
  `stock_quantity` int(11) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `weight` decimal(10,2) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL
) ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `title`, `publisher`, `supplier`, `description`, `year`, `language`, `product_type`, `stock_quantity`, `price`, `weight`, `size`) VALUES
(1, 'Đắc Nhân Tâm', 'NXB Tổng Hợp TP.HCM', 'First News', NULL, 2020, NULL, 'softcover', 150, 100000.00, NULL, NULL),
(2, 'Nhà Giả Kim', 'NXB Văn Học', 'Alpha Books', NULL, 2018, NULL, 'softcover', 80, 85000.00, NULL, NULL),
(3, 'Thuyết Tương Đối', 'NXB Khoa Học', 'Mekong Books', NULL, 2022, NULL, 'hardcover', 20, 250000.00, NULL, NULL),
(4, 'Sổ Tay Kế Toán', 'NXB Tài Chính', 'Tài Chính Group', NULL, 2023, NULL, 'softcover', 5, 120000.00, NULL, NULL),
(5, 'One Piece Vol 100', 'NXB Kim Đồng', 'Kim Đồng', NULL, 2024, NULL, 'softcover', 300, 25000.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `productreview`
--

CREATE TABLE `productreview` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `review_text` text DEFAULT NULL,
  `review_date` datetime DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `productreview`
--

INSERT INTO `productreview` (`review_id`, `product_id`, `customer_id`, `rating`, `review_text`, `review_date`, `image_url`) VALUES
(1, 1, 101, 5, 'Sách hay, giao hàng nhanh.', '2024-11-12 15:00:00', NULL),
(1, 2, 102, 5, 'Bản dịch tuyệt vời.', '2024-11-13 10:00:00', NULL),
(1, 3, 103, 5, 'Nội dung khoa học, đóng gói chắc chắn.', '2024-11-14 09:00:00', NULL),
(2, 3, 105, 5, 'Mua tặng sếp, sếp rất thích.', '2024-11-15 08:00:00', NULL),
(2, 5, 101, 4, 'Truyện đẹp, đóng gói cẩn thận.', '2024-11-12 16:30:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `product_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `ordinal_number` int(11) DEFAULT NULL,
  `upload_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`product_id`, `image_url`, `ordinal_number`, `upload_date`) VALUES
(1, 'image_url/product1/back.jpg', 2, '2023-01-01 10:00:00'),
(1, 'image_url/product1/main.jpg', 1, '2023-01-01 10:00:00'),
(2, 'image_url/product2/main.jpg', 1, '2023-01-05 10:00:00'),
(3, 'image_url/product3/main.jpg', 1, '2023-02-01 10:00:00'),
(4, 'image_url/product4/main.jpg', 1, '2023-03-01 10:00:00'),
(5, 'image_url/product5/main.jpg', 1, '2023-04-01 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `qa`
--

CREATE TABLE `qa` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `qa`
--

INSERT INTO `qa` (`id`, `question`, `answer`, `category`, `created_at`) VALUES
(1, 'Fahasa hỗ trợ những phương thức thanh toán nào?', 'Chúng tôi chấp nhận thanh toán bằng Thẻ tín dụng, E-Wallet và COD (thanh toán khi nhận hàng).', 'Thanh toán', '2025-12-02 15:50:37'),
(2, 'Làm thế nào để đổi trả sản phẩm?', 'Vui lòng liên hệ bộ phận hỗ trợ trong vòng 7 ngày kể từ ngày nhận hàng để được hướng dẫn chi tiết.', 'Đổi trả', '2025-12-02 15:50:37');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `key_name` varchar(100) NOT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key_name`, `value`) VALUES
(1, 'phone', '0901234567'),
(2, 'email', 'contact@fahasa.com'),
(3, 'address', '123 Nguyen Hue St, Dist 1, HCMC');

-- --------------------------------------------------------

--
-- Table structure for table `shipment`
--

CREATE TABLE `shipment` (
  `ship_code` varchar(50) NOT NULL,
  `shipping_unit` varchar(100) NOT NULL,
  `tracking_num` varchar(100) DEFAULT NULL,
  `weight` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `last_update` datetime DEFAULT NULL,
  `shipping_address` varchar(50) DEFAULT NULL,
  `note` text DEFAULT NULL
) ;

--
-- Dumping data for table `shipment`
--

INSERT INTO `shipment` (`ship_code`, `shipping_unit`, `tracking_num`, `weight`, `status`, `last_update`, `shipping_address`, `note`) VALUES
('S-1001', 'GHN', NULL, 1.50, 'Delivered', '2024-11-12 10:00:00', '123 Đường Nguyễn Huệ, Quận 1', NULL),
('S-1002', 'GHTK', NULL, 0.80, 'Shipping', '2024-11-12 15:30:00', '45/6 Đường Hậu Giang, Quận 6', NULL),
('S-1003', 'Viettel Post', NULL, 2.10, 'Received', '2024-11-13 09:00:00', 'Tòa nhà A, Gò Vấp', NULL),
('S-1004', 'GHN', NULL, 3.20, 'Pending', '2024-11-15 11:00:00', 'Căn hộ B, Quận 10', NULL),
('S-1005', 'GHTK', NULL, 0.75, 'Shipping', '2024-11-15 16:00:00', 'Tòa nhà A, Gò Vấp', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shipment_order`
--

CREATE TABLE `shipment_order` (
  `ship_code` varchar(50) NOT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shipment_order`
--

INSERT INTO `shipment_order` (`ship_code`, `order_id`) VALUES
('S-1001', 1),
('S-1002', 2),
('S-1003', 3),
('S-1004', 5);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `user_id` int(11) NOT NULL,
  `branch` varchar(100) DEFAULT NULL,
  `hired_date` date DEFAULT NULL,
  `salary` decimal(12,2) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT 0
) ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`user_id`, `branch`, `hired_date`, `salary`, `is_admin`) VALUES
(106, 'Chi nhánh Q.1', '2022-10-01', 50000000.00, 1),
(107, 'Chi nhánh Q.1', '2023-05-15', 15000000.00, 0),
(108, 'Kho Thủ Đức', '2023-08-22', 12000000.00, 0),
(109, 'Trụ sở chính', '2024-02-14', 18000000.00, 0),
(110, 'Kho Thủ Đức', '2024-04-10', 11000000.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'Customer',
  `note` text DEFAULT NULL,
  `created_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `fullname`, `email`, `phone`, `role`, `note`, `created_date`) VALUES
(101, 'khachhang_A', '$2y$10$6t7Iv2l13qnBSZvd2efpSOyAqUZZ6zHuR/mUaJWRgyljDNbjbhfby', 'Nguyễn Văn A', 'nguyen.a@example.com', NULL, 'Customer', NULL, '2023-01-15'),
(102, 'khachhang_B', '$2y$10$mtHmt7DlmK4CxYr5ineCROaP6K2tqDttJm325JrtzY9Os0KdpGwMy', 'Trần Thị B', 'tran.b@example.com', NULL, 'Customer', NULL, '2023-03-20'),
(103, 'khachhang_C', '$2y$10$6t7Iv2l13qnBSZvd2efpSOyAqUZZ6zHuR/mUaJWRgyljDNbjbhfby', 'Lê Hoàng C', 'le.c@example.com', NULL, 'Customer', NULL, '2024-01-10'),
(104, 'khachhang_D', '$2y$10$mtHmt7DlmK4CxYr5ineCROaP6K2tqDttJm325JrtzY9Os0KdpGwMy', 'Phạm Minh D', 'pham.d@example.com', NULL, 'Customer', NULL, '2024-05-01'),
(105, 'khachhang_E', '$2y$10$6t7Iv2l13qnBSZvd2efpSOyAqUZZ6zHuR/mUaJWRgyljDNbjbhfby', 'Võ Thanh E', 'vo.e@example.com', NULL, 'Customer', NULL, '2024-06-12'),
(106, 'admin', '$2y$10$GrIswAeI.aLpfkqQ.x6C.ulNRqbN7knlCDtJV7yCZNToORt8.DoHe', 'Admin', 'admin@fahasa.com', NULL, 'admin', NULL, '2022-10-01'),
(107, 'staff_sales', '$2y$10$8I0BJABP4rEETVQ8GWLGYuRMWxkb6UEGhWBtFryh7y/xA9ZCfso3.', 'Hoàng Thị G', 'hoang.g@fahasa.com', NULL, 'staff', NULL, '2023-05-15'),
(108, 'staff_warehouse', '$2y$10$8I0BJABP4rEETVQ8GWLGYuRMWxkb6UEGhWBtFryh7y/xA9ZCfso3.', 'Bùi Xuân H', 'bui.h@fahasa.com', NULL, 'staff', NULL, '2023-08-22'),
(109, 'staff_support', '$2y$10$8I0BJABP4rEETVQ8GWLGYuRMWxkb6UEGhWBtFryh7y/xA9ZCfso3.', 'Dương Văn I', 'duong.i@fahasa.com', NULL, 'staff', NULL, '2024-02-14'),
(110, 'staff_packing', '$2y$10$8I0BJABP4rEETVQ8GWLGYuRMWxkb6UEGhWBtFryh7y/xA9ZCfso3.', 'Mai Thị K', 'mai.k@fahasa.com', NULL, 'staff', NULL, '2024-04-10'),
(111, '', '$2y$10$QqRyMiw8F3ylGvmhFj/8L.8Z1d8FG.GSupZtFEbJoOY6.8ZKbufsK', 'Hà Bình', 'binh.hathe2023@hcmut.edu.vn', NULL, 'Customer', NULL, '2025-12-02');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `user_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`user_id`, `address`) VALUES
(101, '123 Đường Nguyễn Huệ, Quận 1, TP.HCM'),
(102, '45/6 Đường Hậu Giang, Quận 6, TP.HCM'),
(103, 'Tòa nhà A, Đường Phan Văn Trị, Gò Vấp'),
(104, '300 Ký Con, Quận 1, TP.HCM'),
(105, 'Căn hộ B, Đường 3/2, Quận 10, TP.HCM');

-- --------------------------------------------------------

--
-- Table structure for table `user_phone`
--

CREATE TABLE `user_phone` (
  `user_id` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_phone`
--

INSERT INTO `user_phone` (`user_id`, `phone`) VALUES
(101, '0901234567'),
(101, '0909999999'),
(102, '0912345678'),
(106, '0987654321'),
(110, '0977666555');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `voucher_code` varchar(50) NOT NULL,
  `usage_limit` int(11) DEFAULT NULL,
  `used_count` int(11) DEFAULT 0,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `min_order_value` decimal(12,2) DEFAULT NULL,
  `max_sale_value` decimal(12,2) DEFAULT NULL,
  `discount` decimal(10,2) NOT NULL
) ;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`voucher_code`, `usage_limit`, `used_count`, `start_time`, `end_time`, `min_order_value`, `max_sale_value`, `discount`) VALUES
('FREE_SHIP', 500, 10, '2024-10-01 00:00:00', '2025-01-01 23:59:59', 150000.00, 30000.00, 15000.00),
('NO_MIN_01', 200, 150, '2024-05-01 00:00:00', '2024-12-31 23:59:59', 0.00, 5000.00, 5000.00),
('SALE_10K', 1000, 50, '2024-11-20 00:00:00', '2024-12-31 23:59:59', 100000.00, 10000.00, 10000.00),
('TEST_OK', 10, 0, '2025-01-01 00:00:00', '2025-03-01 23:59:59', 200000.00, 25000.00, 10000.00),
('VIP_20', 50, 5, '2024-11-01 00:00:00', '2025-11-01 23:59:59', 500000.00, 50000.00, 20000.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author_of_product`
--
ALTER TABLE `author_of_product`
  ADD PRIMARY KEY (`product_id`,`author_name`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `FK_Cart_Customer` (`customer_id`);

--
-- Indexes for table `cart_product`
--
ALTER TABLE `cart_product`
  ADD PRIMARY KEY (`card_id`,`product_id`),
  ADD KEY `FK_CP_Product` (`product_id`);

--
-- Indexes for table `categorizes`
--
ALTER TABLE `categorizes`
  ADD PRIMARY KEY (`categoryB_id`),
  ADD KEY `FK_Cg_CategoryA` (`categoryA_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`category_id`,`product_id`),
  ADD KEY `FK_CtP_Product` (`product_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `flashsale`
--
ALTER TABLE `flashsale`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `flashsale_product`
--
ALTER TABLE `flashsale_product`
  ADD PRIMARY KEY (`sale_id`,`product_id`),
  ADD KEY `FK_FSP_Product` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `FK_Order_Payment` (`payment_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `FK_OP_Product` (`product_id`);

--
-- Indexes for table `order_voucher`
--
ALTER TABLE `order_voucher`
  ADD PRIMARY KEY (`order_id`,`voucher_code`),
  ADD KEY `FK_OV_Voucher` (`voucher_code`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_name` (`page_name`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `FK_Payment_Customer` (`customer_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `productreview`
--
ALTER TABLE `productreview`
  ADD PRIMARY KEY (`product_id`,`review_id`),
  ADD KEY `FK_PR_Customer` (`customer_id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`product_id`,`image_url`);

--
-- Indexes for table `qa`
--
ALTER TABLE `qa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key_name` (`key_name`);

--
-- Indexes for table `shipment`
--
ALTER TABLE `shipment`
  ADD PRIMARY KEY (`ship_code`);

--
-- Indexes for table `shipment_order`
--
ALTER TABLE `shipment_order`
  ADD PRIMARY KEY (`ship_code`),
  ADD KEY `FK_SO_Order` (`order_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`user_id`,`address`);

--
-- Indexes for table `user_phone`
--
ALTER TABLE `user_phone`
  ADD PRIMARY KEY (`user_id`,`phone`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`voucher_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `qa`
--
ALTER TABLE `qa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `author_of_product`
--
ALTER TABLE `author_of_product`
  ADD CONSTRAINT `FK_Au_Product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_Cart_Customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`user_id`);

--
-- Constraints for table `cart_product`
--
ALTER TABLE `cart_product`
  ADD CONSTRAINT `FK_CP_Cart` FOREIGN KEY (`card_id`) REFERENCES `cart` (`cart_id`),
  ADD CONSTRAINT `FK_CP_Product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `categorizes`
--
ALTER TABLE `categorizes`
  ADD CONSTRAINT `FK_Cg_CategoryA` FOREIGN KEY (`categoryA_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `FK_Cg_CategoryB` FOREIGN KEY (`categoryB_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `FK_CtP_Category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `FK_CtP_Product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `FK_Customer_User` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `flashsale_product`
--
ALTER TABLE `flashsale_product`
  ADD CONSTRAINT `FK_FSP_Flashsale` FOREIGN KEY (`sale_id`) REFERENCES `flashsale` (`sale_id`),
  ADD CONSTRAINT `FK_FSP_Product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_Order_Payment` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`payment_id`);

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `FK_OP_Order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `FK_OP_Product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `order_voucher`
--
ALTER TABLE `order_voucher`
  ADD CONSTRAINT `FK_OV_Order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `FK_OV_Voucher` FOREIGN KEY (`voucher_code`) REFERENCES `voucher` (`voucher_code`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `FK_Payment_Customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`user_id`);

--
-- Constraints for table `productreview`
--
ALTER TABLE `productreview`
  ADD CONSTRAINT `FK_PR_Customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`user_id`),
  ADD CONSTRAINT `FK_PR_Product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `FK_PI_Product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `shipment_order`
--
ALTER TABLE `shipment_order`
  ADD CONSTRAINT `FK_SO_Order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `FK_SO_Shipment` FOREIGN KEY (`ship_code`) REFERENCES `shipment` (`ship_code`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `FK_Staff_User` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `FK_UserAddress_User` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `user_phone`
--
ALTER TABLE `user_phone`
  ADD CONSTRAINT `FK_UserPhone_User` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- ==================================================================================
-- PHẦN BỔ SUNG CHO CÁC TÍNH NĂNG MỚI
-- ==================================================================================

--
-- Cấu trúc cho bảng Tin tức (News)
--
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `author_id` int(11) NOT NULL COMMENT 'ID của admin viết bài',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_News_Author` (`author_id`),
  CONSTRAINT `FK_News_Author` FOREIGN KEY (`author_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Cấu trúc cho bảng Bình luận (Comments)
--
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL COMMENT 'Để trả lời bình luận khác',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_Comment_News` (`news_id`),
  KEY `FK_Comment_User` (`user_id`),
  KEY `FK_Comment_Parent` (`parent_id`),
  CONSTRAINT `FK_Comment_News` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_Comment_User` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_Comment_Parent` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Cập nhật bảng Hỏi-Đáp (QA)
--
ALTER TABLE `qa`
  ADD COLUMN `user_id` INT(11) NULL DEFAULT NULL COMMENT 'ID của người dùng đặt câu hỏi' AFTER `category`,
  ADD COLUMN `status` VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending' COMMENT 'Trạng thái: pending, answered' AFTER `user_id`;

UPDATE `qa` SET `status` = 'answered' WHERE `user_id` IS NULL;

ALTER TABLE `qa`
  ADD CONSTRAINT `FK_QA_User` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
