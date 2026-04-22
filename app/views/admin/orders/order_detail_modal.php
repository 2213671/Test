<style>
    /* Modal Styles */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        z-index: 9998;
        animation: fadeIn 0.3s ease;
    }

    .modal-overlay.active {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .modal-container {
        background: white;
        border-radius: 16px;
        width: 90%;
        max-width: 900px;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        animation: slideUp 0.3s ease;
    }

    .modal-header {
        padding: 25px 30px;
        border-bottom: 2px solid #e0e0e0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: linear-gradient(135deg, #c92127 0%, #a01b20 100%);
        color: white;
        border-radius: 16px 16px 0 0;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .modal-header h3 {
        margin: 0;
        font-size: 24px;
        font-weight: 700;
    }

    .modal-close {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: white;
        font-size: 24px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }

    .modal-close:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(90deg);
    }

    .modal-body {
        padding: 30px;
    }

    .order-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .info-item {
        background: #f9fafb;
        padding: 15px 20px;
        border-radius: 10px;
        border-left: 4px solid #c92127;
    }

    .info-label {
        font-size: 12px;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
        font-weight: 600;
    }

    .info-value {
        font-size: 16px;
        font-weight: 600;
        color: #1f2937;
    }

    .order-items-section {
        margin-top: 30px;
    }

    .section-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 15px;
        color: #1f2937;
        padding-bottom: 10px;
        border-bottom: 2px solid #e0e0e0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .order-item-card {
        display: flex;
        gap: 20px;
        padding: 15px;
        background: #f9fafb;
        border-radius: 10px;
        margin-bottom: 15px;
        align-items: center;
        border: 1px solid #e0e0e0;
        transition: all 0.3s;
    }

    .order-item-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .item-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #e0e0e0;
        flex-shrink: 0;
    }

    .item-details {
        flex: 1;
    }

    .item-name {
        font-weight: 600;
        font-size: 15px;
        color: #1f2937;
        margin-bottom: 5px;
    }

    .item-meta {
        font-size: 13px;
        color: #666;
        margin-top: 5px;
    }

    .item-price {
        font-weight: 700;
        color: #c92127;
        font-size: 16px;
        text-align: right;
        flex-shrink: 0;
    }

    .order-summary {
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        padding: 25px;
        border-radius: 12px;
        margin-top: 30px;
        border: 2px solid #e0e0e0;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        font-size: 15px;
        align-items: center;
    }

    .summary-row .label {
        color: #666;
        font-weight: 500;
    }

    .summary-row .value {
        font-weight: 600;
        color: #1f2937;
    }

    .summary-row.total {
        border-top: 3px solid #c92127;
        margin-top: 15px;
        padding-top: 20px;
        font-size: 20px;
    }

    .summary-row.total .label {
        color: #1f2937;
        font-weight: 700;
    }

    .summary-row.total .value {
        color: #c92127;
        font-weight: 700;
        font-size: 24px;
    }

    .shipping-address {
        background: #f9fafb;
        padding: 20px;
        border-radius: 10px;
        margin-top: 20px;
        border-left: 4px solid #3b82f6;
    }

    .address-title {
        font-size: 14px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .address-content {
        color: #666;
        font-size: 14px;
        line-height: 1.6;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .loading-spinner {
        text-align: center;
        padding: 60px;
        color: #666;
    }

    .loading-spinner i {
        font-size: 48px;
        color: #c92127;
        animation: spin 1s linear infinite;
    }

    .loading-text {
        margin-top: 15px;
        font-size: 14px;
        color: #999;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .status-badge-large {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
    }
</style>

<!-- Order Detail Modal -->
<div id="orderDetailModal" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <h3><i class="fas fa-receipt"></i> Chi tiết đơn hàng</h3>
            <button class="modal-close" onclick="closeOrderDetailModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body" id="orderDetailContent">
            <div class="loading-spinner">
                <i class="fas fa-circle-notch"></i>
                <div class="loading-text">Đang tải thông tin đơn hàng...</div>
            </div>
        </div>
    </div>
</div>

<script>
// Modal Functions
function openOrderDetailModal(orderId) {
    const modal = document.getElementById('orderDetailModal');
    const content = document.getElementById('orderDetailContent');

    // Show modal with loading state
    modal.classList.add('active');
    content.innerHTML = `
        <div class="loading-spinner">
            <i class="fas fa-circle-notch"></i>
            <div class="loading-text">Đang tải thông tin đơn hàng...</div>
        </div>
    `;

    // Fetch order details (for now, show sample data)
    // TODO: Replace with actual AJAX call to fetch order details
    setTimeout(() => {
        loadOrderDetails(orderId);
    }, 500);
}

function closeOrderDetailModal() {
    const modal = document.getElementById('orderDetailModal');
    modal.classList.remove('active');
}

async function loadOrderDetails(orderId) {
    const content = document.getElementById('orderDetailContent');

    try {
        const response = await fetch(`<?= BASE_URL ?>admin/getOrderDetailAjax?order_id=${orderId}`);
        const result = await response.json();

        if (!result.success) {
            content.innerHTML = `
                <div style="text-align: center; padding: 40px; color: #ef4444;">
                    <i class="fas fa-exclamation-circle" style="font-size: 48px; margin-bottom: 15px;"></i>
                    <div>${result.message || 'Lỗi khi tải thông tin đơn hàng'}</div>
                </div>
            `;
            return;
        }

        const order = result.order;
        const items = result.items;

        // Format date
        const orderDate = new Date(order.created_date);
        const formattedDate = orderDate.toLocaleDateString('vi-VN');

        // Build items HTML
        let itemsHtml = '';
        items.forEach(item => {
            const imageUrl = item.image_url ? `<?= BASE_URL ?>${item.image_url}` : '<?= BASE_URL ?>public/images/default-book.jpg';
            itemsHtml += `
                <div class="order-item-card">
                    <img src="${imageUrl}" alt="${item.title}" class="item-image">
                    <div class="item-details">
                        <div class="item-name">${item.title}</div>
                        <div class="item-meta">
                            <span><i class="fas fa-shopping-cart"></i> Số lượng: ${item.quantity}</span> •
                            <span><i class="fas fa-tag"></i> Đơn giá: ${Number(item.price).toLocaleString('vi-VN')}đ</span>
                        </div>
                    </div>
                    <div class="item-price">${Number(item.subtotal).toLocaleString('vi-VN')}đ</div>
                </div>
            `;
        });

        content.innerHTML = `
            <div class="order-info-grid">
                <div class="info-item">
                    <div class="info-label"><i class="fas fa-hashtag"></i> Mã đơn hàng</div>
                    <div class="info-value">#${order.order_id}</div>
                </div>
                <div class="info-item">
                    <div class="info-label"><i class="fas fa-calendar"></i> Ngày đặt</div>
                    <div class="info-value">${formattedDate}</div>
                </div>
                <div class="info-item">
                    <div class="info-label"><i class="fas fa-user"></i> Người nhận</div>
                    <div class="info-value">${order.recipient_name}</div>
                </div>
                <div class="info-item">
                    <div class="info-label"><i class="fas fa-phone"></i> Số điện thoại</div>
                    <div class="info-value">${order.recipient_phone}</div>
                </div>
                <div class="info-item">
                    <div class="info-label"><i class="fas fa-credit-card"></i> Thanh toán</div>
                    <div class="info-value">${order.payment_method}</div>
                </div>
                <div class="info-item">
                    <div class="info-label"><i class="fas fa-info-circle"></i> Trạng thái</div>
                    <div class="info-value">
                        <span class="badge ${order.status} status-badge-large">${order.status_text}</span>
                    </div>
                </div>
            </div>

            <div class="shipping-address">
                <div class="address-title"><i class="fas fa-map-marker-alt"></i> Địa chỉ giao hàng</div>
                <div class="address-content">${order.shipping_address}</div>
            </div>

            ${order.note ? `
                <div class="shipping-address" style="border-left-color: #f59e0b; margin-top: 15px;">
                    <div class="address-title"><i class="fas fa-sticky-note"></i> Ghi chú</div>
                    <div class="address-content">${order.note}</div>
                </div>
            ` : ''}

            <div class="order-items-section">
                <div class="section-title">
                    <i class="fas fa-box"></i> Sản phẩm đã đặt
                </div>
                ${itemsHtml}
            </div>

            <div class="order-summary">
                <div class="summary-row">
                    <span class="label"><i class="fas fa-list"></i> Tạm tính:</span>
                    <span class="value">${Number(order.subtotal).toLocaleString('vi-VN')}đ</span>
                </div>
                <div class="summary-row">
                    <span class="label"><i class="fas fa-truck"></i> Phí vận chuyển:</span>
                    <span class="value">${Number(order.shipping_fee).toLocaleString('vi-VN')}đ</span>
                </div>
                <div class="summary-row total">
                    <span class="label"><i class="fas fa-receipt"></i> TỔNG CỘNG:</span>
                    <span class="value">${Number(order.total).toLocaleString('vi-VN')}đ</span>
                </div>
            </div>
        `;
    } catch (error) {
        console.error('Error loading order details:', error);
        content.innerHTML = `
            <div style="text-align: center; padding: 40px; color: #ef4444;">
                <i class="fas fa-exclamation-circle" style="font-size: 48px; margin-bottom: 15px;"></i>
                <div>Lỗi khi tải thông tin đơn hàng. Vui lòng thử lại!</div>
            </div>
        `;
    }
}

// Close modal when clicking outside
document.getElementById('orderDetailModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeOrderDetailModal();
    }
});

// Close modal with ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeOrderDetailModal();
    }
});
</script>
