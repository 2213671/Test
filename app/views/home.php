<?php require_once APP_ROOT . '/views/components/header.php'; ?>

<style>
    .hero-section {
        background: linear-gradient(rgba(201, 33, 39, 0.7), rgba(247, 148, 30, 0.7)), url('<?= BASE_URL ?>images/home-page/library.jpg') no-repeat center center;
        background-size: cover;
        height: 500px;
        display: flex;
        align-items: center;
        color: white;
        border-radius: 12px;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at center, transparent, rgba(0,0,0,0.4));
        pointer-events: none;
    }

    .hero-content {
        max-width: 600px;
        z-index: 1;
        padding: 0 20px;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 15px;
        text-shadow: 2px 2px 8px rgba(0,0,0,0.7);
        line-height: 1.2;
    }

    .hero-subtitle {
        font-size: 1.3rem;
        margin-bottom: 30px;
        text-shadow: 1px 1px 4px rgba(0,0,0,0.7);
        line-height: 1.6;
    }

    .btn-hero {
        background-color: var(--fahasa-orange);
        color: white;
        border: none;
        padding: 14px 35px;
        border-radius: 30px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(247, 148, 30, 0.4);
        font-size: 1.1rem;
    }

    .btn-hero:hover {
        background-color: #e6850e;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(247, 148, 30, 0.6);
    }

    .section-title {
        color: var(--fahasa-red);
        font-weight: 700;
        margin-bottom: 30px;
        position: relative;
        padding-bottom: 15px;
        text-align: center;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: linear-gradient(to right, var(--fahasa-red), var(--fahasa-orange));
        border-radius: 2px;
    }

    .product-card {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: transform 0.3s, box-shadow 0.3s;
        margin-bottom: 20px;
        text-decoration: none;
        color: inherit;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.15);
    }

    .product-image {
        height: 200px;
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .product-image img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .product-info {
        padding: 15px;
    }

    .product-title {
        font-weight: 600;
        margin-bottom: 10px;
        font-size: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-author {
        color: var(--fahasa-gray);
        font-size: 0.9rem;
        margin-bottom: 10px;
    }

    .product-price {
        color: var(--fahasa-red);
        font-weight: 700;
        font-size: 1.1rem;
    }

    .product-old-price {
        color: #999;
        text-decoration: line-through;
        font-size: 0.9rem;
        margin-left: 10px;
    }

    .banner-section {
        margin: 40px 0;
    }

    .banner-item {
        border-radius: 12px;
        overflow: hidden;
        height: 250px;
        background-color: var(--fahasa-light-gray);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        transition: transform 0.3s, box-shadow 0.3s;
        position: relative;
        overflow: hidden;
    }

    .banner-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    .banner-content {
        text-align: center;
        padding: 20px;
        z-index: 2;
    }

    .banner-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 10px;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
    }

    .banner-subtitle {
        font-size: 1rem;
        margin-bottom: 15px;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        opacity: 0.9;
    }

    .banner-cta {
        display: inline-block;
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
        padding: 8px 20px;
        border-radius: 20px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .banner-item:hover .banner-cta {
        background-color: white;
        color: var(--fahasa-red);
    }

    .category-section {
        background-color: var(--fahasa-light-gray);
        padding: 50px 0;
        margin: 40px 0;
        border-radius: 12px;
    }

    .category-card {
        text-align: center;
        padding: 25px 15px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: all 0.3s;
        text-decoration: none;
        color: inherit;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .category-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        background: linear-gradient(145deg, #ffffff, #f9f9f9);
    }

    .category-icon {
        font-size: 45px;
        color: var(--fahasa-red);
        margin-bottom: 15px;
        transition: transform 0.3s;
    }

    .category-card:hover .category-icon {
        transform: scale(1.1);
    }

    .category-name {
        font-weight: 600;
        color: var(--fahasa-dark);
        font-size: 1.1rem;
    }

    .promotion-section {
        background: linear-gradient(135deg, var(--fahasa-red) 0%, var(--fahasa-orange) 100%);
        color: white;
        padding: 50px 0;
        border-radius: 10px;
        margin: 40px 0;
        text-align: center;
    }

    .promotion-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .promotion-subtitle {
        font-size: 1.2rem;
        margin-bottom: 30px;
    }

    .counter {
        display: flex;
        justify-content: center;
        gap: 40px;
        margin-top: 30px;
    }

    .counter-item {
        text-align: center;
    }

    .counter-number {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .counter-label {
        font-size: 1rem;
        opacity: 0.9;
    }
</style>

<!-- Hero Section -->
<div class="container">
    <div class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">FAHASA - Tri thức cho cuộc sống</h1>
                <p class="hero-subtitle">Hệ thống nhà sách lớn nhất Việt Nam với hơn 100 cửa hàng trên toàn quốc. Đa dạng sách, giá tốt, giao hàng nhanh chóng.</p>
                <a href="#" class="btn-hero">Khám phá ngay <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>

    <!-- Categories -->
    <div class="category-section">
        <div class="container">
            <h2 class="section-title">Danh mục nổi bật</h2>
            <div class="row">
                <div class="col-lg-2 col-md-3 col-6 mb-4">
                    <a href="#" class="category-card">
                        <div class="category-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="category-name">Sách</div>
                    </a>
                </div>
                <div class="col-lg-2 col-md-3 col-6 mb-4">
                    <a href="#" class="category-card">
                        <div class="category-icon">
                            <i class="fas fa-paint-brush"></i>
                        </div>
                        <div class="category-name">Văn phòng phẩm</div>
                    </a>
                </div>
                <div class="col-lg-2 col-md-3 col-6 mb-4">
                    <a href="#" class="category-card">
                        <div class="category-icon">
                            <i class="fas fa-laptop"></i>
                        </div>
                        <div class="category-name">Đồ điện tử</div>
                    </a>
                </div>
                <div class="col-lg-2 col-md-3 col-6 mb-4">
                    <a href="#" class="category-card">
                        <div class="category-icon">
                            <i class="fas fa-music"></i>
                        </div>
                        <div class="category-name">CD - DVD</div>
                    </a>
                </div>
                <div class="col-lg-2 col-md-3 col-6 mb-4">
                    <a href="#" class="category-card">
                        <div class="category-icon">
                            <i class="fas fa-gamepad"></i>
                        </div>
                        <div class="category-name">Đồ chơi</div>
                    </a>
                </div>
                <div class="col-lg-2 col-md-3 col-6 mb-4">
                    <a href="#" class="category-card">
                        <div class="category-icon">
                            <i class="fas fa-tshirt"></i>
                        </div>
                        <div class="category-name">Thời trang</div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Promotion Banner -->
    <div class="row banner-section">
        <div class="col-lg-8 mb-4">
            <a href="#" class="banner-item" style="background: linear-gradient(135deg, var(--fahasa-red) 0%, var(--fahasa-orange) 100%);">
                <div class="banner-content">
                    <h3 class="banner-title">MUA SẮM NGAY - ƯU ĐÃI LỚN</h3>
                    <p class="banner-subtitle">Giảm đến 50% cho các mặt hàng sách ngoại văn</p>
                    <span class="banner-cta">Xem ngay</span>
                </div>
            </a>
        </div>
        <div class="col-lg-4 mb-4">
            <a href="#" class="banner-item" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="banner-content">
                    <h3 class="banner-title">FREESHIP TOÀN QUỐC</h3>
                    <p class="banner-subtitle">Đơn hàng từ 299K</p>
                    <span class="banner-cta">Đặt hàng</span>
                </div>
            </a>
        </div>
        <div class="col-lg-4 mb-4">
            <a href="#" class="banner-item" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="banner-content">
                    <h3 class="banner-title">MUA 2 TẶNG 1</h3>
                    <p class="banner-subtitle">Sách kỹ năng & phát triển bản thân</p>
                    <span class="banner-cta">Khám phá</span>
                </div>
            </a>
        </div>
        <div class="col-lg-8 mb-4">
            <a href="#" class="banner-item" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="banner-content">
                    <h3 class="banner-title">THẺ QUÀ TẶNG ĐẶC BIỆT</h3>
                    <p class="banner-subtitle">Tặng người thân - Lan tỏa tri thức</p>
                    <span class="banner-cta">Tìm hiểu thêm</span>
                </div>
            </a>
        </div>
    </div>

    <!-- Best Sellers -->
    <div class="row mb-5">
        <div class="col-md-12">
            <h2 class="section-title">Sản phẩm bán chạy</h2>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="#" class="product-card">
                <div class="product-image">
                    <img src="<?= BASE_URL ?>images/home-page/dac-nhan-tam.jpg" alt="Đắc Nhân Tâm">
                </div>
                <div class="product-info">
                    <h3 class="product-title">Đắc Nhân Tâm - Tác phẩm kinh điển về nghệ thuật thu phục và ảnh hưởng người khác</h3>
                    <div class="product-author">Dale Carnegie</div>
                    <div class="product-price">85,000đ <span class="product-old-price">100,000đ</span></div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="#" class="product-card">
                <div class="product-image">
                    <img src="<?= BASE_URL ?>images/home-page/nha-gia-kim.jpg" alt="Nhà Giả Kim">
                </div>
                <div class="product-info">
                    <h3 class="product-title">Nhà Giả Kim - Phiên bản kỷ niệm 25 năm</h3>
                    <div class="product-author">Paulo Coelho</div>
                    <div class="product-price">75,000đ <span class="product-old-price">90,000đ</span></div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="#" class="product-card">
                <div class="product-image">
                    <img src="<?= BASE_URL ?>images/home-page/nha-lanh-dao-khong-chuc-danh.jpg" alt="Nhà Lãnh Đạo Không Chức Danh">
                </div>
                <div class="product-info">
                    <h3 class="product-title">Nhà Lãnh Đạo Không Chức Danh</h3>
                    <div class="product-author">Robin Sharma</div>
                    <div class="product-price">95,000đ <span class="product-old-price">110,000đ</span></div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="#" class="product-card">
                <div class="product-image">
                    <img src="<?= BASE_URL ?>images/home-page/doi-ngan-dung-ngu-dai.jpg" alt="Đời Ngắn Đừng Ngủ Dài">
                </div>
                <div class="product-info">
                    <h3 class="product-title">Đời Ngắn Đừng Ngủ Dài</h3>
                    <div class="product-author">Robin Sharma</div>
                    <div class="product-price">88,000đ <span class="product-old-price">105,000đ</span></div>
                </div>
            </a>
        </div>
    </div>

    <!-- New Arrivals -->
    <div class="row mb-5">
        <div class="col-md-12">
            <h2 class="section-title">Sản phẩm mới</h2>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="#" class="product-card">
                <div class="product-image">
                    <img src="<?= BASE_URL ?>images/home-page/tu-duy-nhanh-va-cham.jpg" alt="Tư Duy Nhanh và Tư Duy Chậm">
                </div>
                <div class="product-info">
                    <h3 class="product-title">Tư Duy Nhanh và Tư Duy Chậm</h3>
                    <div class="product-author">Daniel Kahneman</div>
                    <div class="product-price">120,000đ</div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="#" class="product-card">
                <div class="product-image">
                    <img src="<?= BASE_URL ?>images/home-page/tu-duy-tich-cuc.jpg" alt="Tư duy tích cực">
                </div>
                <div class="product-info">
                    <h3 class="product-title">Tư Duy Tích Cực</h3>
                    <div class="product-author">Trần Đình Hoành</div>
                    <div class="product-price">92,000đ</div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="#" class="product-card">
                <div class="product-image">
                    <img src="<?= BASE_URL ?>images/home-page/hieu-ve-trai-tim.jpg" alt="Hiểu về trái tim">
                </div>
                <div class="product-info">
                    <h3 class="product-title">Hiểu Về Trái Tim</h3>
                    <div class="product-author">Minh Niệm</div>
                    <div class="product-price">75,000đ</div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="#" class="product-card">
                <div class="product-image">
                    <img src="<?= BASE_URL ?>images/home-page/dam-bi-ghet.jpg" alt="Dám bị ghét">
                </div>
                <div class="product-info">
                    <h3 class="product-title">Dám Bị Ghét</h3>
                    <div class="product-author">Kishimi Ichiro</div>
                    <div class="product-price">85,000đ</div>
                </div>
            </a>
        </div>
    </div>

    <!-- Promotion Section -->
    <div class="promotion-section">
        <div class="container">
            <h2 class="promotion-title">Ưu đãi đặc biệt</h2>
            <p class="promotion-subtitle">Mua sách giảm đến 50% cho khách hàng thành viên</p>
            <a href="#" class="btn-hero">Tham gia ngay</a>

            <div class="counter">
                <div class="counter-item">
                    <div class="counter-number">100+</div>
                    <div class="counter-label">Cửa hàng</div>
                </div>
                <div class="counter-item">
                    <div class="counter-number">1M+</div>
                    <div class="counter-label">Khách hàng</div>
                </div>
                <div class="counter-item">
                    <div class="counter-number">50K+</div>
                    <div class="counter-label">Sản phẩm</div>
                </div>
                <div class="counter-item">
                    <div class="counter-number">24/7</div>
                    <div class="counter-label">Hỗ trợ</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Articles -->
    <div class="row mb-5">
        <div class="col-md-12">
            <h2 class="section-title">Bài viết nổi bật</h2>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="<?= BASE_URL ?>images/home-page/loi-ich-doc-sach.jpg" class="card-img-top" alt="Lợi ích của việc đọc sách">
                <div class="card-body">
                    <h5 class="card-title">Lợi ích của việc đọc sách mỗi ngày</h5>
                    <p class="card-text">Đọc sách không chỉ giúp mở rộng kiến thức mà còn cải thiện trí nhớ, tăng khả năng tập trung và giảm căng thẳng hiệu quả...</p>
                    <a href="#" class="btn" style="background-color: var(--fahasa-red); color: white; border: none;">Đọc thêm</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="<?= BASE_URL ?>images/home-page/top-10-cuon-sach-nen-doc.jpg" class="card-img-top" alt="Top 10 cuốn sách nên đọc trong đời">
                <div class="card-body">
                    <h5 class="card-title">Top 10 cuốn sách nên đọc trong đời</h5>
                    <p class="card-text">Dưới đây là danh sách 10 cuốn sách kinh điển mà mỗi người nên đọc ít nhất một lần trong đời để mở mang tri thức và hiểu biết...</p>
                    <a href="#" class="btn" style="background-color: var(--fahasa-red); color: white; border: none;">Đọc thêm</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="<?= BASE_URL ?>images/home-page/doc-sach-hieu-qua.jpg" class="card-img-top" alt="Phương pháp đọc sách hiệu quả">
                <div class="card-body">
                    <h5 class="card-title">Phương pháp đọc sách hiệu quả</h5>
                    <p class="card-text">Bạn đang đọc sách nhưng không nhớ được nhiều nội dung? Dưới đây là một số phương pháp đọc sách hiệu quả giúp bạn ghi nhớ tốt hơn...</p>
                    <a href="#" class="btn" style="background-color: var(--fahasa-red); color: white; border: none;">Đọc thêm</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once APP_ROOT . '/views/components/footer.php'; ?>