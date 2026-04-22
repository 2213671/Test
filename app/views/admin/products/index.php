

<style>
    .admin-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        overflow: hidden;
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

    .btn-sm {
        padding: 6px 12px;
        font-size: 13px;
    }

    .btn-danger {
        background: #ef4444;
        color: white;
    }

    .btn-danger:hover {
        background: #dc2626;
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
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }

    .bg-success {
        background: #10b981;
        color: white;
    }

    .bg-danger {
        background: #ef4444;
        color: white;
    }

    .bg-azure {
        background: #4299e1;
        color: white;
    }

    .bg-secondary {
        background: #94a3b8;
        color: white;
    }

    .text-danger {
        color: #c92127;
    }

    .text-decoration-line-through {
        text-decoration: line-through;
    }

    .text-muted {
        color: #94a3b8;
    }

    .fw-bold {
        font-weight: 600;
    }

    .rounded {
        border-radius: 6px;
    }

    .text-center {
        text-align: center;
    }
</style>

<div class="admin-card">
    <div class="card-header-actions">
        <h2 class="card-title">Danh sách sản phẩm</h2>
        <a href="<?= BASE_URL ?>admin/createProduct" class="btn btn-primary">
            <i class="fas fa-plus"></i> Thêm sản phẩm
        </a>
    </div>

    <!-- Search & Filter -->
    <div style="padding: 20px 25px; border-bottom: 1px solid #e0e0e0; background: #f9fafb;">
        <div style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 250px;">
                <input type="text"
                       id="searchProduct"
                       placeholder="🔍 Tìm kiếm theo ID, tên sản phẩm hoặc tác giả..."
                       style="width: 100%; padding: 10px 15px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
            </div>
            <div style="min-width: 180px;">
                <select id="filterCategory"
                        style="width: 100%; padding: 10px 15px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
                    <option value="">Tất cả danh mục</option>
                    <?php
                    $categories = [];
                    foreach($products as $p) {
                        if (!empty($p['category_name']) && !in_array($p['category_name'], $categories)) {
                            $categories[] = $p['category_name'];
                        }
                    }
                    foreach($categories as $cat):
                    ?>
                        <option value="<?= htmlspecialchars($cat) ?>"><?= htmlspecialchars($cat) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div style="min-width: 150px;">
                <select id="filterStock"
                        style="width: 100%; padding: 10px 15px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
                    <option value="">Tất cả tồn kho</option>
                    <option value="in-stock">Còn hàng</option>
                    <option value="out-of-stock">Hết hàng</option>
                </select>
            </div>
            <button onclick="resetFilters()"
                    style="padding: 10px 20px; background: #64748b; color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 14px;">
                <i class="fas fa-redo"></i> Reset
            </button>
        </div>
    </div>

    <div class="table-container">
        <table>
                    <thead>
                        <tr>
                            <th class="w-1">ID</th>
                            <th>Ảnh</th>
                            <th>Tên sách</th>
                            <th>Tác giả</th>
                            <th>Giá bán</th>
                            <th>Giá gốc</th>
                            <th>Tồn kho</th>
                            <th>Danh mục</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($products)): ?>
                            <?php foreach($products as $p): ?>
                            <tr>
                                <td><?= $p['product_id'] ?></td>
                                <td>
                                    <?php if (!empty($p['image_url'])): ?>
                                        <img src="<?= BASE_URL . $p['image_url'] ?>" class="rounded" style="width: 40px; height: 50px; object-fit: cover;">
                                    <?php else: ?>
                                        <img src="<?= BASE_URL ?>images/default-book.jpg" class="rounded" style="width: 40px; height: 50px; object-fit: cover;">
                                    <?php endif; ?>
                                </td>
                                <td class="fw-bold"><?= htmlspecialchars($p['title']) ?></td>
                                <td><?= htmlspecialchars($p['author'] ?? 'N/A') ?></td>
                                <td class="text-danger fw-bold"><?= number_format($p['price']) ?>đ</td>
                                <td class="text-decoration-line-through text-muted">
                                    <?= $p['old_price'] ? number_format($p['old_price']) . 'đ' : '-' ?>
                                </td>
                                <td>
                                    <span class="badge <?= $p['stock_quantity'] > 0 ? 'bg-success' : 'bg-danger' ?>">
                                        <?= $p['stock_quantity'] ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if (!empty($p['category_name'])): ?>
                                        <span class="badge bg-azure"><?= htmlspecialchars($p['category_name']) ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Chưa phân loại</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= BASE_URL ?>admin/editProduct/<?= $p['product_id'] ?>" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <a href="<?= BASE_URL ?>admin/deleteProduct?id=<?= $p['product_id'] ?>"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                        <i class="fas fa-trash"></i> Xóa
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if (empty($products)): ?>
                            <tr class="no-results-row">
                                <td colspan="9" class="text-center" style="padding: 40px;">Chưa có sản phẩm nào</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
        </table>
    </div>
</div>

<script>
// Search and Filter functionality
const searchInput = document.getElementById('searchProduct');
const categoryFilter = document.getElementById('filterCategory');
const stockFilter = document.getElementById('filterStock');
const tbody = document.querySelector('tbody');
const tableRows = Array.from(tbody.querySelectorAll('tr')).filter(row => !row.classList.contains('no-results-row'));

function filterProducts() {
    const searchTerm = searchInput.value.toLowerCase();
    const selectedCategory = categoryFilter.value.toLowerCase();
    const selectedStock = stockFilter.value;

    let visibleCount = 0;

    tableRows.forEach(row => {
        // Get row data
        const productId = row.cells[0]?.textContent.toLowerCase() || '';
        const title = row.cells[2]?.textContent.toLowerCase() || '';
        const author = row.cells[3]?.textContent.toLowerCase() || '';
        const category = row.cells[7]?.textContent.toLowerCase() || '';
        const stockBadge = row.cells[6]?.querySelector('.badge');
        const stockQuantity = stockBadge ? parseInt(stockBadge.textContent) : 0;

        // Check search term (ID, title or author)
        const matchesSearch = !searchTerm ||
                              productId.includes(searchTerm) ||
                              title.includes(searchTerm) ||
                              author.includes(searchTerm);

        // Check category filter
        const matchesCategory = !selectedCategory || category.includes(selectedCategory);

        // Check stock filter
        let matchesStock = true;
        if (selectedStock === 'in-stock') {
            matchesStock = stockQuantity > 0;
        } else if (selectedStock === 'out-of-stock') {
            matchesStock = stockQuantity === 0;
        }

        // Show/hide row
        if (matchesSearch && matchesCategory && matchesStock) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });

    // Update or create "no results" message
    let noResultsRow = tbody.querySelector('.no-results-row');

    if (visibleCount === 0) {
        // Create no results row only if it doesn't exist
        if (!noResultsRow) {
            noResultsRow = document.createElement('tr');
            noResultsRow.className = 'no-results-row';
            noResultsRow.innerHTML = '<td colspan="9" class="text-center" style="padding: 40px;">Không có kết quả phù hợp</td>';
            tbody.appendChild(noResultsRow);
        }
        noResultsRow.style.display = '';
    } else {
        // Hide no results row if it exists
        if (noResultsRow) {
            noResultsRow.style.display = 'none';
        }
    }
}

function resetFilters() {
    searchInput.value = '';
    categoryFilter.value = '';
    stockFilter.value = '';
    filterProducts();
}

// Add event listeners
searchInput.addEventListener('input', filterProducts);
categoryFilter.addEventListener('change', filterProducts);
stockFilter.addEventListener('change', filterProducts);
</script>
