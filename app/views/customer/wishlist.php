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
    
    .wishlist-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }
    
    .product-card {
        background: white;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s;
        position: relative;
    }
    
    .product-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        transform: translateY(-5px);
    }
    
    .product-image {
        position: relative;
        height: 250px;
        background-color: var(--fahasa-light-gray);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    
    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .product-image i {
        font-size: 4rem;
        color: var(--fahasa-gray);
    }
    
    .product-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background-color: var(--fahasa-red);
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    
    .btn-remove-wishlist {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background-color: white;
        border: none;
        color: var(--fahasa-red);
        font-size: 1.2rem;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-remove-wishlist:hover {
        background-color: var(--fahasa-red);
        color: white;
        transform: scale(1.1);
    }
    
    .product-info {
        padding: 15px;
    }
    
    .product-name {
        font-weight: 600;
        color: var(--fahasa-dark);
        margin-bottom: 5px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 48px;
    }
    
    .product-author {
        color: var(--fahasa-gray);
        font-size: 0.85rem;
        margin-bottom: 10px;
    }
    
    .product-rating {
        display: flex;
        align-items: center;
        gap: 5px;
        margin-bottom: 10px;
    }
    
    .rating-stars {
        color: #ffa500;
    }
    
    .rating-value {
        font-weight: 600;
        color: var(--fahasa-dark);
    }
    
    .rating-sold {
        color: var(--fahasa-gray);
        font-size: 0.85rem;
    }
    
    .product-price {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }
    
    .price-current {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--fahasa-red);
    }
    
    .price-original {
        font-size: 0.9rem;
        color: var(--fahasa-gray);
        text-decoration: line-through;
    }
    
    .btn-add-cart {
        width: 100%;
        padding: 10px;
        background-color: var(--fahasa-orange);
        color: white;
        border: none;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .btn-add-cart:hover {
        background-color: #e68419;
        transform: translateY(-2px);
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
        margin-bottom: 20px;
    }
    
    .btn-browse {
        padding: 12px 30px;
        background-color: var(--fahasa-red);
        color: white;
        border: none;
        border-radius: 6px;
        font-weight: 500;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s;
    }
    
    .btn-browse:hover {
        background-color: #a51b1f;
        color: white;
    }
    
    @media (max-width: 767.98px) {
        .wishlist-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
        }
        
        .product-image {
            height: 200px;
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
                        <i class="fas fa-heart"></i>
                        Sản phẩm yêu thích
                        <?php if (!empty($wishlist)): ?>
                            <span class="text-muted" style="font-size: 1rem; font-weight: 400;">
                                (<?= count($wishlist) ?> sản phẩm)
                            </span>
                        <?php endif; ?>
                    </h2>
                    
                    <!-- Wishlist Grid -->
                    <?php if (!empty($wishlist)): ?>
                        <div class="wishlist-grid">
                            <?php foreach ($wishlist as $product): ?>
                                <div class="product-card"
                                     data-product-id="<?= $product['product_id'] ?>"
                                     onclick="window.location.href='<?= BASE_URL ?>product/detail/<?= $product['product_id'] ?>'"
                                     style="cursor: pointer;">

                                    <div class="product-image">
                                        <img src="<?= BASE_URL . $product['image'] ?>" alt="<?= htmlspecialchars($product['product_name']) ?>">
                                        <?php if ($product['discount'] > 0): ?>
                                            <span class="product-badge">-<?= $product['discount'] ?>%</span>
                                        <?php endif; ?>
                                        <button class="btn-remove-wishlist"
                                                onclick="event.stopPropagation();"
                                                title="Xóa khỏi yêu thích">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>

                                    <div class="product-info">
                                        <h3 class="product-name">
                                            <?= htmlspecialchars($product['product_name']) ?>
                                        </h3>
                                        <div class="product-author">
                                            <?= htmlspecialchars($product['author']) ?>
                                        </div>

                                        <!-- Rating section - only show if data exists -->
                                        <?php if (isset($product['rating']) && isset($product['sold'])): ?>
                                        <div class="product-rating">
                                            <span class="rating-stars">
                                                <?php
                                                $rating = $product['rating'];
                                                for ($i = 1; $i <= 5; $i++) {
                                                    if ($i <= floor($rating)) {
                                                        echo '<i class="fas fa-star"></i>';
                                                    } elseif ($i - 0.5 <= $rating) {
                                                        echo '<i class="fas fa-star-half-alt"></i>';
                                                    } else {
                                                        echo '<i class="far fa-star"></i>';
                                                    }
                                                }
                                                ?>
                                            </span>
                                            <span class="rating-value"><?= $rating ?></span>
                                            <span class="rating-sold">| Đã bán <?= $product['sold'] ?></span>
                                        </div>
                                        <?php endif; ?>

                                        <div class="product-price">
                                            <span class="price-current">
                                                <?= number_format($product['price']) ?>đ
                                            </span>
                                            <?php if ($product['original_price'] > $product['price']): ?>
                                                <span class="price-original">
                                                    <?= number_format($product['original_price']) ?>đ
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="empty-state">
                            <i class="far fa-heart"></i>
                            <h4>Chưa có sản phẩm yêu thích</h4>
                            <p>Hãy thêm sản phẩm vào danh sách yêu thích để dễ dàng theo dõi và mua sắm sau!</p>
                            <a href="<?= BASE_URL ?>product" class="btn-browse">
                                <i class="fas fa-book me-2"></i>Khám phá sản phẩm
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Remove from wishlist (call API)
document.querySelectorAll('.btn-remove-wishlist').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.stopPropagation();

        if (!confirm('Bạn có chắc muốn xóa sản phẩm này khỏi danh sách yêu thích?')) return;

        const card = this.closest('.product-card');
        const pid = card?.dataset?.productId || card?.getAttribute('data-product-id');

        // animate optimistic
        card.style.opacity = '0.6';

        fetch('<?= BASE_URL ?>customer/removeWishlist', {
            method: 'POST',
            headers: {'Content-Type':'application/x-www-form-urlencoded'},
            body: 'product_id=' + encodeURIComponent(pid)
        })
        .then(r => r.json())
        .then(res => {
            if (res.success) {
                // remove with animation
                card.style.transition = 'all 0.25s';
                card.style.transform = 'scale(0.85)';
                card.style.opacity = '0';
                setTimeout(() => {
                    card.remove();
                    const remaining = document.querySelectorAll('.product-card').length;
                    if (remaining === 0) location.reload();
                    else {
                        const countEl = document.querySelector('.page-title span');
                        if (countEl) countEl.textContent = `(${remaining} sản phẩm)`;
                    }
                }, 250);
            } else if (res.need_login) {
                window.location.href = '<?= BASE_URL ?>auth/login';
            } else {
                card.style.opacity = '1';
                showToast(res.message || 'Xóa thất bại', 'danger');
            }
        })
        .catch(() => {
            card.style.opacity = '1';
            showToast('Lỗi kết nối', 'danger');
        });
    });
});

// Add to cart
document.querySelectorAll('.btn-add-cart').forEach(btn => {
    btn.addEventListener('click', function() {
        const productName = this.closest('.product-card').querySelector('.product-name').textContent.trim();
        
        // Simulate adding to cart
        const originalText = this.innerHTML;
        this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang thêm...';
        this.disabled = true;
        
        setTimeout(() => {
            this.innerHTML = '<i class="fas fa-check me-2"></i>Đã thêm!';
            
            // Show notification
            const notification = document.createElement('div');
            notification.className = 'alert alert-success position-fixed';
            notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            notification.innerHTML = `
                <i class="fas fa-check-circle me-2"></i>
                Đã thêm "${productName}" vào giỏ hàng!
            `;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
                this.innerHTML = originalText;
                this.disabled = false;
            }, 2000);
        }, 800);
    });
});
</script>

<?php require_once APP_ROOT . '/views/components/footer.php'; ?>
