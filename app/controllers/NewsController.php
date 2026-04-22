<?php
/**
 * NEWS CONTROLLER
 * Trang Danh sách bài viết và Chi tiết bài viết
 */

class NewsController extends Controller {

    private $newsModel;

    public function __construct() {
        $this->newsModel = $this->model('NewsModel');
    }

    /**
     * Trang danh sách bài viết
     */
    public function index() {
        $search = trim($_GET['search'] ?? '');
        $category = $_GET['category'] ?? '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 9; // Số bài viết trên mỗi trang
        $offset = ($page - 1) * $limit;

        // Lấy dữ liệu từ database
        $options = [
            'search' => $search,
            'category' => $category,
            'limit' => $limit,
            'offset' => $offset
        ];

        $articles = $this->newsModel->getFilteredNews($options);
        $totalArticles = $this->newsModel->countFilteredNews($options);
        $totalPages = ceil($totalArticles / $limit);

        // Lấy danh sách category
        $categories = $this->newsModel->getAllCategories();

        $data = [
            'title' => 'Tin tức - ' . APP_NAME,
            'page' => 'news',
            'articles' => $articles,
            'categories' => $categories,
            'search' => $search,
            'selectedCategory' => $category,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalArticles' => $totalArticles
        ];

        $this->view('news/index', $data);
    }

    /**
     * Trang chi tiết bài viết
     */
    public function detail($id) {
        // Lấy bài viết từ database
        $article = $this->newsModel->getNewsById($id);

        if (!$article) {
            // Nếu không tìm thấy bài viết, chuyển hướng về trang danh sách
            header('Location: ' . BASE_URL . 'news');
            exit;
        }

        // Tăng lượt xem
        $this->newsModel->incrementViews($id);

        // Lấy bài viết liên quan (cùng danh mục)
        $relatedArticles = [];
        if (!empty($article['category'])) {
            $relatedArticles = $this->newsModel->getRelatedNews($article['category'], $id, 3);
        }

        $data = [
            'title' => $article['title'] . ' - ' . APP_NAME,
            'page' => 'news',
            'article' => $article,
            'relatedArticles' => $relatedArticles
        ];

        $this->view('news/detail', $data);
    }
}
