    <!-- Footer -->
    <footer class="footer mt-5" role="contentinfo" aria-label="footer navigation">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h5 id="about-heading">Về FAHASA</h5>
                        <ul class="list-unstyled" aria-labelledby="about-heading">
                            <li><a href="<?= BASE_URL ?>home/about" title="Giới thiệu về Fahasa">Giới thiệu về Fahasa</a></li>
                            <li><a href="#" title="Thông tin tuyển dụng">Tuyển dụng</a></li>
                            <li><a href="#" title="Chính sách bảo mật thông tin">Chính sách bảo mật</a></li>
                            <li><a href="#" title="Điều khoản sử dụng dịch vụ">Điều khoản sử dụng</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h5 id="support-heading">Hỗ trợ khách hàng</h5>
                        <ul class="list-unstyled" aria-labelledby="support-heading">
                            <li><a href="<?= BASE_URL ?>home/qa" title="Câu hỏi thường gặp">Câu hỏi thường gặp</a></li>
                            <li><a href="#" title="Chính sách đổi trả sản phẩm">Chính sách đổi trả</a></li>
                            <li><a href="#" title="Phương thức thanh toán">Phương thức thanh toán</a></li>
                            <li><a href="#" title="Hướng dẫn mua hàng">Hướng dẫn mua hàng</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h5 id="contact-heading">Liên hệ</h5>
                        <ul class="list-unstyled" aria-labelledby="contact-heading">
                            <li><span><i class="fas fa-map-marker-alt" aria-hidden="true"></i> <span>60-62 Lê Lợi, Q.1, TP.HCM</span></span></li>
                            <li><span><i class="fas fa-phone" aria-hidden="true"></i> <span>1900-6656</span></span></li>
                            <li><span><i class="fas fa-envelope" aria-hidden="true"></i> <span>info@fahasa.com</span></span></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h5 id="social-heading">Kết nối với chúng tôi</h5>
                        <div class="social-links" aria-labelledby="social-heading">
                            <a href="#" class="social-icon" aria-label="Facebook">
                                <i class="fab fa-facebook-f" aria-hidden="true"></i>
                            </a>
                            <a href="#" class="social-icon" aria-label="Instagram">
                                <i class="fab fa-instagram" aria-hidden="true"></i>
                            </a>
                            <a href="#" class="social-icon" aria-label="YouTube">
                                <i class="fab fa-youtube" aria-hidden="true"></i>
                            </a>
                            <a href="#" class="social-icon" aria-label="TikTok">
                                <i class="fab fa-tiktok" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="mt-3">
                            <h6 id="payment-heading">Phương thức thanh toán</h6>
                            <div class="payment-methods" aria-labelledby="payment-heading">
                                <i class="fab fa-cc-visa" aria-label="Visa" role="img"></i>
                                <i class="fab fa-cc-mastercard" aria-label="MasterCard" role="img"></i>
                                <i class="fas fa-money-bill-wave" aria-label="Tiền mặt" role="img"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p class="mb-0" role="contentinfo">&copy; 2024 <?= APP_NAME ?>. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <style>
        .footer {
            background-color: var(--fahasa-dark);
            color: white;
            margin-top: 50px;
        }
        
        .footer-top {
            padding: 40px 0;
        }
        
        .footer h5 {
            color: var(--fahasa-orange);
            margin-bottom: 20px;
            font-weight: 600;
        }
        
        .footer h6 {
            color: white;
            font-size: 14px;
            margin-bottom: 10px;
        }
        
        .footer ul li {
            margin-bottom: 10px;
        }
        
        .footer ul li a {
            color: #cccccc;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }
        
        .footer ul li a:hover {
            color: var(--fahasa-orange);
        }
        
        .footer ul li i {
            margin-right: 8px;
            color: var(--fahasa-orange);
        }
        
        .social-links {
            display: flex;
            gap: 10px;
        }
        
        .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: rgba(255,255,255,0.1);
            border-radius: 50%;
            color: white;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .social-icon:hover {
            background-color: var(--fahasa-orange);
            color: white;
            transform: translateY(-3px);
        }
        
        .payment-methods i {
            font-size: 24px;
            margin-right: 10px;
            color: var(--fahasa-orange);
        }
        
        .footer-bottom {
            background-color: rgba(0,0,0,0.2);
            padding: 20px 0;
        }
        
        .footer-bottom p {
            color: #cccccc;
            font-size: 14px;
        }
    </style>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Global site scripts -->
    <script>
        // Global image lazy loading and performance improvements
        document.addEventListener('DOMContentLoaded', function() {
            // Add lazy loading to all images that don't have it
            const images = document.querySelectorAll('img:not([loading])');
            images.forEach(img => {
                img.setAttribute('loading', 'lazy');
            });

            // Add performance observer for Core Web Vitals simulation
            if ('requestIdleCallback' in window) {
                requestIdleCallback(function() {
                    // Defer non-critical tasks
                    const links = document.querySelectorAll('a');
                    links.forEach(link => {
                        if (link.hostname !== window.location.hostname && !link.getAttribute('target')) {
                            link.setAttribute('target', '_blank');
                            link.setAttribute('rel', 'noopener');
                        }
                    });
                });
            }
        });
    </script>
    <script>
document.addEventListener('click', function(e) {
    const btn = e.target.closest('.btn-wishlist');
    if (!btn) return;
    e.preventDefault();
    e.stopPropagation();

    const pid = btn.getAttribute('data-product-id');
    if (!pid) return;

    btn.disabled = true;
    const orig = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

    fetch('<?= BASE_URL ?>customer/addWishlist', {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: 'product_id=' + encodeURIComponent(pid)
    })
    .then(r => r.json())
    .then(res => {
        btn.disabled = false;
        btn.innerHTML = orig;
        if (res.success) {
            // Visual feedback
            btn.classList.remove('btn-outline-danger');
            btn.classList.add('text-danger');
            btn.innerHTML = '<i class="fas fa-heart"></i>';
            showToast('Đã thêm vào yêu thích');
        } else if (res.need_login) {
            // nếu server yêu cầu login
            window.location.href = '<?= BASE_URL ?>auth/login';
        } else if (res.guest) {
            btn.classList.add('text-danger');
            btn.innerHTML = '<i class="fas fa-heart"></i>';
            showToast('Đã thêm tạm vào yêu thích (guest)');
        } else {
            showToast(res.message || 'Thêm thất bại', 'danger');
        }
    })
    .catch(() => {
        btn.disabled = false;
        btn.innerHTML = orig;
        showToast('Lỗi kết nối', 'danger');
    });
});
</script>
</body>
</html>
