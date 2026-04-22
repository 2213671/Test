<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <title><?= $title ?? 'Admin Dashboard' ?> - FAHASA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --sidebar-width: 260px;
            --sidebar-collapsed-width: 70px;
            --primary-color: #c92127;
            --primary-dark: #a01b20;
            --secondary-color: #f7941d;
            --bg-color: #f5f5f5;
            --text-color: #333;
            --text-light: #666;
            --border-color: #e0e0e0;
            --sidebar-bg: #1e293b;
            --sidebar-text: #cbd5e1;
            --sidebar-hover: #334155;
            --sidebar-active: #c92127;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-color);
            color: var(--text-color);
            overflow-x: hidden;
        }

        .admin-sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            color: var(--sidebar-text);
            transition: var(--transition);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .admin-sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-header {
            padding: 20px;
            background: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 70px;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            text-decoration: none;
            overflow: hidden;
        }

        .sidebar-logo i {
            font-size: 24px;
            min-width: 30px;
            text-align: center;
        }

        .sidebar-logo-text {
            font-size: 18px;
            font-weight: 700;
            white-space: nowrap;
            opacity: 1;
            transition: var(--transition);
        }

        .admin-sidebar.collapsed .sidebar-logo-text {
            opacity: 0;
            width: 0;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            transition: var(--transition);
        }

        .sidebar-toggle:hover {
            background: rgba(255,255,255,0.1);
        }

        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: 20px 0;
        }

        .sidebar-nav::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-nav::-webkit-scrollbar-thumb {
            background: var(--sidebar-hover);
            border-radius: 3px;
        }

        .nav-section {
            margin-bottom: 30px;
        }

        .nav-section-title {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-light);
            padding: 0 20px;
            margin-bottom: 10px;
            font-weight: 600;
            opacity: 1;
            transition: var(--transition);
        }

        .admin-sidebar.collapsed .nav-section-title {
            opacity: 0;
            height: 0;
            margin: 0;
            padding: 0;
        }

        .nav-item {
            list-style: none;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 20px;
            color: var(--sidebar-text);
            text-decoration: none;
            transition: var(--transition);
            position: relative;
        }

        .nav-link:hover {
            background: var(--sidebar-hover);
            color: white;
        }

        .nav-link.active {
            background: var(--sidebar-active);
            color: white;
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: white;
        }

        .nav-link i {
            font-size: 18px;
            min-width: 30px;
            text-align: center;
        }

        .nav-link-text {
            font-size: 14px;
            font-weight: 500;
            white-space: nowrap;
            opacity: 1;
            transition: var(--transition);
        }

        .admin-sidebar.collapsed .nav-link-text {
            opacity: 0;
            width: 0;
        }

        .admin-sidebar.collapsed .nav-link {
            justify-content: center;
            padding: 12px;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .logout-link {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 20px;
            color: #ef4444;
            text-decoration: none;
            transition: var(--transition);
            border-radius: 8px;
            font-weight: 500;
        }

        .logout-link:hover {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
        }

        .logout-link i {
            font-size: 18px;
            min-width: 30px;
            text-align: center;
        }

        .admin-sidebar.collapsed .logout-link {
            justify-content: center;
            padding: 12px;
        }

        .admin-main {
            margin-left: var(--sidebar-width);
            transition: var(--transition);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .admin-sidebar.collapsed ~ .admin-main {
            margin-left: var(--sidebar-collapsed-width);
        }

        .admin-header {
            background: white;
            border-bottom: 1px solid var(--border-color);
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .page-title-header {
            font-size: 20px;
            font-weight: 600;
            color: var(--text-color);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
            background: var(--bg-color);
            border-radius: 8px;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .user-details {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-color);
        }

        .user-role {
            font-size: 12px;
            color: var(--text-light);
        }

        .admin-content {
            flex: 1;
            padding: 30px;
        }

        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }

            .admin-sidebar.mobile-show {
                transform: translateX(0);
            }

            .admin-main {
                margin-left: 0 !important;
            }

            .user-details {
                display: none;
            }
        }
    </style>
    <script src="<?= BASE_URL ?>app/views/admin/layout/helper.js"></script>
</head>
<body>

<aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-header">
        <a href="<?= BASE_URL ?>admin" class="sidebar-logo">
            <i class="fa-solid fa-book"></i>
            <span class="sidebar-logo-text">FAHASA ADMIN</span>
        </a>
        <button class="sidebar-toggle" onclick="toggleSidebar()">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section">
            <div class="nav-section-title">Main</div>
            <ul>
                <li class="nav-item">
                    <a class="nav-link <?= ($page ?? '') == 'dashboard' ? 'active' : '' ?>" href="<?= BASE_URL ?>admin">
                        <i class="fa-solid fa-home"></i>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Quản lý</div>
            <ul>
                <li class="nav-item">
                    <a class="nav-link <?= ($page ?? '') == 'products' ? 'active' : '' ?>" href="<?= BASE_URL ?>admin/products">
                        <i class="fa-solid fa-box"></i>
                        <span class="nav-link-text">Sản phẩm</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($page ?? '') == 'orders' ? 'active' : '' ?>" href="<?= BASE_URL ?>admin/orders">
                        <i class="fa-solid fa-shopping-cart"></i>
                        <span class="nav-link-text">Đơn hàng</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($page ?? '') == 'users' ? 'active' : '' ?>" href="<?= BASE_URL ?>admin/customers">
                        <i class="fa-solid fa-users"></i>
                        <span class="nav-link-text">Khách hàng</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($page ?? '') == 'news' ? 'active' : '' ?>" href="<?= BASE_URL ?>admin/news">
                        <i class="fa-solid fa-newspaper"></i>
                        <span class="nav-link-text">Tin tức</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Cấu hình</div>
            <ul>
                <li class="nav-item">
                    <a class="nav-link <?= ($page ?? '') == 'settings' ? 'active' : '' ?>" href="<?= BASE_URL ?>admin/settings">
                        <i class="fa-solid fa-cog"></i>
                        <span class="nav-link-text">Cài đặt chung</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link <?= ($page ?? '') == 'qa' ? 'active' : '' ?>" href="<?= BASE_URL ?>admin/qa">
                        <i class="fa-solid fa-question-circle"></i>
                        <span class="nav-link-text">Hỏi đáp</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= ($page ?? '') == 'contacts' ? 'active' : '' ?>" href="<?= BASE_URL ?>admin/contacts">
                        <i class="fa-solid fa-envelope"></i>
                        <span class="nav-link-text">Liên hệ</span>
                    </a>
                </li>

            </ul>
        </div>
    </nav>

    <div class="sidebar-footer">
        <a href="<?= BASE_URL ?>auth/logout" class="logout-link" onclick="return confirm('Bạn có chắc muốn đăng xuất?')">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span class="nav-link-text">Đăng xuất</span>
        </a>
    </div>
</aside>

<div class="admin-main">
    <header class="admin-header">
        <div class="header-left">
            <h1 class="page-title-header"><?= $title ?? 'Admin Dashboard' ?></h1>
        </div>
        <div class="header-right">
            <div class="user-info">
                <div class="user-avatar">
                    <?= strtoupper(substr($_SESSION['user_name'] ?? 'A', 0, 1)) ?>
                </div>
                <div class="user-details">
                    <div class="user-name"><?= $_SESSION['user_name'] ?? 'Admin' ?></div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
        </div>
    </header>

    <main class="admin-content">
