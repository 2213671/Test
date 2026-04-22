<style>
    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    .stat-card {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
    }
    .stat-icon.products { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .stat-icon.orders { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
    .stat-info { flex: 1; }
    .stat-label { font-size: 14px; color: #666; margin-bottom: 5px; }
    .stat-value { font-size: 28px; font-weight: 700; color: #333; }
    .welcome-card {
        background: linear-gradient(135deg, #c92127 0%, #a01b20 100%);
        color: white;
        padding: 30px;
        border-radius: 12px;
        margin-bottom: 30px;
    }
    .welcome-card h2 { font-size: 24px; margin-bottom: 10px; }
</style>

<div class="welcome-card">
    <h2>Chào mừng trở lại, <?= $_SESSION['user_name'] ?? 'Admin' ?>!</h2>
    <p>Đây là trang quản trị hệ thống Fahasa.</p>
</div>

<div class="dashboard-stats">
    <div class="stat-card">
        <div class="stat-icon products">
            <i class="fa-solid fa-box"></i>
        </div>
        <div class="stat-info">
            <div class="stat-label">Tổng sản phẩm</div>
            <div class="stat-value">0</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orders">
            <i class="fa-solid fa-shopping-cart"></i>
        </div>
        <div class="stat-info">
            <div class="stat-label">Đơn hàng</div>
            <div class="stat-value">0</div>
        </div>
    </div>
</div>
