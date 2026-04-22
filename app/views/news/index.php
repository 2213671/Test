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

    .search-section {
        background-color: var(--fahasa-light-gray);
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 30px;
    }

    .search-form {
        display: flex;
        gap: 15px;
    }

    .search-input {
        flex: 1;
        position: relative;
    }

    .search-input input {
        width: 100%;
        padding: 12px 45px 12px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }

    .search-input button {
        position: absolute;
        right: 5px;
        top: 5px;
        background-color: var(--fahasa-red);
        border: none;
        color: white;
        padding: 6px 15px;
        border-radius: 4px;
        cursor: pointer;
    }

    .filter-section {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }

    .filter-title {
        font-weight: 600;
        color: var(--fahasa-dark);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }

    .filter-title i {
        margin-right: 10px;
        color: var(--fahasa-red);
    }

    .category-filter {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .category-btn {
        padding: 8px 15px;
        background-color: var(--fahasa-light-gray);
        border: none;
        border-radius: 20px;
        color: var(--fahasa-dark);
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
    }

    .category-btn:hover,
    .category-btn.active {
        background-color: var(--fahasa-red);
        color: white;
    }

    .sort-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .results-info {
        color: var(--fahasa-gray);
        font-size: 14px;
    }

    .sort-options select {
        padding: 8px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: white;
    }

    .news-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 30px;
        margin-bottom: 40px;
    }

    .news-card {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s, box-shadow 0.3s;
        text-decoration: none;
        color: inherit;
    }

    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }

    .news-image {
        height: 200px;
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .news-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .news-content {
        padding: 20px;
    }

    .news-category {
        background-color: var(--fahasa-red);
        color: white;
        padding: 4px 10px;
        border-radius: 15px;
        font-size: 0.8rem;
        display: inline-block;
        margin-bottom: 10px;
    }

    .news-title {
        font-weight: 600;
        font-size: 1.2rem;
        margin-bottom: 10px;
        color: var(--fahasa-dark);
    }

    .news-title:hover {
        color: var(--fahasa-red);
    }

    .news-summary {
        color: var(--fahasa-gray);
        margin-bottom: 15px;
        line-height: 1.6;
    }

    .news-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: var(--fahasa-gray);
        font-size: 0.9rem;
        border-top: 1px solid var(--fahasa-light-gray);
        padding-top: 15px;
    }

    .news-author {
        font-weight: 500;
    }

    .news-date {
        font-size: 0.8rem;
    }

    .news-stats {
        display: flex;
        gap: 15px;
        font-size: 0.8rem;
    }

    .news-stats i {
        margin-right: 3px;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 30px;
    }

    .page-item {
        margin: 0 5px;
    }

    .page-link {
        display: block;
        padding: 8px 15px;
        border: 1px solid #ddd;
        text-decoration: none;
        color: var(--fahasa-dark);
        border-radius: 4px;
        transition: all 0.3s;
    }

    .page-link:hover,
    .page-link.active {
        background-color: var(--fahasa-red);
        color: white;
        border-color: var(--fahasa-red);
    }

    .no-results {
        text-align: center;
        padding: 50px 20px;
        color: var(--fahasa-gray);
    }

    .no-results i {
        font-size: 48px;
        margin-bottom: 15px;
        color: var(--fahasa-light-gray);
    }

    .no-results h4 {
        color: var(--fahasa-dark);
        margin-bottom: 10px;
    }

    @media (max-width: 767.98px) {
        .news-grid {
            grid-template-columns: 1fr;
        }
        
        .search-form {
            flex-direction: column;
        }
        
        .sort-section {
            flex-direction: column;
            align-items: stretch;
        }
        
        .news-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
    }
</style>

<!-- Breadcrumb -->
<div class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fas fa-home"></i> Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tin tức</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Main Content -->
<div class="container">
    <h1 class="page-title">Tin tức & Bài viết</h1>

    <!-- Search Section -->
    <div class="search-section">
        <form method="GET" action="<?= BASE_URL ?>news" class="search-form">
            <div class="search-input">
                <input type="text" 
                       name="search" 
                       placeholder="Tìm kiếm bài viết, tiêu đề, nội dung..." 
                       value="<?= htmlspecialchars($search ?? '') ?>">
                <button type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <button type="submit" class="btn" style="background-color: var(--fahasa-red); color: white; border: none; padding: 8px 20px; border-radius: 4px;">
                <i class="fas fa-search"></i> Tìm kiếm
            </button>
        </form>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="filter-title">
            <i class="fas fa-filter"></i>
            <h3>Danh mục bài viết</h3>
        </div>
        <div class="category-filter">
            <a href="?category=all" class="category-btn <?= $category == 'all' || $category == '' ? 'active' : '' ?>">Tất cả</a>
            <a href="?category=kien-thuc" class="category-btn <?= $category == 'kien-thuc' ? 'active' : '' ?>">Kiến thức</a>
            <a href="?category=sach-hay" class="category-btn <?= $category == 'sach-hay' ? 'active' : '' ?>">Sách hay</a>
            <a href="?category=van-hoa" class="category-btn <?= $category == 'van-hoa' ? 'active' : '' ?>">Văn hóa đọc</a>
            <a href="?category=giao-duc" class="category-btn <?= $category == 'giao-duc' ? 'active' : '' ?>">Giáo dục</a>
            <a href="?category=cong-nghe" class="category-btn <?= $category == 'cong-nghe' ? 'active' : '' ?>">Công nghệ</a>
            <a href="?category=ky-nang" class="category-btn <?= $category == 'ky-nang' ? 'active' : '' ?>">Kỹ năng sống</a>
        </div>
    </div>

    <!-- Sort and Results Info -->
    <div class="sort-section">
        <div class="results-info">
            <strong><?= $totalArticles ?></strong> bài viết
            <?php if (!empty($search)): ?>
                cho từ khóa "<strong><?= htmlspecialchars($search) ?></strong>"
            <?php endif; ?>
            <?php if (!empty($category)): ?>
                trong danh mục <strong><?= ucfirst(str_replace('-', ' ', $category)) ?></strong>
            <?php endif; ?>
        </div>
        <div class="sort-options">
            <select name="sort" id="sortSelect" onchange="handleSortChange(this.value)">
                <option value="">Sắp xếp theo</option>
                <option value="date-new" <?= (isset($_GET['sort']) && $_GET['sort'] == 'date-new') ? 'selected' : '' ?>>Ngày đăng: Mới nhất</option>
                <option value="date-old" <?= (isset($_GET['sort']) && $_GET['sort'] == 'date-old') ? 'selected' : '' ?>>Ngày đăng: Cũ nhất</option>
                <option value="views" <?= (isset($_GET['sort']) && $_GET['sort'] == 'views') ? 'selected' : '' ?>>Lượt xem</option>
                <option value="comments" <?= (isset($_GET['sort']) && $_GET['sort'] == 'comments') ? 'selected' : '' ?>>Bình luận</option>
                <option value="title-asc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'title-asc') ? 'selected' : '' ?>>Tiêu đề: A-Z</option>
                <option value="title-desc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'title-desc') ? 'selected' : '' ?>>Tiêu đề: Z-A</option>
            </select>
        </div>
    </div>

    <!-- News Grid -->
    <?php if (!empty($articles)): ?>
        <div class="news-grid">
            <?php foreach ($articles as $article): ?>
                <a href="<?= BASE_URL ?>news/detail/<?= $article['id'] ?>" class="news-card">
                    <div class="news-image">
                        <img src="<?= BASE_URL . ($article['image_url'] ?? 'images/news-page/default.jpg') ?>" alt="<?= htmlspecialchars($article['title']) ?>">
                    </div>
                    <div class="news-content">
                        <div class="news-category"><?= ucfirst(str_replace('-', ' ', ($article['category'] ?? 'Tin tức'))) ?></div>
                        <h3 class="news-title"><?= htmlspecialchars($article['title']) ?></h3>
                        <p class="news-summary"><?= htmlspecialchars($article['summary'] ?? '') ?></p>
                        <div class="news-meta">
                            <div class="news-author"><?= htmlspecialchars($article['author_name'] ?? 'Admin') ?></div>
                            <div class="news-date"><?= date('d/m/Y', strtotime($article['published_date'] ?? $article['created_at'])) ?></div>
                            <div class="news-stats">
                                <span title="Lượt xem"><i class="fas fa-eye"></i> <?= $article['views'] ?? 0 ?></span>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
            <nav class="pagination">
                <ul class="pagination-list">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?><?= !empty($search) ? '&search=' . urlencode($search) : '' ?><?= !empty($category) ? '&category=' . urlencode($category) : '' ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    <?php else: ?>
        <div class="no-results">
            <i class="fas fa-search"></i>
            <h4>Không tìm thấy bài viết nào</h4>
            <p>Vui lòng thử lại với từ khóa khác</p>
        </div>
    <?php endif; ?>
</div>

<script>
    function handleSortChange(sortValue) {
        const urlParams = new URLSearchParams(window.location.search);
        if (sortValue) {
            urlParams.set('sort', sortValue);
        } else {
            urlParams.delete('sort');
        }
        urlParams.delete('page'); // Reset page when sorting
        window.location.search = urlParams.toString();
    }
</script>

<?php require_once APP_ROOT . '/views/components/footer.php'; ?>