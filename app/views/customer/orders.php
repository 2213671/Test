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
    
    .order-filters {
        display: flex;
        gap: 10px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }
    
    .filter-btn {
        padding: 10px 20px;
        border: 1px solid #ddd;
        background: white;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s;
        font-weight: 500;
    }
    
    .filter-btn:hover {
        border-color: var(--fahasa-orange);
        color: var(--fahasa-orange);
    }
    
    .filter-btn.active {
        background-color: var(--fahasa-red);
        color: white;
        border-color: var(--fahasa-red);
    }
    
    .order-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-bottom: 20px;
        overflow: hidden;
        transition: box-shadow 0.3s;
    }
    
    .order-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .order-header {
        background-color: var(--fahasa-light-gray);
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .order-id {
        font-weight: 600;
        color: var(--fahasa-dark);
    }
    
    .order-status {
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 500;
    }
    
    .status-completed {
        background-color: #d4edda;
        color: #155724;
    }
    
    .status-shipping {
        background-color: #d1ecf1;
        color: #0c5460;
    }
    
    .status-processing {
        background-color: #fff3cd;
        color: #856404;
    }
    
    .status-cancelled {
        background-color: #f8d7da;
        color: #721c24;
    }
    
    .order-body {
        padding: 20px;
    }
    
    .order-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid var(--fahasa-light-gray);
    }

    .order-item:last-child {
        border-bottom: none;
    }

    .order-item-image {
        width: 70px;
        height: 100px;
        flex-shrink: 0;
        background-color: #f5f5f5;
        border-radius: 6px;
        display: block;
        overflow: hidden;
        border: 1px solid #e0e0e0;
        text-decoration: none;
        transition: all 0.3s;
    }

    .order-item-image:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .order-item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .order-item-info {
        flex: 1;
        min-width: 0;
    }

    .order-item-name {
        font-weight: 600;
        font-size: 15px;
        color: var(--fahasa-dark);
        margin-bottom: 8px;
        text-decoration: none;
        display: block;
        transition: color 0.3s;
        line-height: 1.4;
    }

    .order-item-name:hover {
        color: var(--fahasa-red);
    }

    .order-item-qty {
        color: var(--fahasa-gray);
        font-size: 14px;
    }

    .order-item-price {
        font-weight: 700;
        font-size: 16px;
        color: var(--fahasa-gray);
        text-align: right;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .order-summary-inline {
        margin-top: 20px;
        padding-top: 15px;
        border-top: 2px solid var(--fahasa-light-gray);
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        /* gap: 8px; */
        
        border-top: 2px solid var(--fahasa-red);
    }

    .order-summary-inline .summary-row {
        display: flex;
        justify-content: space-between;
        gap: 40px;
        font-size: 0.95rem;
    }

    .order-summary-inline .summary-label {
        color: var(--fahasa-gray);
    }

    .order-summary-inline .summary-value {
        font-weight: 600;
        color: var(--fahasa-dark);
    }

    .order-summary-inline .summary-total {
        margin-top: 8px;
        padding-top: 8px;
    }

    .order-summary-inline .summary-total .summary-label {
        font-weight: 700;
        color: var(--fahasa-dark);
        font-size: 1.1rem;
    }

    .order-summary-inline .summary-total .summary-value {
        font-weight: 700;
        color: var(--fahasa-red);
        font-size: 1.3rem;
    }

    .order-footer {
        padding: 15px 20px;
        background-color: #fafafa;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .order-info-text {
        color: var(--fahasa-gray);
        font-size: 0.95rem;
    }

    .order-info-text i {
        margin-right: 5px;
    }

    .btn-order {
        padding: 10px 24px;
        border-radius: 6px;
        border: none;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-cancel {
        background-color: #ef4444;
        color: white;
    }

    .btn-cancel:hover {
        background-color: #dc2626;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(239, 68, 68, 0.3);
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }
    
    .empty-state i {
        font-size: 4rem;
        color: var(--fahasa-gray);
        margin-bottom: 20px;
    }
    
    .empty-state h4 {
        color: var(--fahasa-dark);
        margin-bottom: 10px;
    }
    
    .empty-state p {
        color: var(--fahasa-gray);
    }
    
    @media (max-width: 767.98px) {
        .order-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .order-item {
            flex-wrap: wrap;
        }

        .order-item-image {
            width: 60px;
            height: 85px;
        }

        .order-item-info {
            flex: 1 1 100%;
            order: 2;
        }

        .order-item-price {
            text-align: right;
            order: 1;
            margin-left: auto;
        }

        .order-summary-inline {
            align-items: stretch;
        }

        .order-summary-inline .summary-row {
            justify-content: space-between;
        }

        .order-footer {
            flex-direction: column;
            align-items: stretch;
            gap: 10px;
        }

        .btn-order {
            width: 100%;
            justify-content: center;
        }
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
                        <i class="fas fa-box"></i>
                        Đơn hàng của tôi
                    </h2>
                    
                    <!-- Order Filters -->
                    <div class="order-filters">
                        <button class="filter-btn active" data-status="all">
                            <i class="fas fa-list me-2"></i>Tất cả
                        </button>
                        <button class="filter-btn" data-status="processing">
                            <i class="fas fa-clock me-2"></i>Đang xử lý
                        </button>
                        <button class="filter-btn" data-status="shipping">
                            <i class="fas fa-shipping-fast me-2"></i>Đang giao
                        </button>
                        <button class="filter-btn" data-status="completed">
                            <i class="fas fa-check-circle me-2"></i>Hoàn thành
                        </button>
                        <button class="filter-btn" data-status="cancelled">
                            <i class="fas fa-times-circle me-2"></i>Đã hủy
                        </button>
                    </div>
                    
                    <!-- Orders List -->
                    <div class="orders-list">
                        <?php if (!empty($orders)): ?>
                            <?php foreach ($orders as $order): ?>
                                <div class="order-card" data-status="<?= $order['status'] ?>">
                                    <!-- Order Header -->
                                    <div class="order-header">
                                        <div>
                                            <span class="order-id">
                                                <i class="fas fa-hashtag"></i>
                                                <?= htmlspecialchars($order['order_id']) ?>
                                            </span>
                                            <span class="text-muted ms-3">
                                                <i class="far fa-calendar-alt"></i>
                                                <?= date('d/m/Y', strtotime($order['order_date'])) ?>
                                            </span>
                                        </div>
                                        <span class="order-status status-<?= $order['status'] ?>">
                                            <?= htmlspecialchars($order['status_text']) ?>
                                        </span>
                                    </div>
                                    
                                    <!-- Order Body -->
                                    <div class="order-body">
                                        <?php foreach ($order['items'] as $item): ?>
                                            <div class="order-item">
                                                <a href="<?= BASE_URL ?>product/detail/<?= $item['product_id'] ?>" class="order-item-image">
                                                    <img src="<?= BASE_URL . $item['image'] ?>" alt="<?= htmlspecialchars($item['product_name']) ?>">
                                                </a>
                                                <div class="order-item-info">
                                                    <a href="<?= BASE_URL ?>product/detail/<?= $item['product_id'] ?>" class="order-item-name">
                                                        <?= htmlspecialchars($item['product_name']) ?>
                                                    </a>
                                                    <div class="order-item-qty">
                                                        Số lượng: <?= $item['quantity'] ?>
                                                    </div>
                                                </div>
                                                <div class="order-item-price">
                                                    <?= number_format($item['subtotal']) ?>đ
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                        <!-- Order Summary (dọc bên phải) -->
                                        <div class="order-summary-inline">
                                            <div class="summary-row summary-total">
                                                <span class="summary-label">Tổng cộng:</span>
                                                <span class="summary-value"><?= number_format($order['total']) ?>đ</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Order Footer -->
                                    <div class="order-footer">
                                        <div class="order-info-text">
                                            <i class="fas fa-info-circle"></i>
                                            <span>Đơn hàng #<?= $order['order_id'] ?></span>
                                        </div>
                                        <?php if (in_array($order['status'], ['pending', 'processing'])): ?>
                                            <button class="btn-order btn-cancel" onclick="confirmCancelOrder(<?= $order['order_id'] ?>)">
                                                <i class="fas fa-times-circle"></i> Hủy đơn hàng
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="empty-state">
                                <i class="fas fa-box-open"></i>
                                <h4>Chưa có đơn hàng nào</h4>
                                <p>Bạn chưa có đơn hàng nào. Hãy khám phá và mua sắm ngay!</p>
                                <a href="<?= BASE_URL ?>product" class="btn btn-order btn-reorder mt-3">
                                    <i class="fas fa-shopping-cart me-2"></i>Mua sắm ngay
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Filter orders by status
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        // Update active button
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        const status = this.dataset.status;
        const orders = document.querySelectorAll('.order-card');

        orders.forEach(order => {
            if (status === 'all' || order.dataset.status === status) {
                order.style.display = 'block';
            } else {
                order.style.display = 'none';
            }
        });
    });
});

// Confirm cancel order
async function confirmCancelOrder(orderId) {
    if (!confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')) {
        return;
    }

    try {
        const formData = new FormData();
        formData.append('order_id', orderId);

        const response = await fetch('<?= BASE_URL ?>order/cancelOrder', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (result.success) {
            alert(result.message || 'Đã hủy đơn hàng thành công!');
            location.reload(); // Reload page để cập nhật trạng thái
        } else {
            alert(result.message || 'Không thể hủy đơn hàng!');
        }
    } catch (error) {
        console.error('Error canceling order:', error);
        alert('Lỗi khi hủy đơn hàng. Vui lòng thử lại!');
    }
}
</script>

<?php require_once APP_ROOT . '/views/components/footer.php'; ?>
