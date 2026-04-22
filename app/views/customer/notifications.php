<?php require_once APP_ROOT . '/views/components/header.php'; ?>

<style>
    .customer-container {
        padding: 40px 0;
        background-color: #f8f9fa;
        min-height: calc(100vh - 200px);
    }
    
    .customer-content {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        padding: 30px;
    }
    
    .page-title {
        color: var(--fahasa-dark);
        font-weight: 700;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--fahasa-light-gray);
    }
    
    .page-title i {
        color: var(--fahasa-red);
        margin-right: 10px;
    }
    
    .notification-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .btn-mark-all {
        padding: 8px 20px;
        background-color: var(--fahasa-orange);
        color: white;
        border: none;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .btn-mark-all:hover {
        background-color: #e68419;
    }
    
    .notification-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .notification-item {
        display: flex;
        gap: 15px;
        padding: 20px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        margin-bottom: 15px;
        transition: all 0.3s;
        cursor: pointer;
    }
    
    .notification-item:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border-color: var(--fahasa-orange);
    }
    
    .notification-item.unread {
        background-color: #fff8f0;
        border-left: 4px solid var(--fahasa-orange);
    }
    
    .notification-icon {
        width: 50px;
        height: 50px;
        flex-shrink: 0;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    
    .notification-icon.type-order {
        background-color: #e3f2fd;
        color: #1976d2;
    }
    
    .notification-icon.type-promotion {
        background-color: #fff3e0;
        color: #f57c00;
    }
    
    .notification-icon.type-system {
        background-color: #f3e5f5;
        color: #7b1fa2;
    }
    
    .notification-content {
        flex: 1;
    }
    
    .notification-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 8px;
        gap: 10px;
    }
    
    .notification-title {
        font-weight: 600;
        color: var(--fahasa-dark);
        margin: 0;
    }
    
    .notification-time {
        color: var(--fahasa-gray);
        font-size: 0.85rem;
        white-space: nowrap;
    }
    
    .notification-text {
        color: var(--fahasa-gray);
        line-height: 1.6;
        margin: 0;
    }
    
    .notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background-color: var(--fahasa-red);
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        font-size: 0.7rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }
    
    .empty-state i {
        font-size: 4rem;
        color: var(--fahasa-gray);
        margin-bottom: 20px;
    }
    
    .empty-state h4 {
        color: var(--fahasa-dark);
        margin-bottom: 10px;
    }
    
    .empty-state p {
        color: var(--fahasa-gray);
    }
    
    @media (max-width: 767.98px) {
        .notification-item {
            flex-direction: column;
        }
        
        .notification-header {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<div class="customer-container">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3">
                <?php require_once APP_ROOT . '/views/customer/sidebar.php'; ?>
            </div>
            
            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="customer-content">
                    <h2 class="page-title">
                        <i class="fas fa-bell"></i>
                        Thông báo
                    </h2>
                    
                    <!-- Notification Actions -->
                    <div class="notification-actions">
                        <div>
                            <span class="text-muted">
                                Bạn có <strong class="text-danger" id="unreadCount">
                                    <?php 
                                    $unreadCount = 0;
                                    foreach ($notifications as $notif) {
                                        if (!$notif['is_read']) $unreadCount++;
                                    }
                                    echo $unreadCount;
                                    ?>
                                </strong> thông báo chưa đọc
                            </span>
                        </div>
                        <button class="btn-mark-all" id="markAllRead">
                            <i class="fas fa-check-double me-2"></i>Đánh dấu tất cả đã đọc
                        </button>
                    </div>
                    
                    <!-- Notifications List -->
                    <?php if (!empty($notifications)): ?>
                        <ul class="notification-list">
                            <?php foreach ($notifications as $notif): ?>
                                <li class="notification-item <?= !$notif['is_read'] ? 'unread' : '' ?>" 
                                    data-id="<?= $notif['id'] ?>">
                                    <div class="notification-icon type-<?= $notif['type'] ?>">
                                        <i class="fas <?= $notif['icon'] ?>"></i>
                                    </div>
                                    <div class="notification-content">
                                        <div class="notification-header">
                                            <h5 class="notification-title">
                                                <?= htmlspecialchars($notif['title']) ?>
                                            </h5>
                                            <span class="notification-time">
                                                <i class="far fa-clock me-1"></i>
                                                <?= htmlspecialchars($notif['time']) ?>
                                            </span>
                                        </div>
                                        <p class="notification-text">
                                            <?= htmlspecialchars($notif['content']) ?>
                                        </p>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <div class="empty-state">
                            <i class="far fa-bell-slash"></i>
                            <h4>Chưa có thông báo nào</h4>
                            <p>Bạn sẽ nhận được thông báo về đơn hàng, khuyến mãi và các tin tức mới nhất tại đây.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Mark notification as read when clicked (UI only)
document.querySelectorAll('.notification-item').forEach(item => {
    item.addEventListener('click', function() {
        if (this.classList.contains('unread')) {
            this.classList.remove('unread');
            updateUnreadCount();
        }
    });
});

// mark single notification as read (AJAX)
document.querySelectorAll('.notification-item').forEach(item => {
    item.addEventListener('click', function() {
        const id = this.dataset.id;
        if (!id) return;
        // optimistic UI
        if (this.classList.contains('unread')) this.classList.remove('unread');

        fetch('<?= BASE_URL ?>customer/markNotificationRead', {
            method: 'POST',
            headers: {'Content-Type':'application/x-www-form-urlencoded'},
            body: 'id=' + encodeURIComponent(id)
        }).then(r => r.json()).then(res => {
            if (!res.success) {
                // revert if failed
                item.classList.add('unread');
                showToast(res.message || 'Không thể đánh dấu', 'danger');
            } else {
                updateUnreadCount();
            }
        }).catch(() => {
            item.classList.add('unread');
            showToast('Lỗi kết nối', 'danger');
        });
    });
});

// mark all notifications as read (AJAX)
document.getElementById('markAllRead')?.addEventListener('click', function() {
    const btn = this;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang xử lý...';

    fetch('<?= BASE_URL ?>customer/markAllNotificationsRead', {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: '' // no body needed
    }).then(r => r.json()).then(res => {
        btn.disabled = false;
        if (res.success) {
            document.querySelectorAll('.notification-item.unread').forEach(i => i.classList.remove('unread'));
            updateUnreadCount();
            btn.innerHTML = '<i class="fas fa-check me-2"></i>Đã đánh dấu!';
            setTimeout(() => btn.innerHTML = '<i class="fas fa-check-double me-2"></i>Đánh dấu tất cả đã đọc', 1200);
        } else {
            showToast(res.message || 'Không thể xử lý', 'danger');
            btn.innerHTML = '<i class="fas fa-check-double me-2"></i>Đánh dấu tất cả đã đọc';
        }
    }).catch(() => {
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-check-double me-2"></i>Đánh dấu tất cả đã đọc';
        showToast('Lỗi kết nối', 'danger');
    });
});

// Update unread notification count on UI
function updateUnreadCount() {
    const unreadCount = document.querySelectorAll('.notification-item.unread').length;
    const countElement = document.getElementById('unreadCount');
    if (countElement) {
        countElement.textContent = unreadCount;
    }
}
</script>

<?php require_once APP_ROOT . '/views/components/footer.php'; ?>
