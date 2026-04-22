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
    
    .about-hero {
        background: linear-gradient(135deg, var(--fahasa-red) 0%, var(--fahasa-orange) 100%);
        color: white;
        padding: 60px 0;
        margin-bottom: 50px;
        border-radius: 10px;
    }
    
    .about-hero h2 {
        font-weight: 700;
        margin-bottom: 20px;
    }
    
    .about-hero p {
        font-size: 18px;
        line-height: 1.8;
    }
    
    .info-card {
        background: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 30px;
        transition: transform 0.3s, box-shadow 0.3s;
    }
    
    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }
    
    .info-card .icon {
        font-size: 48px;
        color: var(--fahasa-red);
        margin-bottom: 20px;
    }
    
    .info-card h4 {
        color: var(--fahasa-dark);
        font-weight: 600;
        margin-bottom: 15px;
    }
    
    .info-card p {
        color: var(--fahasa-gray);
        line-height: 1.6;
    }
    
    .timeline {
        position: relative;
        padding: 20px 0;
    }
    
    .timeline-item {
        position: relative;
        padding-left: 60px;
        margin-bottom: 40px;
    }
    
    .timeline-item::before {
        content: '';
        position: absolute;
        left: 20px;
        top: 0;
        bottom: -40px;
        width: 2px;
        background-color: var(--fahasa-orange);
    }
    
    .timeline-item:last-child::before {
        display: none;
    }
    
    .timeline-icon {
        position: absolute;
        left: 0;
        top: 0;
        width: 40px;
        height: 40px;
        background-color: var(--fahasa-red);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
    }
    
    .timeline-content {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .timeline-content h5 {
        color: var(--fahasa-red);
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .stats-section {
        background-color: var(--fahasa-light-gray);
        padding: 50px 0;
        margin: 50px 0;
        border-radius: 10px;
    }
    
    .stat-item {
        text-align: center;
        padding: 20px;
    }
    
    .stat-item .stat-number {
        font-size: 48px;
        font-weight: 700;
        color: var(--fahasa-red);
        margin-bottom: 10px;
    }
    
    .stat-item .stat-label {
        font-size: 16px;
        color: var(--fahasa-gray);
        font-weight: 500;
    }
    
    .value-card {
        background: white;
        border-left: 4px solid var(--fahasa-red);
        padding: 25px;
        margin-bottom: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    
    .value-card h5 {
        color: var(--fahasa-red);
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .value-card p {
        color: var(--fahasa-gray);
        margin-bottom: 0;
        line-height: 1.6;
    }
</style>

<!-- Breadcrumb -->
<div class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fas fa-home"></i> Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Giới thiệu</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Main Content -->
<div class="container">
    <!-- Hero Section -->
    <div class="about-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2>Về FAHASA</h2>
                    <p>
                        Công ty Cổ Phần Phát Hành Sách TP.HCM - FAHASA là một trong những doanh nghiệp hàng đầu 
                        trong lĩnh vực phát hành sách tại Việt Nam. Với hơn 50 năm kinh nghiệm, chúng tôi tự hào 
                        là cầu nối đưa tri thức đến với hàng triệu độc giả trên toàn quốc.
                    </p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-book-reader" style="font-size: 120px; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Stats Section -->
    <div class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">50+</div>
                        <div class="stat-label">Năm kinh nghiệm</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">100+</div>
                        <div class="stat-label">Cửa hàng</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">1M+</div>
                        <div class="stat-label">Khách hàng</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">100K+</div>
                        <div class="stat-label">Đầu sách</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Mission & Vision -->
    <div class="row mb-5">
        <div class="col-md-12">
            <h3 class="page-title">Sứ mệnh & Tầm nhìn</h3>
        </div>
        <div class="col-md-6">
            <div class="info-card">
                <div class="icon">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h4>Sứ mệnh</h4>
                <p>
                    Phát triển văn hóa đọc trong cộng đồng, góp phần nâng cao dân trí, xây dựng một xã hội 
                    học tập. Chúng tôi cam kết mang đến cho khách hàng những sản phẩm chất lượng cao với 
                    giá cả hợp lý và dịch vụ tốt nhất.
                </p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="info-card">
                <div class="icon">
                    <i class="fas fa-eye"></i>
                </div>
                <h4>Tầm nhìn</h4>
                <p>
                    Trở thành hệ thống phát hành sách hàng đầu Việt Nam, tiên phong trong việc ứng dụng 
                    công nghệ vào kinh doanh sách. Mở rộng mạng lưới phân phối đến mọi miền đất nước, 
                    đưa tri thức đến gần hơn với mọi người.
                </p>
            </div>
        </div>
    </div>
    
    <!-- Core Values -->
    <div class="row mb-5">
        <div class="col-md-12">
            <h3 class="page-title">Giá trị cốt lõi</h3>
        </div>
        <div class="col-md-6">
            <div class="value-card">
                <h5><i class="fas fa-check-circle"></i> Uy tín</h5>
                <p>Luôn đặt uy tín lên hàng đầu trong mọi hoạt động kinh doanh, xây dựng niềm tin với khách hàng và đối tác.</p>
            </div>
            <div class="value-card">
                <h5><i class="fas fa-check-circle"></i> Chất lượng</h5>
                <p>Cam kết cung cấp sản phẩm chính hãng, chất lượng cao, đáp ứng nhu cầu đa dạng của khách hàng.</p>
            </div>
            <div class="value-card">
                <h5><i class="fas fa-check-circle"></i> Đổi mới</h5>
                <p>Không ngừng đổi mới, sáng tạo trong kinh doanh và dịch vụ, ứng dụng công nghệ hiện đại.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="value-card">
                <h5><i class="fas fa-check-circle"></i> Tận tâm</h5>
                <p>Phục vụ khách hàng với sự tận tâm, chu đáo, luôn lắng nghe và đáp ứng mọi nhu cầu.</p>
            </div>
            <div class="value-card">
                <h5><i class="fas fa-check-circle"></i> Trách nhiệm</h5>
                <p>Có trách nhiệm với cộng đồng, xã hội và môi trường, góp phần xây dựng xã hội phát triển bền vững.</p>
            </div>
            <div class="value-card">
                <h5><i class="fas fa-check-circle"></i> Đoàn kết</h5>
                <p>Xây dựng môi trường làm việc đoàn kết, hợp tác, tạo điều kiện cho nhân viên phát triển.</p>
            </div>
        </div>
    </div>
    
    <!-- Timeline -->
    <div class="row mb-5">
        <div class="col-md-12">
            <h3 class="page-title">Lịch sử phát triển</h3>
        </div>
        <div class="col-md-12">
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-icon">1976</div>
                    <div class="timeline-content">
                        <h5>Thành lập công ty</h5>
                        <p>Công ty Phát hành Sách TP.HCM được thành lập, đánh dấu bước khởi đầu cho hành trình phát triển.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-icon">2000</div>
                    <div class="timeline-content">
                        <h5>Chuyển đổi mô hình</h5>
                        <p>Chuyển đổi thành Công ty Cổ phần, mở rộng quy mô kinh doanh và nâng cao năng lực cạnh tranh.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-icon">2010</div>
                    <div class="timeline-content">
                        <h5>Phát triển thương mại điện tử</h5>
                        <p>Ra mắt website bán hàng trực tuyến, tiên phong trong lĩnh vực bán sách online tại Việt Nam.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-icon">2020</div>
                    <div class="timeline-content">
                        <h5>Mở rộng hệ thống</h5>
                        <p>Phát triển hệ thống cửa hàng trên toàn quốc, đạt mốc 100+ cửa hàng và trung tâm phân phối.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-icon">2024</div>
                    <div class="timeline-content">
                        <h5>Chuyển đổi số toàn diện</h5>
                        <p>Ứng dụng công nghệ AI và Big Data, nâng cao trải nghiệm khách hàng và tối ưu hóa vận hành.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Services -->
    <div class="row mb-5">
        <div class="col-md-12">
            <h3 class="page-title">Dịch vụ của chúng tôi</h3>
        </div>
        <div class="col-md-4">
            <div class="info-card text-center">
                <div class="icon">
                    <i class="fas fa-shipping-fast"></i>
                </div>
                <h4>Giao hàng nhanh</h4>
                <p>
                    Giao hàng toàn quốc trong 2-3 ngày. Miễn phí vận chuyển cho đơn hàng từ 150.000đ.
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-card text-center">
                <div class="icon">
                    <i class="fas fa-undo-alt"></i>
                </div>
                <h4>Đổi trả dễ dàng</h4>
                <p>
                    Chính sách đổi trả linh hoạt trong vòng 7 ngày nếu sản phẩm có lỗi từ nhà sản xuất.
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-card text-center">
                <div class="icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h4>Hỗ trợ 24/7</h4>
                <p>
                    Đội ngũ chăm sóc khách hàng chuyên nghiệp, sẵn sàng hỗ trợ bạn mọi lúc mọi nơi.
                </p>
            </div>
        </div>
    </div>
</div>

<?php require_once APP_ROOT . '/views/components/footer.php'; ?>
