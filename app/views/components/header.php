<?php 
// views/components/header.php

// Khởi tạo session nếu chưa có
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Helper: an toàn khi echo
function e($v) {
    return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
}

// Cart count - lấy từ database nếu đã đăng nhập
$cartCount = 0;
if (isset($_SESSION['users_id'])) {
    require_once APP_ROOT . '/models/CartModel.php';
    $cartModel = new CartModel();
    $cartCount = max(0, $cartModel->getCartCount($_SESSION['users_id']));
}

// User info
$user = null;
if (isset($_SESSION['users_id'])) {
    $user = [
        'id' => $_SESSION['users_id'],
        'name' => $_SESSION['users_username'] ?? 'User',
        'email' => $_SESSION['users_email'] ?? '',
        'role' => $_SESSION['users_role'] ?? 'user'
    ];
}

// BASE_URL constant phải được định nghĩa ở config (bạn đã dùng trước đó)
$base = defined('BASE_URL') ? rtrim(BASE_URL, '/') . '/' : '/';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title & Description -->
    <title><?= e($title ?? 'BTL FAHASA - Website Bán Sách Trực Tuyến') ?></title>
    <meta name="description" content="<?= e($description ?? 'BTL FAHASA - Website bán sách trực tuyến uy tín với hàng ngàn đầu sách đa dạng. Mua sách online giá tốt, giao hàng nhanh chóng, ưu đãi hấp dẫn.') ?>">
    <meta name="keywords" content="<?= e($keywords ?? 'mua sách online, bán sách trực tuyến, fahasa, sách giáo khoa, văn học, self-help, tiểu thuyết, sách thiếu nhi') ?>">
    <meta name="author" content="Nhóm L01_6 - HCMUT">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= e($ogUrl ?? BASE_URL) ?>">
    <meta property="og:title" content="<?= e($ogTitle ?? $title ?? 'BTL FAHASA - Website Bán Sách Trực Tuyến') ?>">
    <meta property="og:description" content="<?= e($ogDescription ?? $description ?? 'Website bán sách trực tuyến uy tín với hàng ngàn đầu sách đa dạng') ?>">
    <meta property="og:image" content="<?= e($ogImage ?? BASE_URL . 'images/og-default.jpg') ?>">
    <meta property="og:locale" content="vi_VN">
    <meta property="og:site_name" content="BTL FAHASA">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?= e($ogUrl ?? BASE_URL) ?>">
    <meta name="twitter:title" content="<?= e($ogTitle ?? $title ?? 'BTL FAHASA') ?>">
    <meta name="twitter:description" content="<?= e($ogDescription ?? $description ?? 'Website bán sách trực tuyến') ?>">
    <meta name="twitter:image" content="<?= e($ogImage ?? BASE_URL . 'images/og-default.jpg') ?>">

    <!-- Canonical URL -->
    <link rel="canonical" href="<?= e($canonical ?? BASE_URL . ltrim($_SERVER['REQUEST_URI'] ?? '', '/')) ?>">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --fahasa-red: #C92127;
            --fahasa-orange: #F7941E;
            --fahasa-dark: #2C2C2C;
            --fahasa-gray: #666666;
            --fahasa-light-gray: #F5F5F5;
        }

        body {
            font-family: 'Roboto', sans-serif;
            color: var(--fahasa-dark);
        }

        /* Header Styles */
        .top-header {
            background-color: var(--fahasa-red);
            color: white;
            padding: 8px 0;
            font-size: 13px;
        }

        .top-header a {
            color: white;
            text-decoration: none;
        }

        .top-header a:hover {
            text-decoration: underline;
        }

        .main-header {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
            padding: 12px 0;
        }

        .logo {
            font-size: 26px;
            font-weight: 700;
            color: var(--fahasa-red);
            text-decoration: none;
        }

        .logo:hover {
            color: var(--fahasa-orange);
        }

        .search-box {
            position: relative;
        }

        .search-box input[type="search"] {
            border: 2px solid var(--fahasa-red);
            border-radius: 4px;
            padding: 10px 50px 10px 15px;
        }

        .search-box button {
            position: absolute;
            right: 2px;
            top: 50%;
            transform: translateY(-50%);
            background-color: var(--fahasa-red);
            border: none;
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
        }

        .search-box button:hover {
            background-color: #a81b20;
        }

        .nav-menu {
            background-color: var(--fahasa-light-gray);
            padding: 10px 0;
        }

        .nav-menu .nav-link {
            color: var(--fahasa-dark);
            font-weight: 500;
            padding: 8px 14px;
            text-decoration: none;
            transition: all 0.2s;
            border-radius: 4px;
        }

        .nav-menu .nav-link:hover,
        .nav-menu .nav-link.active {
            color: var(--fahasa-red);
            background-color: white;
        }

       .header-icons .dropdown-menu a {
    margin-left: 0;    
    font-size: 14px;     
    padding: 8px 16px;  
    width: 100%;         
}


.header-icons .dropdown-menu a:not(:hover) {
    color: var(--fahasa-dark); 
}
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -10px;
            background-color: var(--fahasa-red);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Account dropdown */
        .account-name {
            font-weight: 500;
            margin-left: 8px;
            color: var(--fahasa-dark);
        }

        .header-wrapper {
    position: -webkit-sticky; 
    position: sticky;         
    top: 0;                   
    z-index: 1020;           
    background-color: white;  
    box-shadow: 0 2px 5px rgba(0,0,0,0.1); 
}


        /* Responsive tweaks */
        @media (max-width: 767px) {
            .search-box input[type="search"] { padding-right: 44px; }
            .header-icons a { margin-left: 10px; }
        }
    </style>

<script>
    // Global variables for JavaScript
    const BASE_URL = '<?= BASE_URL ?>';
    window.isLoggedIn = <?= isset($_SESSION['users_id']) ? 'true' : 'false' ?>;
    window.needSyncCart = <?= isset($_SESSION['need_sync_cart']) ? 'true' : 'false' ?>;

    <?php if (isset($_SESSION['need_sync_cart'])): ?>
        // Xóa flag sau khi đã set
        <?php unset($_SESSION['need_sync_cart']); ?>
    <?php endif; ?>
</script>

<!-- Load cart.js -->
<script src="<?= BASE_URL ?>js/cart.js"></script>


</head>
<body>

<div class="header-wrapper">
    <!-- Top Header -->
    <div class="top-header" role="banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-7 col-sm-6">
                    <i class="fas fa-phone" aria-hidden="true"></i>
                    <span class="visually-hidden">Hotline:</span>
                    <a href="tel:19006656" class="ms-1" style="color:inherit; text-decoration: none;">1900-6656</a>
                </div>
                <div class="col-5 col-sm-6 text-end">
                    <?php if ($user): ?>
                        <span class="me-2"><i class="fas fa-user"></i> <?= e($user['name'] ?? $user['email'] ?? 'Người dùng') ?></span>
                        <?php if (isset($user['role']) && $user['role'] === 'admin'): ?>
                            <a href="<?= $base ?>admin" class="me-2 text-danger fw-bold"><i class="fas fa-cog"></i> Quản trị</a>
                        <?php endif; ?>
                        <a href="<?= $base ?>auth/logout" class="me-2" style="color:inherit;"><i class="fas fa-sign-out-alt" aria-hidden="true"></i> Đăng xuất</a>
                    <?php else: ?>
                        <a href="<?= $base ?>auth/login" class="me-2"><i class="fas fa-user"></i> Đăng nhập</a>
                        <span class="mx-1">|</span>
                        <a href="<?= $base ?>auth/register" class="ms-2"><i class="fas fa-user-plus"></i> Đăng ký</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="main-header" role="navigation" aria-label="Main navigation">
        <div class="container">
            <div class="row align-items-center g-3">
                
                <div class="col-9 col-md-3">
                    <a href="<?= $base ?>" class="logo" aria-label="Trang chủ FAHASA">
                        <i class="fas fa-book-open" aria-hidden="true"></i> FAHASA
                    </a>
                </div>

                <div class="col-3 col-md-9 d-flex justify-content-end align-items-center"> 
                    <div class="header-icons d-inline-flex align-items-center">
                        
                        <a href="<?= $base ?>cart" title="Giỏ hàng" aria-label="Giỏ hàng" class="position-relative ms-3">
                            <i class="fas fa-shopping-cart" aria-hidden="true"></i>
                            <?php if ($cartCount > 0): ?>
                                <span class="cart-badge" aria-live="polite" aria-atomic="true"><?= e($cartCount) ?></span>
                            <?php endif; ?>
                        </a>

                        <?php if ($user): ?>
                            <div class="btn-group ms-3 d-none d-md-block"> <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user-circle" aria-hidden="true"></i>
                                    <span class="account-name"><?= e($user['name'] ?? $user['email']) ?></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="<?= $base ?>customer"><i class="fas fa-user me-2"></i>Thông tin tài khoản</a></li>
                                    <li><a class="dropdown-item" href="<?= $base ?>customer/orders"><i class="fas fa-box me-2"></i>Đơn hàng của tôi</a></li>
                                    <!-- <li><a class="dropdown-item" href="<?= $base ?>customer/notifications"><i class="fas fa-bell me-2"></i>Thông báo</a></li> -->
                                    <li><a class="dropdown-item" href="<?= $base ?>customer/wishlist"><i class="fas fa-heart me-2"></i>Sản phẩm yêu thích</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-danger" href="<?= $base ?>auth/logout"><i class="fas fa-sign-out-alt me-2"></i>Đăng xuất</a></li>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Navigation Menu -->
    <nav class="nav-menu" aria-label="Danh mục chính">
        <div class="container">
            <div class="d-flex flex-wrap gap-2">
                <a href="<?= $base ?>home" class="nav-link <?= ($page ?? '') == 'home' ? 'active' : '' ?>" aria-current="<?= ($page ?? '') == 'home' ? 'page' : 'false' ?>">
                    <i class="fas fa-home" aria-hidden="true"></i> Trang chủ
                </a>
                <a href="<?= $base ?>home/about" class="nav-link <?= ($page ?? '') == 'about' ? 'active' : '' ?>">
                    <i class="fas fa-info-circle" aria-hidden="true"></i> Giới thiệu
                </a>
                <a href="<?= $base ?>home/qa" class="nav-link <?= ($page ?? '') == 'qa' ? 'active' : '' ?>">
                    <i class="fas fa-question-circle" aria-hidden="true"></i> Hỏi/Đáp
                </a>
                <a href="<?= $base ?>product" class="nav-link <?= ($page ?? '') == 'product' ? 'active' : '' ?>">
                    <i class="fas fa-book" aria-hidden="true"></i> Sản phẩm
                </a>
                <a href="<?= $base ?>news" class="nav-link <?= ($page ?? '') == 'news' ? 'active' : '' ?>">
                    <i class="fas fa-newspaper" aria-hidden="true"></i> Tin tức
                </a>
                <a href="<?= $base ?>contact" class="nav-link <?= ($page ?? '') == 'contact' ? 'active' : '' ?>">
                    <i class="fas fa-phone" aria-hidden="true"></i> Liên hệ
                </a>
            </div>
        </div>
    </nav>
</div>
    <!-- Scripts: Bootstrap JS (popper)
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Accessibility: add keyboard focus styles for nav links if needed
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('focus', () => link.classList.add('focused'));
                link.addEventListener('blur', () => link.classList.remove('focused'));
            });

            // Improve clickable phone for mobile by ensuring tel: link exists (handled in markup)
        });
    </script> -->
</body>
</html>
