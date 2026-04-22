<?php require_once APP_ROOT . '/views/components/header.php'; ?>

<style>
    .breadcrumb-section {
        background-color: var(--fahasa-light-gray);
        padding: 15px 0;
        margin-bottom: 30px;
    }
    
    .breadcrumb {
        background: none;
        margin-bottom: 0;
        padding: 0;
    }
    
    .breadcrumb-item a {
        color: var(--fahasa-gray);
        text-decoration: none;
    }
    
    .breadcrumb-item a:hover {
        color: var(--fahasa-red);
    }
    
    .breadcrumb-item.active {
        color: var(--fahasa-dark);
    }
    
    .page-title {
        color: var(--fahasa-red);
        font-weight: 700;
        margin-bottom: 30px;
        position: relative;
        padding-bottom: 15px;
    }
    
    .page-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 80px;
        height: 3px;
        background-color: var(--fahasa-orange);
    }
    
    .qa-hero {
        background: linear-gradient(135deg, var(--fahasa-red) 0%, var(--fahasa-orange) 100%);
        color: white;
        padding: 60px 0;
        margin-bottom: 50px;
        border-radius: 10px;
        text-align: center;
    }
    
    .qa-hero h2 {
        font-weight: 700;
        margin-bottom: 20px;
    }
    
    .qa-hero p {
        font-size: 18px;
        margin-bottom: 30px;
    }
    
    .search-qa {
        max-width: 600px;
        margin: 0 auto;
        position: relative;
    }
    
    .search-qa input {
        width: 100%;
        padding: 15px 60px 15px 20px;
        border: none;
        border-radius: 50px;
        font-size: 16px;
    }
    
    .search-qa button {
        position: absolute;
        right: 5px;
        top: 5px;
        background-color: var(--fahasa-red);
        border: none;
        color: white;
        padding: 10px 25px;
        border-radius: 50px;
        cursor: pointer;
    }
    
    .search-qa button:hover {
        background-color: #a81b20;
    }
    
    .category-tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }
    
    .category-tab {
        padding: 12px 25px;
        background-color: white;
        border: 2px solid var(--fahasa-light-gray);
        border-radius: 25px;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        color: var(--fahasa-dark);
        font-weight: 500;
    }
    
    .category-tab:hover,
    .category-tab.active {
        background-color: var(--fahasa-red);
        color: white;
        border-color: var(--fahasa-red);
    }
    
    .accordion-item {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        margin-bottom: 15px;
        overflow: hidden;
    }
    
    .accordion-button {
        background-color: white;
        color: var(--fahasa-dark);
        font-weight: 600;
        padding: 20px 25px;
        font-size: 16px;
    }
    
    .accordion-button:not(.collapsed) {
        background-color: var(--fahasa-light-gray);
        color: var(--fahasa-red);
        box-shadow: none;
    }
    
    .accordion-button:focus {
        box-shadow: none;
        border-color: var(--fahasa-red);
    }
    
    .accordion-button::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23C92127'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }
    
    .accordion-body {
        padding: 20px 25px;
        color: var(--fahasa-gray);
        line-height: 1.8;
    }
    
    .contact-box {
        background: linear-gradient(135deg, var(--fahasa-red) 0%, var(--fahasa-orange) 100%);
        color: white;
        padding: 40px;
        border-radius: 10px;
        text-align: center;
        margin-top: 50px;
    }
    
    .contact-box h4 {
        font-weight: 700;
        margin-bottom: 20px;
    }
    
    .contact-box p {
        font-size: 16px;
        margin-bottom: 25px;
    }
    
    .contact-methods {
        display: flex;
        justify-content: center;
        gap: 30px;
        flex-wrap: wrap;
    }
    
    .contact-method {
        background-color: rgba(255,255,255,0.2);
        padding: 20px 30px;
        border-radius: 8px;
        transition: all 0.3s;
    }
    
    .contact-method:hover {
        background-color: rgba(255,255,255,0.3);
        transform: translateY(-3px);
    }
    
    .contact-method i {
        font-size: 32px;
        margin-bottom: 10px;
    }
    
    .contact-method .label {
        font-size: 14px;
        margin-bottom: 5px;
        opacity: 0.9;
    }
    
    .contact-method .value {
        font-size: 18px;
        font-weight: 600;
    }
    
    .popular-questions {
        background-color: var(--fahasa-light-gray);
        padding: 30px;
        border-radius: 10px;
        margin-bottom: 30px;
    }
    
    .popular-questions h5 {
        color: var(--fahasa-red);
        font-weight: 600;
        margin-bottom: 20px;
    }
    
    .popular-questions ul {
        list-style: none;
        padding: 0;
    }
    
    .popular-questions ul li {
        padding: 10px 0;
        border-bottom: 1px solid #ddd;
    }
    
    .popular-questions ul li:last-child {
        border-bottom: none;
    }
    
    .popular-questions ul li a {
        color: var(--fahasa-dark);
        text-decoration: none;
        display: flex;
        align-items: center;
        transition: color 0.3s;
    }
    
    .popular-questions ul li a:hover {
        color: var(--fahasa-red);
    }
    
    .popular-questions ul li a i {
        margin-right: 10px;
        color: var(--fahasa-orange);
    }
    .qa-group {
        transition: all 0.3s ease-in-out;
        opacity: 1;
        transform: translateY(0);
    }

    .qa-group.hidden {
        display: none; /* Ẩn hoàn toàn khỏi layout */
        opacity: 0;
        transform: translateY(20px);
    }
    
    /* Active tab style update */
    .category-tab.active {
        background-color: var(--fahasa-red);
        color: white;
        border-color: var(--fahasa-red);
        box-shadow: 0 4px 10px rgba(201, 33, 39, 0.3);
    }
</style>

<div class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fas fa-home"></i> Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Hỏi/Đáp</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container">
    <div class="qa-hero">
        <div class="container">
            <h2><i class="fas fa-question-circle"></i> Câu hỏi thường gặp</h2>
            <p>Tìm câu trả lời nhanh chóng cho các thắc mắc của bạn</p>
            <div class="search-qa">
                <input type="text" id="searchInput" placeholder="Tìm kiếm câu hỏi...">
                <button type="button"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            <div class="category-tabs">
                <a href="#" class="category-tab active" data-category="all">
                    <i class="fas fa-th"></i> Tất cả
                </a>
                <a href="#" class="category-tab" data-category="order">
                    <i class="fas fa-shopping-cart"></i> Đặt hàng
                </a>
                <a href="#" class="category-tab" data-category="payment">
                    <i class="fas fa-credit-card"></i> Thanh toán
                </a>
                <a href="#" class="category-tab" data-category="shipping">
                    <i class="fas fa-truck"></i> Vận chuyển
                </a>
                <a href="#" class="category-tab" data-category="return">
                    <i class="fas fa-undo"></i> Đổi trả
                </a>
            </div>
            
            <div id="qa-container">

                <div class="qa-group" data-category="order">
                    <h3 class="page-title">Về đặt hàng</h3>
                    <div class="accordion" id="orderAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#order1">
                                    <i class="fas fa-question-circle me-2"></i> Làm thế nào để đặt hàng trên website?
                                </button>
                            </h2>
                            <div id="order1" class="accordion-collapse collapse show" data-bs-parent="#orderAccordion">
                                <div class="accordion-body">
                                    <strong>Các bước đặt hàng:</strong>
                                    <ol>
                                        <li>Tìm kiếm sản phẩm bạn muốn mua</li>
                                        <li>Nhấn nút "Thêm vào giỏ hàng"</li>
                                        <li>Vào giỏ hàng và kiểm tra lại đơn hàng</li>
                                        <li>Nhấn "Thanh toán" và điền thông tin giao hàng</li>
                                        <li>Chọn phương thức thanh toán và hoàn tất đơn hàng</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#order2">
                                    <i class="fas fa-question-circle me-2"></i> Tôi có thể đặt hàng qua điện thoại không?
                                </button>
                            </h2>
                            <div id="order2" class="accordion-collapse collapse" data-bs-parent="#orderAccordion">
                                <div class="accordion-body">
                                    Có, bạn có thể gọi đến hotline <strong>1900-6656</strong> để được hỗ trợ đặt hàng.
                                </div>
                            </div>
                        </div>

                         <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#order3">
                                    <i class="fas fa-question-circle me-2"></i> Tôi có thể hủy đơn hàng không?
                                </button>
                            </h2>
                            <div id="order3" class="accordion-collapse collapse" data-bs-parent="#orderAccordion">
                                <div class="accordion-body">
                                    Bạn có thể hủy đơn hàng trước khi đơn hàng được xác nhận và chuẩn bị giao.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="qa-group" data-category="payment">
                    <h3 class="page-title mt-4">Về thanh toán</h3>
                    <div class="accordion" id="paymentAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#payment1">
                                    <i class="fas fa-question-circle me-2"></i> Có những phương thức thanh toán nào?
                                </button>
                            </h2>
                            <div id="payment1" class="accordion-collapse collapse" data-bs-parent="#paymentAccordion">
                                <div class="accordion-body">
                                    <strong>Chúng tôi hỗ trợ các phương thức thanh toán sau:</strong>
                                    <ul>
                                        <li>COD, Chuyển khoản, Thẻ ATM/Visa, Ví điện tử...</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#payment2">
                                    <i class="fas fa-question-circle me-2"></i> Thanh toán online có an toàn không?
                                </button>
                            </h2>
                            <div id="payment2" class="accordion-collapse collapse" data-bs-parent="#paymentAccordion">
                                <div class="accordion-body">
                                    Hoàn toàn an toàn với bảo mật SSL 256-bit.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="qa-group" data-category="shipping">
                    <h3 class="page-title mt-4">Về vận chuyển</h3>
                    <div class="accordion" id="shippingAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#shipping1">
                                    <i class="fas fa-question-circle me-2"></i> Thời gian giao hàng là bao lâu?
                                </button>
                            </h2>
                            <div id="shipping1" class="accordion-collapse collapse" data-bs-parent="#shippingAccordion">
                                <div class="accordion-body">
                                    Nội thành 1-2 ngày, ngoại thành 2-4 ngày.
                                </div>
                            </div>
                        </div>
                         <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#shipping2">
                                    <i class="fas fa-question-circle me-2"></i> Phí vận chuyển là bao nhiêu?
                                </button>
                            </h2>
                            <div id="shipping2" class="accordion-collapse collapse" data-bs-parent="#shippingAccordion">
                                <div class="accordion-body">
                                    Miễn phí cho đơn hàng trên 150k.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="qa-group" data-category="return">
                    <h3 class="page-title mt-4">Về đổi trả hàng</h3>
                    <div class="accordion" id="returnAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#return1">
                                    <i class="fas fa-question-circle me-2"></i> Chính sách đổi trả như thế nào?
                                </button>
                            </h2>
                            <div id="return1" class="accordion-collapse collapse" data-bs-parent="#returnAccordion">
                                <div class="accordion-body">
                                    Đổi trả trong vòng 7 ngày nếu lỗi nhà sản xuất.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="no-results" class="text-center mt-5 hidden" style="display:none;">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h4>Không tìm thấy kết quả phù hợp</h4>
                </div>

            </div> </div>
        
        <div class="col-md-4">
            <div class="popular-questions">
                <h5><i class="fas fa-fire"></i> Câu hỏi phổ biến</h5>
                <ul>
                    <li><a href="#order1" onclick="triggerFilter('order')"><i class="fas fa-chevron-right"></i> Cách đặt hàng</a></li>
                    <li><a href="#payment1" onclick="triggerFilter('payment')"><i class="fas fa-chevron-right"></i> Phương thức thanh toán</a></li>
                    <li><a href="#return1" onclick="triggerFilter('return')"><i class="fas fa-chevron-right"></i> Chính sách đổi trả</a></li>
                </ul>
            </div>
            </div>
    </div>
    
    <div class="contact-box">
        </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.category-tab');
        const groups = document.querySelectorAll('.qa-group');
        const searchInput = document.getElementById('searchInput');

        // Hàm xử lý Filter
        function filterQA(category) {
            // 1. Update active tab style
            tabs.forEach(t => {
                if(t.getAttribute('data-category') === category) {
                    t.classList.add('active');
                } else {
                    t.classList.remove('active');
                }
            });

            // 2. Show/Hide content groups
            groups.forEach(group => {
                const groupCategory = group.getAttribute('data-category');
                
                if (category === 'all' || category === groupCategory) {
                    // Hiển thị
                    group.classList.remove('hidden');
                    // Reset animation trick
                    setTimeout(() => {
                        group.style.opacity = '1';
                        group.style.transform = 'translateY(0)';
                    }, 50);
                } else {
                    // Ẩn đi
                    group.style.opacity = '0';
                    group.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        group.classList.add('hidden');
                    }, 300); // Chờ animation xong mới ẩn display:none
                }
            });
        }

        // Gán sự kiện Click cho Tabs
        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                const category = this.getAttribute('data-category');
                filterQA(category);
            });
        });

        // (Nâng cao) Hàm search đơn giản
        if(searchInput) {
            searchInput.addEventListener('keyup', function() {
                const term = this.value.toLowerCase();
                if(term === '') {
                    // Nếu xóa hết ô tìm kiếm thì reset về tab đang active
                    const activeTab = document.querySelector('.category-tab.active');
                    filterQA(activeTab.getAttribute('data-category'));
                    return;
                }

                // Nếu đang search thì hiện tất cả group lên để tìm bên trong
                groups.forEach(group => group.classList.remove('hidden'));
                
                // Logic tìm kiếm text bên trong accordion button
                const buttons = document.querySelectorAll('.accordion-button');
                buttons.forEach(btn => {
                    const text = btn.textContent.toLowerCase();
                    const item = btn.closest('.accordion-item');
                    if(text.includes(term)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        }
        
        // Expose function to global scope for Sidebar links
        window.triggerFilter = function(cat) {
            filterQA(cat);
            // Scroll to top of content
            document.getElementById('qa-container').scrollIntoView({behavior: 'smooth'});
        };
    });
</script>

<?php require_once APP_ROOT . '/views/components/footer.php'; ?>