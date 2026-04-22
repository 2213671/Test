<style>
    .admin-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        overflow: hidden;
        margin-bottom: 30px;
    }

    .card-header-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 25px;
        border-bottom: 1px solid #e0e0e0;
    }

    .card-title {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
    }

    .table-container {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background: #f8f9fa;
    }

    th {
        padding: 15px;
        text-align: left;
        font-weight: 600;
        font-size: 13px;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e0e0e0;
    }

    td {
        padding: 15px;
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
    }

    tbody tr:hover {
        background: #f9fafb;
    }

    .badge {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }

    .badge.primary { background: #dbeafe; color: #1e40af; }

    .btn {
        padding: 8px 16px;
        border-radius: 8px;
        border: none;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
    }

    .btn-primary {
        background: #c92127;
        color: white;
    }

    .btn-primary:hover {
        background: #a01b20;
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 12px;
    }

    .btn-success {
        background: #10b981;
        color: white;
    }

    .btn-success:hover {
        background: #059669;
    }

    .btn-danger {
        background: #ef4444;
        color: white;
    }

    .btn-danger:hover {
        background: #dc2626;
    }

    .btn-secondary {
        background: #64748b;
        color: white;
    }

    .btn-secondary:hover {
        background: #475569;
    }

    .fw-bold {
        font-weight: 600;
    }

    .text-center {
        text-align: center;
    }

    .text-muted {
        color: #94a3b8;
    }

    /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        animation: fadeIn 0.3s;
    }

    .modal.active {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background: white;
        padding: 30px;
        border-radius: 12px;
        width: 90%;
        max-width: 500px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        animation: slideUp 0.3s;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from { transform: translateY(30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .modal-header h3 {
        margin: 0;
        font-size: 20px;
        font-weight: 600;
    }

    .close-btn {
        background: none;
        border: none;
        font-size: 24px;
        color: #94a3b8;
        cursor: pointer;
        padding: 0;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .close-btn:hover {
        color: #475569;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        font-size: 14px;
        color: #374151;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 14px;
        font-family: inherit;
    }

    .form-group textarea {
        resize: vertical;
        min-height: 80px;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #c92127;
    }

    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 25px;
    }
</style>

<div class="admin-card">
    <div class="card-header-actions">
        <h2 class="card-title">Danh sách danh mục sản phẩm</h2>
        <button onclick="openCreateModal()" class="btn btn-primary">
            <i class="fas fa-plus"></i> Thêm danh mục
        </button>
    </div>

    <!-- Search -->
    <div style="padding: 20px 25px; border-bottom: 1px solid #e0e0e0; background: #f9fafb;">
        <div style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 250px;">
                <input type="text"
                       id="searchCategory"
                       placeholder="🔍 Tìm kiếm theo ID hoặc tên danh mục..."
                       style="width: 100%; padding: 10px 15px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
            </div>
            <button onclick="resetCategoryFilters()"
                    style="padding: 10px 20px; background: #64748b; color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 14px;">
                <i class="fas fa-redo"></i> Reset
            </button>
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>
                    <th>Số sản phẩm</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($categories)): ?>
                    <?php foreach($categories as $cat): ?>
                    <tr>
                        <td class="fw-bold"><?= $cat['category_id'] ?></td>
                        <td class="fw-bold"><?= htmlspecialchars($cat['category_name']) ?></td>
                        <td class="text-muted"><?= htmlspecialchars($cat['description'] ?? 'Chưa có mô tả') ?></td>
                        <td>
                            <span class="badge primary"><?= $cat['total_products'] ?? 0 ?> sản phẩm</span>
                        </td>
                        <td>
                            <button onclick='openEditModal(<?= json_encode($cat) ?>)' class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Sửa
                            </button>
                            <a href="<?= BASE_URL ?>admin/deleteCategory?id=<?= $cat['category_id'] ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Bạn có chắc muốn xóa danh mục này? Các sản phẩm thuộc danh mục sẽ bị ảnh hưởng!')">
                                <i class="fas fa-trash"></i> Xóa
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if (empty($categories)): ?>
                    <tr class="no-results-row">
                        <td colspan="5" class="text-center" style="padding: 40px;">Chưa có danh mục nào</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Create/Edit Modal -->
<div id="categoryModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle">Thêm danh mục mới</h3>
            <button class="close-btn" onclick="closeModal()">&times;</button>
        </div>
        <form id="categoryForm" method="POST">
            <input type="hidden" name="category_id" id="category_id">

            <div class="form-group">
                <label for="category_name">Tên danh mục <span style="color: #ef4444;">*</span></label>
                <input type="text" name="category_name" id="category_name" required placeholder="Nhập tên danh mục">
            </div>

            <div class="form-group">
                <label for="description">Mô tả</label>
                <textarea name="description" id="description" placeholder="Nhập mô tả cho danh mục (tùy chọn)"></textarea>
            </div>

            <div class="modal-actions">
                <button type="button" onclick="closeModal()" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Hủy
                </button>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Lưu
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Search functionality
const searchInput = document.getElementById('searchCategory');
const tbody = document.querySelector('tbody');
const categoryRows = Array.from(tbody.querySelectorAll('tr')).filter(row => !row.classList.contains('no-results-row'));

function filterCategories() {
    const searchTerm = searchInput.value.toLowerCase();
    let visibleCount = 0;

    categoryRows.forEach(row => {
        const categoryId = row.cells[0]?.textContent.toLowerCase() || '';
        const categoryName = row.cells[1]?.textContent.toLowerCase() || '';
        const description = row.cells[2]?.textContent.toLowerCase() || '';

        const matchesSearch = !searchTerm ||
                              categoryId.includes(searchTerm) ||
                              categoryName.includes(searchTerm) ||
                              description.includes(searchTerm);

        if (matchesSearch) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });

    let noResultsRow = tbody.querySelector('.no-results-row');

    if (visibleCount === 0) {
        if (!noResultsRow) {
            noResultsRow = document.createElement('tr');
            noResultsRow.className = 'no-results-row';
            noResultsRow.innerHTML = '<td colspan="5" class="text-center" style="padding: 40px;">Không có kết quả phù hợp</td>';
            tbody.appendChild(noResultsRow);
        }
        noResultsRow.style.display = '';
    } else {
        if (noResultsRow) {
            noResultsRow.style.display = 'none';
        }
    }
}

function resetCategoryFilters() {
    searchInput.value = '';
    filterCategories();
}

searchInput.addEventListener('input', filterCategories);

// Modal functions
const modal = document.getElementById('categoryModal');
const modalTitle = document.getElementById('modalTitle');
const categoryForm = document.getElementById('categoryForm');

function openCreateModal() {
    modalTitle.textContent = 'Thêm danh mục mới';
    categoryForm.action = '<?= BASE_URL ?>admin/createCategory';
    document.getElementById('category_id').value = '';
    document.getElementById('category_name').value = '';
    document.getElementById('description').value = '';
    modal.classList.add('active');
}

function openEditModal(category) {
    modalTitle.textContent = 'Sửa danh mục';
    categoryForm.action = '<?= BASE_URL ?>admin/updateCategory';
    document.getElementById('category_id').value = category.category_id;
    document.getElementById('category_name').value = category.category_name;
    document.getElementById('description').value = category.description || '';
    modal.classList.add('active');
}

function closeModal() {
    modal.classList.remove('active');
}

// Close modal when clicking outside
modal.addEventListener('click', function(e) {
    if (e.target === modal) {
        closeModal();
    }
});

// Close modal on ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && modal.classList.contains('active')) {
        closeModal();
    }
});
</script>
