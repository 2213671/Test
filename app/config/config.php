<?php
/**
 * File cấu hình chính của ứng dụng
 * Chứa tất cả các thiết lập và hằng số toàn cục
 */

// =================================
// CẤU HÌNH DATABASE
// =================================
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'fahasa_db');
//use port 3307
define('DB_PORT', 3307);

// =================================
// CẤU HÌNH ỨNG DỤNG
// =================================
define('APP_NAME', 'BTL FAHASA');

// QUAN TRỌNG: Chỉ cần sửa tên thư mục ở đây!
define('PROJECT_NAME', 'BTL_Fahasa'); // ← Sửa tên này theo thư mục của bạn
define('BASE_URL', 'http://localhost/' . PROJECT_NAME . '/public/');

// Đường dẫn tuyệt đối
define('APP_ROOT', dirname(dirname(__FILE__))); // app/
define('ROOT', dirname(APP_ROOT)); // BTL_Fahasa/
define('PUBLIC_PATH', ROOT . '/public/');

// =================================
// CẤU HÌNH MÔI TRƯỜNG
// =================================
define('ENVIRONMENT', 'development'); // development hoặc production

// Bật/tắt hiển thị lỗi
if(ENVIRONMENT === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// =================================
// CẤU HÌNH KHÁC
// =================================
date_default_timezone_set('Asia/Ho_Chi_Minh'); // Múi giờ VN
define('CHARSET', 'UTF-8');