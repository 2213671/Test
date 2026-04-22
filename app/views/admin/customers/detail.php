<style>
    .admin-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .card-header {
        padding: 20px 25px;
        border-bottom: 1px solid #e0e0e0;
        background: #f8f9fa;
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

    .card-body {
        padding: 25px;
    }

    .customer-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
    }

    .customer-avatar-large {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 32px;
    }

    .customer-header-info h2 {
        margin: 0 0 5px 0;
        font-size: 24px;
        font-weight: 700;
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

    .badge.pending { background: #fef3c7; color: #92400e; }
    .badge.processing { background: #dbeafe; color: #1e40af; }
    .badge.completed { background: #d1fae5; color: #065f46; }
    .badge.cancelled { background: #fee2e2; color: #991b1b; }
    .badge.shipped { background: #e0e7ff; color: #3730a3; }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: #f9fafb;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
    }

    .stat-value {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 13px;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        color: #666;
        font-size: 14px;
    }

    .info-value {
        font-weight: 600;
        font-size: 14px;
        text-align: right;
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

    .btn-secondary {
        background: #64748b;
        color: white;
    }

    .btn-secondary:hover {
        background: #475569;
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
    }
</style>

<div class="card-header-actions">
    <h2 class="card-title">Chi tiết khách hàng</h2>
    <a href="<?= BASE_URL ?>admin/customers" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>
</div>

<!-- Thông tin khách hàng -->
<div class="admin-card">
    <div class="card-body">
        <div class="customer-header">
            <div class="customer-avatar-large">
                <?= strtoupper(substr($customer['fullname'], 0, 1)) ?>
            </div>
            <div class="customer-header-info">
                <h2><?= htmlspecialchars($customer['fullname']) ?></h2>
                <div>
                    <?php
                    $memberType = strtolower($customer['member_type'] ?? 'bronze');
                    $memberClass = match($memberType) {
                        'gold' => 'gold',
                        'silver' => 'silver',
                        'diamond' => 'diamond',
                        default => 'bronze'
                    };
                    $memberText = match($memberType) {
                        'gold' => 'Thành viên Vàng',
                        'silver' => 'Thành viên Bạc',
                        'diamond' => 'Thành viên Kim cương',
                        default => 'Thành viên Đồng'
                    };
                    ?>
                    <span class="badge <?= $memberClass ?>"><?= $memberText ?></span>
                </div>
            </div>
        </div>

        <!-- Thống kê -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-value" style="color: #3b82f6;"><?= $stats['total_orders'] ?? 0 ?></div>
                <div class="stat-label">Tổng đơn hàng</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" style="color: #10b981;"><?= $stats['completed_orders'] ?? 0 ?></div>
                <div class="stat-label">Đơn hoàn thành</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" style="color: #f59e0b;"><?= $stats['pending_orders'] ?? 0 ?></div>
                <div class="stat-label">Đơn chờ xử lý</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" style="color: #c92127;"><?= number_format($stats['total_spent'] ?? 0) ?>đ</div>
                <div class="stat-label">Tổng chi tiêu</div>
            </div>
        </div>

        <!-- Thông tin chi tiết -->
        <div class="info-grid">
            <div>
                <h3 style="font-size: 14px; font-weight: 600; color: #666; text-transform: uppercase; margin-bottom: 15px;">Thông tin liên hệ</h3>
                <div class="info-row">
                    <span class="info-label">Email:</span>
                    <span class="info-value"><?= htmlspecialchars($customer['email']) ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Số điện thoại:</span>
                    <span class="info-value"><?= htmlspecialchars($customer['phone'] ?? 'N/A') ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Địa chỉ:</span>
                    <span class="info-value"><?= htmlspecialchars($customer['note'] ?? 'N/A') ?></span>
                </div>
            </div>

            <div>
                <h3 style="font-size: 14px; font-weight: 600; color: #666; text-transform: uppercase; margin-bottom: 15px;">Thông tin tài khoản</h3>
                <div class="info-row">
                    <span class="info-label">ID:</span>
                    <span class="info-value">#<?= $customer['user_id'] ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Điểm tích lũy:</span>
                    <span class="info-value" style="color: #f59e0b;">In progress</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Ngày tham gia:</span>
                    <span class="info-value"><?= date('d/m/Y', strtotime($customer['created_date'])) ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Lịch sử đơn hàng -->
<div class="admin-card">
    <div class="card-header">
        <h3 class="card-title">Lịch sử đơn hàng</h3>
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Mã ĐH</th>
                    <th>Ngày đặt</th>
                    <th>Số sản phẩm</th>
                    <th>Tổng tiền</th>
                    <th>Phí ship</th>
                    <th>Thanh toán</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($orders)): ?>
                    <?php foreach($orders as $order): ?>
                    <tr>
                        <td class="fw-bold">#<?= $order['order_id'] ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($order['created_date'])) ?></td>
                        <td><?= $order['total_items'] ?? 0 ?> sản phẩm</td>
                        <td class="text-danger fw-bold"><?= number_format($order['total']) ?>đ</td>
                        <td><?= number_format($order['shipping_fee']) ?>đ</td>
                        <td>
                            <span class="badge" style="background: #e0e7ff; color: #3730a3;">
                                <?= htmlspecialchars($order['payment_method'] ?? 'N/A') ?>
                            </span>
                        </td>
                        <td>
                            <?php
                            $statusClass = match($order['status']) {
                                'pending' => 'pending',
                                'processing' => 'processing',
                                'shipped' => 'shipped',
                                'completed' => 'completed',
                                'cancelled' => 'cancelled',
                                default => 'pending'
                            };
                            $statusText = match($order['status']) {
                                'pending' => 'Chờ xử lý',
                                'processing' => 'Đang xử lý',
                                'shipped' => 'Đang giao',
                                'completed' => 'Hoàn thành',
                                'cancelled' => 'Đã hủy',
                                default => $order['status']
                            };
                            ?>
                            <span class="badge <?= $statusClass ?>"><?= $statusText ?></span>
                        </td>
                        <td>
                            <a href="<?= BASE_URL ?>admin/orderDetail/<?= $order['order_id'] ?>" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> Chi tiết
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">Khách hàng chưa có đơn hàng nào</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
