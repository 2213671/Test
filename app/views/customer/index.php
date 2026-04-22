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
    
    .profile-form .form-label {
        font-weight: 500;
        color: var(--fahasa-dark);
        margin-bottom: 8px;
    }
    
    .profile-form .form-control,
    .profile-form .form-select {
        border: 1px solid #ddd;
        padding: 10px 15px;
        border-radius: 6px;
    }
    
    .profile-form .form-control:focus,
    .profile-form .form-select:focus {
        border-color: var(--fahasa-orange);
        box-shadow: 0 0 0 0.2rem rgba(247, 148, 30, 0.25);
    }
    
    .btn-save {
        background-color: var(--fahasa-red);
        color: white;
        padding: 12px 40px;
        border: none;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.3s;
    }
    
    .btn-save:hover {
        background-color: #a51b1f;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(201, 33, 39, 0.3);
    }
    
    .btn-cancel {
        background-color: var(--fahasa-gray);
        color: white;
        padding: 12px 40px;
        border: none;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.3s;
    }
    
    .btn-cancel:hover {
        background-color: #555;
    }
    
    .info-card {
        background: var(--fahasa-light-gray);
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    
    .info-card-title {
        font-weight: 600;
        color: var(--fahasa-dark);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }
    
    .info-card-title i {
        color: var(--fahasa-orange);
        margin-right: 10px;
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
                        <i class="fas fa-user"></i>
                        Thông tin tài khoản
                    </h2>
                    
                    <!-- Account Info Card -->
                    <div class="info-card">
                        <div class="info-card-title">
                            <i class="fas fa-info-circle"></i>
                            Thông tin cơ bản
                        </div>
                        <p class="mb-0 text-muted">
                            Quản lý thông tin hồ sơ để bảo mật tài khoản của bạn
                        </p>
                    </div>
                    
                    <!-- Profile Form -->
                    <form class="profile-form" id="profileForm">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="fullname" class="form-label">
                                    <i class="fas fa-user me-2 text-muted"></i>Họ và tên *
                                </label>
                                <input type="text" class="form-control" id="fullname" name="fullname"
                                       value="<?= htmlspecialchars($user['fullname'] ?? '') ?>"
                                       placeholder="Nhập họ và tên đầy đủ"
                                       required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-2 text-muted"></i>Email *
                                </label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="<?= htmlspecialchars($user['email'] ?? '') ?>"
                                       placeholder="example@email.com"
                                       required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">
                                    <i class="fas fa-phone me-2 text-muted"></i>Số điện thoại
                                </label>
                                <input type="tel" class="form-control" id="phone" name="phone"
                                       value="<?= htmlspecialchars($user['phone'] ?? '') ?>"
                                       placeholder="Nhập số điện thoại">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="role" class="form-label">
                                    <i class="fas fa-user-tag me-2 text-muted"></i>Vai trò
                                </label>
                                <input type="text" class="form-control" id="role"
                                       value="<?= htmlspecialchars($user['role'] ?? 'Customer') ?>"
                                       readonly disabled>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-calendar me-2 text-muted"></i>Thành viên từ
                                </label>
                                <input type="text" class="form-control"
                                       value="<?= !empty($user['created_date']) ? date('d/m/Y', strtotime($user['created_date'])) : 'N/A' ?>"
                                       readonly disabled>
                            </div>
                        </div>
                        
                        <div class="mt-4 d-flex gap-3">
                            <button type="submit" class="btn btn-save">
                                <i class="fas fa-save me-2"></i>Lưu thay đổi
                            </button>
                            <button type="button" class="btn btn-cancel" onclick="window.location.reload()">
                                <i class="fas fa-times me-2"></i>Hủy
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('profileForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = this;
    const data = new URLSearchParams(new FormData(form)).toString();
    const btn = form.querySelector('.btn-save');
    const orig = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang lưu...';

    fetch('<?= BASE_URL ?>customer/updateProfile', {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: data
    })
    .then(r => r.json())
    .then(res => {
        btn.disabled = false;
        btn.innerHTML = orig;
        if (res.success) {
            showToast('Cập nhật thành công');
            setTimeout(()=> location.reload(), 800);
        } else if (res.need_login) {
            window.location.href = '<?= BASE_URL ?>auth/login';
        } else {
            showToast(res.message || 'Lỗi', 'danger');
        }
    })
    .catch(err => {
        btn.disabled = false;
        btn.innerHTML = orig;
        showToast('Lỗi kết nối', 'danger');
    });
});

/* small toast helper (if not present globally) */
function showToast(msg, type='success') {
    const colors = { success: '#10b981', danger:'#ef4444', info:'#3b82f6' };
    const el = document.createElement('div');
    el.style.cssText = `position:fixed;right:20px;top:20px;padding:12px 16px;border-radius:8px;color:#fff;z-index:99999;background:${colors[type]||colors.info};box-shadow:0 6px 20px rgba(0,0,0,0.12)`;
    el.textContent = msg;
    document.body.appendChild(el);
    setTimeout(()=> el.style.opacity = '0', 2000);
    setTimeout(()=> el.remove(), 2600);
}
</script>

<?php require_once APP_ROOT . '/views/components/footer.php'; ?>
