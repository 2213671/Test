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

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .order-id {
        font-size: 24px;
        font-weight: 700;
        color: #c92127;
    }

    .badge {
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        display: inline-block;
    }

    .badge.pending { background: #fef3c7; color: #92400e; }
    .badge.processing { background: #dbeafe; color: #1e40af; }
    .badge.completed { background: #d1fae5; color: #065f46; }
    .badge.cancelled { background: #fee2e2; color: #991b1b; }
    .badge.shipped { background: #e0e7ff; color: #3730a3; }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
        margin-bottom: 30px;
    }

    .info-section {
        background: #f9fafb;
        padding: 20px;
        border-radius: 8px;
    }

    .info-section h3 {
        font-size: 14px;
        font-weight: 600;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 15px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
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

    .product-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .product-img {
        width: 60px;
        height: 75px;
        object-fit: cover;
        border-radius: 4px;
    }

    .product-name {
        font-weight: 500;
        font-size: 14px;
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

    .btn-primary {
        background: #c92127;
        color: white;
    }

    .btn-primary:hover {
        background: #a01b20;
    }

    .btn-success {
        background: #10b981;
        color: white;
    }

    .btn-success:hover {
        background: #059669;
    }

    .btn-warning {
        background: #f59e0b;
        color: white;
    }

    .btn-warning:hover {
        background: #d97706;
    }

    .btn-danger {
        background: #ef4444;
        color: white;
    }

    .btn-danger:hover {
        background: #dc2626;
    }

    .status-actions {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }

    .order-summary {
        background: #f9fafb;
        padding: 20px;
        border-radius: 8px;
        margin-top: 20px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        font-size: 14px;
    }

    .summary-row.total {
        border-top: 2px solid #e0e0e0;
        margin-top: 10px;
        padding-top: 15px;
        font-size: 18px;
        font-weight: 700;
        color: #c92127;
    }

    .text-muted {
        color: #94a3b8;
    }
</style>

<div class="card-header-actions">
    <h2 class="card-title">Chi tiết đơn hàng #<?= $order['order_id'] ?></h2>
    <a href="<?= BASE_URL ?>admin/orders" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>
</div>

<div class="admin-card">
    <div class="card-body">
        <div class="order-header">
            <div class="order-id">Đơn hàng #<?= $order['order_id'] ?></div>
            <div>
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
            </div>
        </div>

        <div class="info-grid">
            <!-- Thông tin khách hàng -->
            <div class="info-section">
                <h3>Thông tin khách hàng</h3>
                <div class="info-row">
                    <span class="info-label">Họ tên:</span>
                    <span class="info-value"><?= htmlspecialchars($order['recipient_name'] ?? 'N/A') ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Số điện thoại:</span>
                    <span class="info-value"><?= htmlspecialchars($order['recipient_phone'] ?? 'N/A') ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Địa chỉ:</span>
                    <span class="info-value"><?= htmlspecialchars($order['shipping_address'] ?? 'N/A') ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Ghi chú: </span>
                    <span class="info-value"><?= htmlspecialchars($order['note'] ?? 'N/A') ?></span>
                </div>
            </div>

            <!-- Thông tin đơn hàng -->
            <div class="info-section">
                <h3>Thông tin đơn hàng</h3>
                <div class="info-row">
                    <span class="info-label">Ngày đặt:</span>
                    <span class="info-value"><?= date('d/m/Y H:i', strtotime($order['created_date'])) ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Phương thức thanh toán:</span>
                    <span class="info-value"><?= htmlspecialchars($order['payment_method'] ?? 'N/A') ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Điểm sử dụng:</span>
                    <span class="info-value">In progress</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Điểm tích lũy:</span>
                    <span class="info-value">In Progress</span>
                </div>
            </div>
        </div>

        <?php if (!empty($order['note'])): ?>
        <div class="info-section">
            <h3>Ghi chú</h3>
            <p style="margin: 0; padding: 10px 0;"><?= nl2br(htmlspecialchars($order['note'])) ?></p>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Danh sách sản phẩm -->
<div class="admin-card">
    <div class="card-header">
        <h3 class="card-title">Sản phẩm trong đơn hàng</h3>
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($items)): ?>
                    <?php
                    $subtotal = 0;
                    foreach($items as $item):
                        $subtotal += $item['subtotal'];
                    ?>
                    <tr>
                        <td>
                            <div class="product-info">
                                <img src="<?= BASE_URL . ($item['image_url'] ?? 'images/default-book.jpg') ?>"
                                     alt="<?= htmlspecialchars($item['title']) ?>"
                                     class="product-img">
                                <div class="product-name"><?= htmlspecialchars($item['title']) ?></div>
                            </div>
                        </td>
                        <td><?= number_format($item['price']) ?>đ</td>
                        <td><?= $item['quantity'] ?></td>
                        <td style="font-weight: 600;"><?= number_format($item['subtotal']) ?>đ</td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align: center;">Không có sản phẩm</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if (!empty($items)): ?>
    <div class="order-summary">
        <div class="summary-row">
            <span>Tạm tính:</span>
            <span><?= number_format($subtotal) ?>đ</span>
        </div>
        <div class="summary-row">
            <span>Phí vận chuyển:</span>
            <span><?= number_format($order['shipping_fee']) ?>đ</span>
        </div>
        <div class="summary-row total">
            <span>Tổng cộng:</span>
            <span><?= number_format($order['total']) ?>đ</span>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Cập nhật trạng thái -->
<div class="admin-card">
    <div class="card-body">
        <h3 style="margin-bottom: 20px;">Cập nhật trạng thái đơn hàng</h3>
        <form action="<?= BASE_URL ?>admin/updateOrderStatus" method="POST">
            <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
            <input type="hidden" name="return_to_detail" value="1">

            <div class="status-actions">
                <?php if ($order['status'] == 'pending'): ?>
                    <button type="submit" name="status" value="processing" class="btn btn-primary">
                        <i class="fas fa-check"></i> Xác nhận đơn hàng
                    </button>
                    <button type="submit" name="status" value="cancelled" class="btn btn-danger">
                        <i class="fas fa-times"></i> Hủy đơn hàng
                    </button>
                <?php elseif ($order['status'] == 'processing'): ?>
                    <button type="submit" name="status" value="shipped" class="btn btn-warning">
                        <i class="fas fa-shipping-fast"></i> Giao cho đơn vị vận chuyển
                    </button>
                    <button type="submit" name="status" value="cancelled" class="btn btn-danger">
                        <i class="fas fa-times"></i> Hủy đơn hàng
                    </button>
                <?php elseif ($order['status'] == 'shipped'): ?>
                    <button type="submit" name="status" value="completed" class="btn btn-success">
                        <i class="fas fa-check-circle"></i> Hoàn thành đơn hàng
                    </button>
                <?php elseif ($order['status'] == 'completed'): ?>
                    <div style="color: #10b981; font-weight: 600;">
                        <i class="fas fa-check-circle"></i> Đơn hàng đã hoàn thành
                    </div>
                <?php elseif ($order['status'] == 'cancelled'): ?>
                    <div style="color: #ef4444; font-weight: 600;">
                        <i class="fas fa-times-circle"></i> Đơn hàng đã bị hủy
                    </div>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>
