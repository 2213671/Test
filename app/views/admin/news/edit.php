<style>
    .form-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .form-label .text-danger {
        margin-left: 3px;
    }

    .form-control, .form-select {
        border-radius: 6px;
        border: 1px solid #d1d5db;
        padding: 0.625rem 0.875rem;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-control:focus, .form-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        outline: none;
    }

    textarea.form-control {
        resize: vertical;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }

    .card {
        border: none;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
        padding: 1.25rem 1.5rem;
        border-radius: 8px 8px 0 0;
    }

    .card-title {
        color: #1e293b;
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0;
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-footer {
        background-color: #f8f9fa;
        border-top: 1px solid #e9ecef;
        padding: 1rem 1.5rem;
        border-radius: 0 0 8px 8px;
    }

    .btn-primary {
        background-color: #3b82f6;
        border-color: #3b82f6;
        padding: 0.5rem 1.5rem;
        font-weight: 500;
        border-radius: 6px;
    }

    .btn-primary:hover {
        background-color: #2563eb;
        border-color: #2563eb;
    }

    .btn-link {
        color: #6b7280;
        text-decoration: none;
        padding: 0.5rem 1.5rem;
    }

    .btn-link:hover {
        color: #374151;
    }

    .current-image {
        max-width: 300px;
        max-height: 200px;
        border-radius: 6px;
        border: 1px solid #e5e7eb;
        margin-bottom: 10px;
    }

    .image-preview {
        max-width: 200px;
        max-height: 200px;
        margin-top: 10px;
        border-radius: 6px;
        border: 1px solid #e5e7eb;
        display: none;
    }

    .help-text {
        font-size: 0.875rem;
        color: #6b7280;
        margin-top: 0.25rem;
    }

    .alert {
        padding: 1rem;
        border-radius: 6px;
        margin-bottom: 1.5rem;
    }

    .alert-info {
        background-color: #dbeafe;
        border: 1px solid #93c5fd;
        color: #1e40af;
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 1rem;
        }
    }
</style>

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Sửa bài viết</h2>
                <div class="text-muted mt-1">Chỉnh sửa thông tin bài viết #<?= $article['id'] ?? '' ?></div>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <a href="<?= BASE_URL ?>admin/news" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <?php if (empty($article)): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle me-2"></i>
                Không tìm thấy bài viết này!
            </div>
            <a href="<?= BASE_URL ?>admin/news" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Quay lại danh sách
            </a>
        <?php else: ?>
            <form action="" method="POST" enctype="multipart/form-data" class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-edit me-2"></i>Thông tin bài viết
                    </h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">
                            Tiêu đề bài viết <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="title" required
                               value="<?= htmlspecialchars($article['title'] ?? '') ?>"
                               placeholder="Nhập tiêu đề bài viết...">
                        <div class="help-text">Tiêu đề nên ngắn gọn, súc tích và thu hút</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Danh mục <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" name="category" required>
                                <option value="">-- Chọn danh mục --</option>
                                <option value="kien-thuc" <?= ($article['category'] ?? '') == 'kien-thuc' ? 'selected' : '' ?>>Kiến thức</option>
                                <option value="sach-hay" <?= ($article['category'] ?? '') == 'sach-hay' ? 'selected' : '' ?>>Sách hay</option>
                                <option value="van-hoa" <?= ($article['category'] ?? '') == 'van-hoa' ? 'selected' : '' ?>>Văn hóa đọc</option>
                                <option value="giao-duc" <?= ($article['category'] ?? '') == 'giao-duc' ? 'selected' : '' ?>>Giáo dục</option>
                                <option value="cong-nghe" <?= ($article['category'] ?? '') == 'cong-nghe' ? 'selected' : '' ?>>Công nghệ</option>
                                <option value="ky-nang" <?= ($article['category'] ?? '') == 'ky-nang' ? 'selected' : '' ?>>Kỹ năng sống</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ngày đăng</label>
                            <input type="date" class="form-control" name="published_date"
                                   value="<?= $article['published_date'] ?? date('Y-m-d') ?>">
                            <div class="help-text">Ngày xuất bản bài viết</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Hình ảnh đại diện</label>

                        <?php if (!empty($article['image_url'])): ?>
                            <div class="mb-2">
                                <div class="help-text mb-1">Ảnh hiện tại:</div>
                                <img src="<?= BASE_URL . $article['image_url'] ?>"
                                     class="current-image"
                                     alt="Current image">
                            </div>
                        <?php endif; ?>

                        <input type="file" class="form-control" name="image" accept="image/*"
                               onchange="previewImage(this)">
                        <div class="help-text">
                            <?= !empty($article['image_url']) ? 'Chọn ảnh mới để thay đổi (bỏ trống nếu giữ nguyên). ' : '' ?>
                            Định dạng: JPG, PNG, GIF. Kích thước tối đa: 2MB
                        </div>
                        <img id="imagePreview" class="image-preview" alt="Preview">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Tóm tắt ngắn <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" name="summary" rows="3" required
                                  placeholder="Nhập tóm tắt ngắn gọn về bài viết..."><?= htmlspecialchars($article['summary'] ?? '') ?></textarea>
                        <div class="help-text">Tóm tắt hiển thị trong danh sách bài viết (khoảng 150-200 ký tự)</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Nội dung chi tiết <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" name="content" rows="12" required
                                  placeholder="Nhập nội dung chi tiết bài viết (hỗ trợ HTML)..."><?= htmlspecialchars($article['content'] ?? '') ?></textarea>
                        <div class="help-text">
                            Bạn có thể sử dụng HTML để định dạng nội dung.
                            Ví dụ: &lt;p&gt;, &lt;strong&gt;, &lt;em&gt;, &lt;ul&gt;, &lt;ol&gt;, &lt;h2&gt;, &lt;h3&gt;
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Lưu ý:</strong>
                        Bài viết được tạo lúc: <?= !empty($article['created_at']) ? date('d/m/Y H:i', strtotime($article['created_at'])) : 'N/A' ?>
                        <?php if (!empty($article['updated_at'])): ?>
                            | Cập nhật lần cuối: <?= date('d/m/Y H:i', strtotime($article['updated_at'])) ?>
                        <?php endif; ?>
                        | Lượt xem: <?= $article['views'] ?? 0 ?>
                    </div>
                </div>

                <div class="card-footer text-end">
                    <a href="<?= BASE_URL ?>admin/news" class="btn btn-link">
                        <i class="fas fa-times"></i> Hủy
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Lưu thay đổi
                    </button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.style.display = 'none';
        }
    }
</script>
