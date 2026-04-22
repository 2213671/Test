<?php
// Lấy current page từ URL
$currentPage = $_GET['page'] ?? 'index';
$requestUri = $_SERVER['REQUEST_URI'] ?? '';

// Xác định active menu item
$isProfile = strpos($requestUri, 'customer/index') !== false || (strpos($requestUri, 'customer') !== false && strpos($requestUri, 'customer/') === false);
$isOrders = strpos($requestUri, 'customer/orders') !== false;
$isNotifications = strpos($requestUri, 'customer/notifications') !== false;
$isWishlist = strpos($requestUri, 'customer/wishlist') !== false;
?>

<style>
    .customer-sidebar {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        padding: 20px;
        position: sticky;
        top: 20px;
    }
    
    .sidebar-header {
        text-align: center;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--fahasa-light-gray);
        margin-bottom: 20px;
    }
    
    .sidebar-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: var(--fahasa-light-gray);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 2.5rem;
        color: var(--fahasa-gray);
    }
    
    .sidebar-username {
        font-weight: 600;
        color: var(--fahasa-dark);
        margin-bottom: 5px;
    }
    
    .sidebar-email {
        font-size: 0.9rem;
        color: var(--fahasa-gray);
    }
    
    .sidebar-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .sidebar-menu-item {
        margin-bottom: 8px;
    }
    
    .sidebar-menu-link {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        color: var(--fahasa-dark);
        text-decoration: none;
        border-radius: 6px;
        transition: all 0.3s;
    }
    
    .sidebar-menu-link:hover {
        background-color: var(--fahasa-light-gray);
        color: var(--fahasa-red);
    }
    
    .sidebar-menu-link.active {
        background-color: var(--fahasa-red);
        color: white;
    }
    
    .sidebar-menu-link.active:hover {
        background-color: #a51b1f;
    }
    
    .sidebar-menu-link i {
        width: 24px;
        margin-right: 12px;
        font-size: 1.1rem;
    }
    
    @media (max-width: 991.98px) {
        .customer-sidebar {
            position: static;
            margin-bottom: 30px;
        }
        
        .sidebar-header {
            display: flex;
            align-items: center;
            text-align: left;
            gap: 15px;
        }
        
        .sidebar-avatar {
            width: 60px;
            height: 60px;
            margin: 0;
            font-size: 2rem;
        }
        
        .sidebar-user-info {
            flex: 1;
        }
    }
</style>

<div class="customer-sidebar">
    <div class="sidebar-header">
        <div class="sidebar-avatar">
            <i class="fas fa-user-circle"></i>
        </div>
        <div class="sidebar-user-info">
            <div class="sidebar-username"><?= htmlspecialchars($_SESSION['users_username'] ?? 'Người dùng') ?></div>
            <div class="sidebar-email">Tài khoản của tôi</div>
        </div>
    </div>
    
    <ul class="sidebar-menu">
        <li class="sidebar-menu-item">
            <a href="<?= BASE_URL ?>customer" class="sidebar-menu-link <?= $isProfile ? 'active' : '' ?>">
                <i class="fas fa-user"></i>
                <span>Thông tin tài khoản</span>
            </a>
        </li>
        <li class="sidebar-menu-item">
            <a href="<?= BASE_URL ?>customer/orders" class="sidebar-menu-link <?= $isOrders ? 'active' : '' ?>">
                <i class="fas fa-box"></i>
                <span>Đơn hàng của tôi</span>
            </a>
        </li>
        <!-- <li class="sidebar-menu-item">
            <a href="<?= BASE_URL ?>customer/notifications" class="sidebar-menu-link <?= $isNotifications ? 'active' : '' ?>">
                <i class="fas fa-bell"></i>
                <span>Thông báo</span>
            </a>
        </li> -->
        <li class="sidebar-menu-item">
            <a href="<?= BASE_URL ?>customer/wishlist" class="sidebar-menu-link <?= $isWishlist ? 'active' : '' ?>">
                <i class="fas fa-heart"></i>
                <span>Sản phẩm yêu thích</span>
            </a>
        </li>
    </ul>
</div>
