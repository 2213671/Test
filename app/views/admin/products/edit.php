<style>
    .admin-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        padding: 30px;
    }
    .card-header-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e0e0e0;
    }
    .card-title {
        font-size: 22px;
        font-weight: 600;
        margin: 0;
    }
    .btn {
        padding: 10px 20px;
        border-radius: 8px;
        border: none;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-primary {
        background: #c92127;
        color: white;
    }
    .btn-primary:hover {
        background: #a01b20;
    }
    .btn-secondary {
        background: #64748b;
        color: white;
    }
    .btn-secondary:hover {
        background: #475569;
    }
    .row {
        display: flex;
        gap: 30px;
        margin-bottom: 20px;
    }
    .col-md-8 {
        flex: 2;
    }
    .col-md-4, .col-md-6 {
        flex: 1;
    }
    .mb-3 {
        margin-bottom: 20px;
    }
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        font-size: 14px;
        color: #334155;
    }
    .form-label.required::after {
        content: ' *';
        color: #ef4444;
    }
    .form-control, .form-select {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s;
    }
    .form-control:focus, .form-select:focus {
        outline: none;
        border-color: #c92127;
        box-shadow: 0 0 0 3px rgba(201, 33, 39, 0.1);
    }
    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }
    .form-hint {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 4px;
        display: block;
    }
    .img-thumbnail {
        border: 2px dashed #e2e8f0;
        padding: 10px;
        border-radius: 8px;
        max-width: 100%;
    }
    .text-end {
        text-align: right;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #e0e0e0;
    }
</style>

<div class="card-header-actions">
    <h2 class="card-title">Sửa sản phẩm: <?= htmlspecialchars($product['title']) ?></h2>
    <a href="<?= BASE_URL ?>admin/products" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>
</div>

<div class="admin-card">
                <form action="<?= BASE_URL ?>admin/editProduct/<?= $product['product_id'] ?>" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Cột trái: Thông tin cơ bản -->
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label required">Tên sách</label>
                                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($product['title']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mô tả</label>
                                <textarea name="description" class="form-control" rows="5"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tác giả</label>
                                    <input type="text" name="author" class="form-control" value="<?= htmlspecialchars($product['author'] ?? '') ?>">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nhà xuất bản</label>
                                    <input type="text" name="publisher" class="form-control" value="<?= htmlspecialchars($product['publisher'] ?? '') ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label required">Giá bán</label>
                                    <input type="number" name="price" class="form-control" value="<?= $product['price'] ?>" required min="0" step="1000">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Giá gốc</label>
                                    <input type="number" name="old_price" class="form-control" value="<?= $product['old_price'] ?? '' ?>" min="0" step="1000">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label required">Số lượng</label>
                                    <input type="number" name="stock_quantity" class="form-control" value="<?= $product['stock_quantity'] ?>" required min="0">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Ngày xuất bản</label>
                                    <input type="date" name="published_date" class="form-control" value="<?= $product['published_date'] ?? '' ?>">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Năm</label>
                                    <input type="number" name="year" class="form-control" value="<?= $product['year'] ?? '' ?>" min="1900" max="2100">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Số trang</label>
                                    <input type="number" name="pages" class="form-control" value="<?= $product['pages'] ?? '' ?>" min="1">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Ngôn ngữ</label>
                                    <input type="text" name="language" class="form-control" value="<?= htmlspecialchars($product['language'] ?? '') ?>">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nhà cung cấp</label>
                                    <input type="text" name="supplier" class="form-control" value="<?= htmlspecialchars($product['supplier'] ?? '') ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Loại sản phẩm</label>
                                    <input type="text" name="product_type" class="form-control" value="<?= htmlspecialchars($product['product_type'] ?? '') ?>">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Kích thước</label>
                                    <input type="text" name="dimensions" class="form-control" value="<?= htmlspecialchars($product['dimensions'] ?? '') ?>">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Khối lượng (gram)</label>
                                    <input type="number" name="weight" class="form-control" value="<?= $product['weight'] ?? '' ?>" min="0" step="0.01">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kích cỡ (size)</label>
                                <input type="text" name="size" class="form-control" value="<?= htmlspecialchars($product['size'] ?? '') ?>">
                            </div>
                        </div>

                        <!-- Cột phải: Ảnh và danh mục -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Danh mục</label>
                                <select name="category_id" class="form-select">
                                    <option value="">-- Chọn danh mục --</option>
                                    <?php if (!empty($categories)): ?>
                                        <?php foreach($categories as $cat): ?>
                                            <option value="<?= $cat['category_id'] ?>"
                                                <?= ($cat['category_id'] == ($product['category_id'] ?? '')) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($cat['category_name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ảnh sản phẩm</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                <small class="form-hint">Để trống nếu không muốn thay đổi ảnh</small>
                            </div>

                            <div class="mb-3">
                                <img id="preview"
                                     src="<?= !empty($product['image_url']) ? BASE_URL . $product['image_url'] : BASE_URL . 'images/default-book.jpg' ?>"
                                     class="img-thumbnail" style="max-width: 100%; height: auto;">
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Cập nhật sản phẩm
                        </button>
                    </div>
                </form>
</div>

<script>
// Preview ảnh khi chọn file
document.querySelector('input[name="image"]').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});
</script>