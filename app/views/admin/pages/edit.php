

<div class="row row-cards">
    <div class="col-12">
        <form method="POST" action="" class="card">
            <div class="card-header">
                <h3 class="card-title">Chỉnh sửa nội dung trang: <?= ucfirst($currPage) ?></h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Nội dung bài viết (HTML)</label>
                    <textarea class="form-control" name="content" rows="15" placeholder="Nhập nội dung tại đây..."><?= htmlspecialchars($content) ?></textarea>
                    <small class="form-hint">Bạn có thể nhập mã HTML hoặc văn bản thường.</small>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="<?= BASE_URL ?>admin" class="btn btn-link">Hủy bỏ</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Cập nhật nội dung
                </button>
            </div>
        </form>
    </div>
</div>