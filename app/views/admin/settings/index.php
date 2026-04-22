

<div class="row row-cards">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Cấu hình thông tin chung</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label class="form-label">Hotline</label>
                        <input type="text" class="form-control" name="phone" value="<?= htmlspecialchars($settings['phone'] ?? '') ?>" placeholder="Nhập số hotline...">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Email liên hệ</label>
                        <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($settings['email'] ?? '') ?>" placeholder="Nhập email...">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Địa chỉ</label>
                        <input type="text" class="form-control" name="address" value="<?= htmlspecialchars($settings['address'] ?? '') ?>" placeholder="Nhập địa chỉ công ty...">
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Lưu thay đổi
                        </button>
                        <a href="<?= BASE_URL ?>admin" class="btn btn-link">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
