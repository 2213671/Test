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

    .badge.gold { background: #fef3c7; color: #92400e; }
    .badge.silver { background: #e5e7eb; color: #374151; }
    .badge.diamond { background: #dbeafe; color: #1e40af; }
    .badge.bronze { background: #fed7aa; color: #9a3412; }

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

    .btn-sm {
        padding: 6px 12px;
        font-size: 12px;
    }

    .btn-info {
        background: #3b82f6;
        color: white;
    }

    .btn-info:hover {
        background: #2563eb;
    }

    .btn-danger {
        background: #ef4444;
        color: white;
    }

    .btn-danger:hover {
        background: #dc2626;
    }

    .text-danger {
        color: #c92127;
    }

    .fw-bold {
        font-weight: 600;
    }

    .text-center {
        text-align: center;
    }

    .text-muted {
        color: #94a3b8;
        font-size: 13px;
    }

    .customer-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 16px;
    }

    .customer-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }
</style>

<div class="admin-card">
    <div class="card-header-actions">
        <h2 class="card-title">Danh sách khách hàng</h2>
    </div>

    <!-- Search & Filter -->
    <div style="padding: 20px 25px; border-bottom: 1px solid #e0e0e0; background: #f9fafb;">
        <div style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 250px;">
                <input type="text"
                       id="searchCustomer"
                       placeholder="🔍 Tìm kiếm theo ID, tên, email hoặc SĐT..."
                       style="width: 100%; padding: 10px 15px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
            </div>
            <button onclick="resetCustomerFilters()"
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
                    <th>Khách hàng</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Tổng đơn hàng</th>
                    <th>Tổng chi tiêu</th>
                    <th>Ngày tham gia</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($customers)): ?>
                    <?php foreach($customers as $customer): ?>
                    <tr>
                        <td class="fw-bold"><?= $customer['user_id'] ?></td>
                        <td>
                            <div class="customer-info">
                                <div>
                                    <div class="fw-bold"><?= htmlspecialchars($customer['fullname']) ?></div>
                                </div>
                            </div>
                        </td>
                        <td><?= htmlspecialchars($customer['email']) ?></td>
                        <td><?= htmlspecialchars($customer['phone'] ?? 'N/A') ?></td>
                        <td><?= $customer['total_orders'] ?? 0 ?> đơn</td>
                        <td class="text-danger fw-bold">
                            <?= number_format($customer['total_spent'] ?? 0) ?>đ
                        </td>
                        <td><?= $customer['created_date'] ? date('d/m/Y', strtotime($customer['created_date'])) : 'N/A' ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>admin/customerDetail/<?= $customer['user_id'] ?>"
                               class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> 
                            </a>
                            <!-- <a href="<?= BASE_URL ?>admin/deleteCustomer?id=<?= $customer['user_id'] ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Bạn có chắc muốn xóa khách hàng này? Tất cả đơn hàng liên quan sẽ bị ảnh hưởng!')">
                                <i class="fas fa-trash"></i> Xóa
                            </a> -->
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if (empty($customers)): ?>
                    <tr class="no-results-row">
                        <td colspan="10" class="text-center" style="padding: 40px;">Chưa có khách hàng nào</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
// Search and Filter functionality for Customers
const searchCustomerInput = document.getElementById('searchCustomer');
const memberTypeFilter = document.getElementById('filterMemberType');
const tbody = document.querySelector('tbody');
const customerRows = Array.from(tbody.querySelectorAll('tr')).filter(row => !row.classList.contains('no-results-row'));

function filterCustomers() {
    const searchTerm = searchCustomerInput.value.toLowerCase();
    const selectedMemberType = memberTypeFilter.value.toLowerCase();

    let visibleCount = 0;

    customerRows.forEach(row => {
        // Get row data
        const customerId = row.cells[0]?.textContent.toLowerCase() || '';
        const customerName = row.cells[1]?.textContent.toLowerCase() || '';
        const email = row.cells[2]?.textContent.toLowerCase() || '';
        const phone = row.cells[3]?.textContent.toLowerCase() || '';
        const memberTypeBadge = row.cells[4]?.querySelector('.badge');
        const memberTypeClass = memberTypeBadge?.classList[1] || '';

        // Check search term (ID, name, email, or phone)
        const matchesSearch = !searchTerm ||
                              customerId.includes(searchTerm) ||
                              customerName.includes(searchTerm) ||
                              email.includes(searchTerm) ||
                              phone.includes(searchTerm);

        // Check member type filter
        const matchesMemberType = !selectedMemberType || memberTypeClass === selectedMemberType;

        // Show/hide row
        if (matchesSearch && matchesMemberType) {
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
            noResultsRow.innerHTML = '<td colspan="10" class="text-center" style="padding: 40px;">Không có kết quả phù hợp</td>';
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

function resetCustomerFilters() {
    searchCustomerInput.value = '';
    memberTypeFilter.value = '';
    filterCustomers();
}

// Add event listeners
searchCustomerInput.addEventListener('input', filterCustomers);
memberTypeFilter.addEventListener('change', filterCustomers);
</script>
