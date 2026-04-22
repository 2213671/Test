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

    .article-header {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--fahasa-light-gray);
    }

    .article-category {
        background-color: var(--fahasa-red);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
        display: inline-block;
        margin-bottom: 15px;
    }

    .article-title {
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--fahasa-dark);
        margin-bottom: 15px;
        line-height: 1.3;
    }

    .article-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        color: var(--fahasa-gray);
        margin-bottom: 20px;
        font-size: 0.95rem;
    }

    .article-author {
        display: flex;
        align-items: center;
    }

    .article-author i {
        margin-right: 8px;
    }

    .article-date {
        display: flex;
        align-items: center;
    }

    .article-date i {
        margin-right: 8px;
    }

    .article-stats {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .article-stats i {
        margin-right: 5px;
    }

    .article-image {
        width: 100%;
        height: 400px;
        overflow: hidden;
        border-radius: 8px;
        margin-bottom: 25px;
    }

    .article-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .article-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: var(--fahasa-dark);
        margin-bottom: 40px;
    }

    .article-content p {
        margin-bottom: 1.5rem;
    }

    .article-content h2 {
        color: var(--fahasa-red);
        margin: 2rem 0 1rem 0;
        font-size: 1.8rem;
    }

    .article-content h3 {
        color: var(--fahasa-dark);
        margin: 1.5rem 0 1rem 0;
        font-size: 1.5rem;
    }

    .article-content ul,
    .article-content ol {
        padding-left: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .article-content li {
        margin-bottom: 0.5rem;
    }

    .social-share {
        display: flex;
        gap: 15px;
        margin: 30px 0;
        padding: 20px 0;
        border-top: 1px solid var(--fahasa-light-gray);
        border-bottom: 1px solid var(--fahasa-light-gray);
    }

    .social-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 30px;
        text-decoration: none;
        color: white;
        font-weight: 500;
        transition: transform 0.3s;
    }

    .social-btn:hover {
        transform: translateY(-2px);
    }

    .social-btn.facebook {
        background-color: #3b5998;
    }

    .social-btn.twitter {
        background-color: #1da1f2;
    }

    .social-btn.linkedin {
        background-color: #0077b5;
    }

    .social-btn.whatsapp {
        background-color: #25d366;
    }

    .related-articles {
        margin-top: 50px;
    }

    .section-title {
        color: var(--fahasa-red);
        font-weight: 700;
        margin-bottom: 30px;
        position: relative;
        padding-bottom: 15px;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 80px;
        height: 3px;
        background-color: var(--fahasa-orange);
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
    }

    .related-card {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s, box-shadow 0.3s;
        text-decoration: none;
        color: inherit;
    }

    .related-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }

    .related-image {
        height: 180px;
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .related-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .related-content {
        padding: 15px;
    }

    .related-title {
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 1rem;
        color: var(--fahasa-dark);
    }

    .related-title:hover {
        color: var(--fahasa-red);
    }

    .related-meta {
        display: flex;
        justify-content: space-between;
        color: var(--fahasa-gray);
        font-size: 0.85rem;
    }

    .related-date {
        font-size: 0.8rem;
    }

    .article-navigation {
        display: flex;
        justify-content: space-between;
        margin: 40px 0;
        padding: 20px 0;
        border-top: 1px solid var(--fahasa-light-gray);
        border-bottom: 1px solid var(--fahasa-light-gray);
    }

    .nav-link {
        display: block;
        padding: 10px 20px;
        background-color: var(--fahasa-light-gray);
        border-radius: 4px;
        text-decoration: none;
        color: var(--fahasa-dark);
        transition: background-color 0.3s;
        max-width: 45%;
    }

    .nav-link:hover {
        background-color: var(--fahasa-red);
        color: white;
    }

    .nav-next {
        margin-left: auto;
        text-align: right;
    }

    /* Comment Section Styles */
    .comments-section {
        margin: 50px 0;
        padding: 40px;
        background-color: #f8f9fa;
        border-radius: 8px;
    }

    .comments-section .section-title {
        margin-bottom: 30px;
    }

    .comments-section .section-title i {
        margin-right: 10px;
        color: var(--fahasa-orange);
    }

    .comment-form-container {
        background: white;
        padding: 30px;
        border-radius: 8px;
        margin-bottom: 40px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .comment-form-title {
        color: var(--fahasa-dark);
        font-weight: 600;
        margin-bottom: 20px;
        font-size: 1.2rem;
    }

    .comment-form .form-control {
        border: 1px solid #ddd;
        padding: 12px 15px;
        border-radius: 4px;
        transition: border-color 0.3s;
    }

    .comment-form .form-control:focus {
        border-color: var(--fahasa-orange);
        box-shadow: 0 0 0 0.2rem rgba(247, 148, 30, 0.25);
    }

    .comment-submit-btn {
        background-color: var(--fahasa-red);
        border: none;
        padding: 12px 30px;
        font-weight: 500;
        transition: background-color 0.3s, transform 0.2s;
    }

    .comment-submit-btn:hover {
        background-color: #a51b1f;
        transform: translateY(-2px);
    }

    .comment-submit-btn i {
        margin-right: 8px;
    }

    .comments-list {
        margin-top: 40px;
    }

    .comments-list-title {
        color: var(--fahasa-dark);
        font-weight: 600;
        margin-bottom: 25px;
        font-size: 1.2rem;
    }

    .comment-item {
        display: flex;
        gap: 15px;
        background: white;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .comment-avatar {
        flex-shrink: 0;
    }

    .comment-avatar i {
        font-size: 3rem;
        color: var(--fahasa-gray);
    }

    .comment-content {
        flex: 1;
    }

    .comment-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
        flex-wrap: wrap;
    }

    .comment-author {
        font-weight: 600;
        color: var(--fahasa-dark);
    }

    .comment-badge {
        background-color: var(--fahasa-orange);
        color: white;
        padding: 2px 10px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .comment-date {
        color: var(--fahasa-gray);
        font-size: 0.85rem;
    }

    .comment-text {
        color: var(--fahasa-dark);
        line-height: 1.6;
        margin-bottom: 15px;
    }

    .comment-actions {
        display: flex;
        gap: 15px;
    }

    .comment-action-btn {
        background: none;
        border: none;
        color: var(--fahasa-gray);
        font-size: 0.9rem;
        cursor: pointer;
        transition: color 0.3s;
        padding: 5px 0;
    }

    .comment-action-btn:hover {
        color: var(--fahasa-red);
    }

    .comment-action-btn i {
        margin-right: 5px;
    }

    .comment-reply {
        margin-top: 15px;
        margin-left: 50px;
        border-left: 3px solid var(--fahasa-light-gray);
        padding-left: 20px;
    }

    .comment-reply .comment-item {
        background-color: #f8f9fa;
    }

    #loadMoreComments {
        padding: 10px 30px;
        border: 2px solid var(--fahasa-gray);
        color: var(--fahasa-gray);
        font-weight: 500;
        transition: all 0.3s;
    }

    #loadMoreComments:hover {
        background-color: var(--fahasa-red);
        border-color: var(--fahasa-red);
        color: white;
    }

    @media (max-width: 767.98px) {
        .article-title {
            font-size: 1.8rem;
        }
        
        .article-meta {
            flex-direction: column;
            gap: 10px;
        }
        
        .article-image {
            height: 250px;
        }
        
        .social-share {
            flex-direction: column;
        }
        
        .article-navigation {
            flex-direction: column;
            gap: 15px;
        }
        
        .nav-link {
            max-width: 100%;
            text-align: center;
        }
        
        .nav-next {
            margin-left: 0;
            text-align: center;
        }

        .comments-section {
            padding: 20px;
        }

        .comment-form-container {
            padding: 20px;
        }

        .comment-item {
            flex-direction: column;
            gap: 10px;
        }

        .comment-avatar i {
            font-size: 2.5rem;
        }

        .comment-reply {
            margin-left: 20px;
            padding-left: 15px;
        }
    }
</style>

<!-- Breadcrumb -->
<div class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fas fa-home"></i> Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>news">Tin tức</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($article['title']) ?></li>
            </ol>
        </nav>
    </div>
</div>

<!-- Main Content -->
<div class="container">
    <article class="article">
        <header class="article-header">
            <div class="article-category"><?= ucfirst(str_replace('-', ' ', $article['category'])) ?></div>
            <h1 class="article-title"><?= htmlspecialchars($article['title']) ?></h1>
            <div class="article-meta">
                <div class="article-author">
                    <i class="fas fa-user"></i>
                    <span><?= htmlspecialchars($article['author_name'] ?? 'Admin') ?></span>
                </div>
                <div class="article-date">
                    <i class="fas fa-calendar-alt"></i>
                    <span><?= date('d/m/Y', strtotime($article['published_date'] ?? $article['created_at'])) ?></span>
                </div>
                <div class="article-stats">
                    <span><i class="fas fa-eye"></i> <?= $article['views'] ?? 0 ?> lượt xem</span>
                </div>
            </div>
            <div class="article-image">
                <img src="<?= BASE_URL . ($article['image_url'] ?? 'images/news-page/default.jpg') ?>" alt="<?= htmlspecialchars($article['title']) ?>">
            </div>
        </header>
        
        <div class="article-content">
            <?php 
            // Replace literal '\n' with actual newline
            $content = str_replace('\\n', "\n", $article['content']);
            
            // Now proceed with htmlspecialchars and splitting
            $content = htmlspecialchars($content);
            $paragraphs = explode("\n", $content);
            
            foreach ($paragraphs as $paragraph):
                $paragraph = trim($paragraph);
                if (!empty($paragraph)):
                    echo "<p>" . $paragraph . "</p>";
                endif;
            endforeach;
            ?>
        </div>
        
        <div class="social-share">
            <a href="#" class="social-btn facebook">
                <i class="fab fa-facebook-f"></i>
                Chia sẻ
            </a>
            <a href="#" class="social-btn twitter">
                <i class="fab fa-twitter"></i>
                Tweet
            </a>
            <a href="#" class="social-btn linkedin">
                <i class="fab fa-linkedin-in"></i>
                LinkedIn
            </a>
            <a href="#" class="social-btn whatsapp">
                <i class="fab fa-whatsapp"></i>
                WhatsApp
            </a>
        </div>
        
        <!-- Comment Section -->
        <div class="comments-section">
            <h2 class="section-title">
                <i class="fas fa-comments"></i> Bình luận
            </h2>
            
            <!-- Comment Form -->
            <div class="comment-form-container">
                <h4 class="comment-form-title">Để lại bình luận của bạn</h4>
                <form class="comment-form" id="commentForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" name="name" placeholder="Họ và tên *" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email *" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="comment" rows="5" placeholder="Nội dung bình luận *" required></textarea>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="saveInfo">
                        <label class="form-check-label" for="saveInfo">
                            Lưu tên và email để sử dụng cho lần bình luận tiếp theo
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary comment-submit-btn">
                        <i class="fas fa-paper-plane"></i> Gửi bình luận
                    </button>
                </form>
            </div>
            
            <!-- Comments List -->
            <div class="comments-list">
                <h4 class="comments-list-title">Các bình luận</h4>
                
                <!-- Sample Comments (Mock Data) -->
                <div class="comment-item">
                    <div class="comment-avatar">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="comment-content">
                        <div class="comment-header">
                            <span class="comment-author">Nguyễn Văn An</span>
                            <span class="comment-date">2 ngày trước</span>
                        </div>
                        <div class="comment-text">
                            Bài viết rất hay và bổ ích! Tôi đã học được nhiều điều từ bài viết này. Cảm ơn tác giả đã chia sẻ những kiến thức quý báu.
                        </div>
                        <div class="comment-actions">
                            <button class="comment-action-btn"><i class="fas fa-thumbs-up"></i> Thích (5)</button>
                            <button class="comment-action-btn"><i class="fas fa-reply"></i> Trả lời</button>
                        </div>
                    </div>
                </div>
                
                <div class="comment-item">
                    <div class="comment-avatar">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="comment-content">
                        <div class="comment-header">
                            <span class="comment-author">Trần Thị Bình</span>
                            <span class="comment-date">5 ngày trước</span>
                        </div>
                        <div class="comment-text">
                            Thông tin trong bài viết rất hữu ích. Mình đã áp dụng một số phương pháp và thấy hiệu quả rõ rệt. Chúc tác giả có nhiều sức khỏe để tiếp tục viết thêm nhiều bài hay!
                        </div>
                        <div class="comment-actions">
                            <button class="comment-action-btn"><i class="fas fa-thumbs-up"></i> Thích (3)</button>
                            <button class="comment-action-btn"><i class="fas fa-reply"></i> Trả lời</button>
                        </div>
                    </div>
                </div>
                
                <div class="comment-item">
                    <div class="comment-avatar">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="comment-content">
                        <div class="comment-header">
                            <span class="comment-author">Lê Quang Khải</span>
                            <span class="comment-date">1 tuần trước</span>
                        </div>
                        <div class="comment-text">
                            Cảm ơn tác giả đã chia sẻ! Mình rất thích phần phân tích chi tiết và rõ ràng. Hy vọng sẽ có thêm nhiều bài viết về chủ đề này.
                        </div>
                        <div class="comment-actions">
                            <button class="comment-action-btn"><i class="fas fa-thumbs-up"></i> Thích (8)</button>
                            <button class="comment-action-btn"><i class="fas fa-reply"></i> Trả lời</button>
                        </div>
                        
                        <!-- Reply Comment -->
                        <div class="comment-reply">
                            <div class="comment-item">
                                <div class="comment-avatar">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                <div class="comment-content">
                                    <div class="comment-header">
                                        <span class="comment-author"><?= htmlspecialchars($article['author']) ?></span>
                                        <span class="comment-badge">Tác giả</span>
                                        <span class="comment-date">6 ngày trước</span>
                                    </div>
                                    <div class="comment-text">
                                        Cảm ơn bạn đã quan tâm! Mình sẽ cố gắng viết thêm nhiều bài về chủ đề này trong thời gian tới.
                                    </div>
                                    <div class="comment-actions">
                                        <button class="comment-action-btn"><i class="fas fa-thumbs-up"></i> Thích (2)</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Load More Button -->
                <div class="text-center mt-4">
                    <button class="btn btn-outline-secondary" id="loadMoreComments">
                        <i class="fas fa-sync-alt"></i> Xem thêm bình luận
                    </button>
                </div>
            </div>
        </div>
        
        <?php if (!empty($relatedArticles)): ?>
        <div class="related-articles">
            <h2 class="section-title">Bài viết liên quan</h2>
            <div class="related-grid">
                <?php foreach ($relatedArticles as $related): ?>
                    <a href="<?= BASE_URL ?>news/detail/<?= $related['id'] ?>" class="related-card">
                        <div class="related-image">
                            <img src="<?= BASE_URL . $related['image'] ?>" alt="<?= htmlspecialchars($related['title']) ?>">
                        </div>
                        <div class="related-content">
                            <h3 class="related-title"><?= htmlspecialchars($related['title']) ?></h3>
                            <div class="related-meta">
                                <div class="related-author"><?= htmlspecialchars($related['author']) ?></div>
                                <div class="related-date"><?= date('d/m', strtotime($related['published_date'])) ?></div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </article>
</div>

<script>
// Comment Form Handling
document.addEventListener('DOMContentLoaded', function() {
    const commentForm = document.getElementById('commentForm');
    const saveInfoCheckbox = document.getElementById('saveInfo');
    
    // Load saved user info from localStorage
    const savedName = localStorage.getItem('commentUserName');
    const savedEmail = localStorage.getItem('commentUserEmail');
    
    if (savedName) {
        commentForm.querySelector('input[name="name"]').value = savedName;
        saveInfoCheckbox.checked = true;
    }
    
    if (savedEmail) {
        commentForm.querySelector('input[name="email"]').value = savedEmail;
    }
    
    // Handle form submission
    commentForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = {
            name: commentForm.querySelector('input[name="name"]').value.trim(),
            email: commentForm.querySelector('input[name="email"]').value.trim(),
            comment: commentForm.querySelector('textarea[name="comment"]').value.trim()
        };
        
        // Validation
        if (!formData.name || !formData.email || !formData.comment) {
            alert('Vui lòng điền đầy đủ thông tin!');
            return;
        }
        
        // Email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(formData.email)) {
            alert('Email không hợp lệ!');
            return;
        }
        
        // Save user info if checkbox is checked
        if (saveInfoCheckbox.checked) {
            localStorage.setItem('commentUserName', formData.name);
            localStorage.setItem('commentUserEmail', formData.email);
        } else {
            localStorage.removeItem('commentUserName');
            localStorage.removeItem('commentUserEmail');
        }
        
        // Simulate AJAX submission
        // In production, this would send data to server
        const submitBtn = commentForm.querySelector('.comment-submit-btn');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang gửi...';
        submitBtn.disabled = true;
        
        setTimeout(function() {
            // Success simulation
            submitBtn.innerHTML = '<i class="fas fa-check"></i> Đã gửi!';
            
            // Show success message
            const successMessage = document.createElement('div');
            successMessage.className = 'alert alert-success mt-3';
            successMessage.innerHTML = '<i class="fas fa-check-circle"></i> Bình luận của bạn đã được gửi thành công! Chúng tôi sẽ xem xét và phê duyệt trong thời gian sớm nhất.';
            commentForm.parentNode.insertBefore(successMessage, commentForm.nextSibling);
            
            // Reset form
            commentForm.querySelector('textarea[name="comment"]').value = '';
            
            // Restore button after 3 seconds
            setTimeout(function() {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                successMessage.remove();
            }, 3000);
        }, 1500);
    });
    
    // Handle "Load More Comments" button
    const loadMoreBtn = document.getElementById('loadMoreComments');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            const icon = this.querySelector('i');
            const originalText = this.innerHTML;
            
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang tải...';
            this.disabled = true;
            
            // Simulate loading more comments
            setTimeout(function() {
                loadMoreBtn.innerHTML = originalText;
                loadMoreBtn.disabled = false;
                
                // In production, this would load more comments from server
                alert('Đã hiển thị tất cả bình luận!');
            }, 1000);
        });
    }
    
    // Handle comment actions (like, reply)
    document.querySelectorAll('.comment-action-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const action = this.textContent.trim();
            
            if (action.includes('Thích')) {
                // Handle like action
                const currentText = this.innerHTML;
                const match = currentText.match(/\((\d+)\)/);
                if (match) {
                    const currentCount = parseInt(match[1]);
                    const newCount = currentCount + 1;
                    this.innerHTML = currentText.replace(`(${currentCount})`, `(${newCount})`);
                    this.style.color = 'var(--fahasa-orange)';
                }
            } else if (action.includes('Trả lời')) {
                // Handle reply action
                // In production, this would show a reply form
                alert('Chức năng trả lời đang được phát triển!');
            }
        });
    });
});
</script>

<?php require_once APP_ROOT . '/views/components/footer.php'; ?>