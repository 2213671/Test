<?php
class AdminController extends Controller {

    private $adminModel;
    private $productModel;
    private $categoryModel;

    public function __construct() {
        // Khởi tạo Model 1 lần dùng cho toàn bộ controller
        $this->adminModel = $this->model('Admin');
        $this->productModel = $this->model('ProductModel');
        $this->categoryModel = $this->model('CategoryModel');

        // Check quyền admin ở đây nếu cần
        if (!isset($_SESSION['users_role']) || $_SESSION['users_role'] !== 'admin') {
            $this->redirect('home');
        }
    }

    public function index() {
        $data = [
            'title' => 'Dashboard',
            'page' => 'dashboard',
            'contentFile' => APP_ROOT . '/views/admin/dashboard/index.php'
        ];
        $this->view('admin/admin', $data);
    }

    // --- TASK #1: CẤU HÌNH & LIÊN HỆ ---

    public function settings() {
    if ($this->isPost()) {
        // Lấy dữ liệu từ form POST
        $phone = $_POST['phone'] ?? '';
        $email = $_POST['email'] ?? '';
        $address = $_POST['address'] ?? '';

        // Cập nhật từng cài đặt
        $this->adminModel->updateSetting('phone', $phone);
        $this->adminModel->updateSetting('email', $email);
        $this->adminModel->updateSetting('address', $address);

        // Redirect tránh reload bị lặp lại submit
        $this->redirect('admin/settings');
    }

    // Lấy dữ liệu settings hiện tại để đổ ra form
    $settings = $this->adminModel->getSettings();

    $data = [
        'title' => 'Cài đặt Website',
        'page' => 'settings',
        'settings' => $settings,
        'contentFile' => APP_ROOT . '/views/admin/settings/index.php'
    ];

    $this->view('admin/admin', $data);
}

    public function contacts() {
        $data = [
            'title' => 'Quản lý Liên hệ',
            'page' => 'contacts',
            'contacts' => $this->adminModel->getAllContacts(),
            'contentFile' => APP_ROOT . '/views/admin/contacts/index.php'
        ];
        $this->view('admin/admin', $data);
    }

    public function deleteContact() {
        if ($this->isPost()) {
            $this->adminModel->deleteContact($_POST['id']);
            $this->redirect('admin/contacts');
        }
    }

    // --- TASK #2: GIỚI THIỆU & QA ---

    public function pageContent() {
        $page = $_GET['page'] ?? 'about';
        
        if ($this->isPost()) {
            $this->adminModel->updatePageContent($page, $_POST['content']);
            $this->redirect("admin/pageContent?page=$page");
        }
        
        $data = [
            'currPage' => $page,
            'content' => $this->adminModel->getPageContent($page)
        ];
        $this->view('admin/pages/edit', $data);
    }

    public function qa() {
        $data = [
            'title' => 'Quản lý Hỏi/Đáp',
            'page' => 'qa',
            'qaList' => $this->adminModel->getAllQA(),
            'contentFile' => APP_ROOT . '/views/admin/qa/index.php'
        ];
        $this->view('admin/admin', $data);
    }



    public function createQa() {
        if ($this->isPost()) {
            $this->adminModel->createQA($_POST['question'], $_POST['answer'], $_POST['category']);
            $this->redirect('admin/qa');
        } else {
            $this->view('admin/qa/create');
        }
    }

    public function deleteQa() {
        // Lưu ý: Thực tế nên dùng POST để xóa an toàn hơn
        $id = $_GET['id'] ?? 0;
        $this->adminModel->deleteQA($id);
        $this->redirect('admin/qa');
    }
    // --- HELPER: UPLOAD ẢNH ---
    private function uploadImage($file) {
        if (isset($file) && $file['error'] == 0) {
            $target_dir = "images/uploads/"; // Lưu trong public/images/uploads/
            // Tạo thư mục nếu chưa có (bạn cần tự tạo folder này thủ công 1 lần)
            $fileName = time() . '_' . basename($file["name"]);
            $target_file = ROOT . '/public/' . $target_dir . $fileName;
            
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                return $target_dir . $fileName; // Trả về đường dẫn để lưu DB
            }
        }
        return null;
    }

    // ================= NEWS CONTROLLER LOGIC =================
    public function news() {
        $data = [
            'title' => 'Quản lý Tin tức',
            'page' => 'news',
            'articles' => $this->adminModel->getAllArticles(),
            'contentFile' => APP_ROOT . '/views/admin/news/index.php'
        ];
        $this->view('admin/admin', $data);
    }

    public function createNews() {
        if ($this->isPost()) {
            $imagePath = $this->uploadImage($_FILES['image']);
            $data = [
                'title' => $_POST['title'],
                'summary' => $_POST['summary'],
                'content' => $_POST['content'],
                'category' => $_POST['category'],
                'image_url' => $imagePath ?? 'images/default-news.jpg',
                'published_date' => $_POST['published_date'] ?? date('Y-m-d'),
                'author_id' => $_SESSION['users_id'] ?? null
            ];
            $this->adminModel->addArticle($data);
            $this->redirect('admin/news');
        }

        $data = [
            'title' => 'Thêm bài viết mới',
            'page' => 'news',
            'contentFile' => APP_ROOT . '/views/admin/news/create.php'
        ];
        $this->view('admin/admin', $data);
    }

    public function editNews() {
        $id = $_GET['id'] ?? 0;
        if ($this->isPost()) {
            $imagePath = $this->uploadImage($_FILES['image']);
            $data = [
                'title' => $_POST['title'],
                'summary' => $_POST['summary'],
                'content' => $_POST['content'],
                'category' => $_POST['category']
            ];
            if ($imagePath) $data['image_url'] = $imagePath;

            $this->adminModel->updateArticle($id, $data);
            $this->redirect('admin/news');
        }

        $data = [
            'title' => 'Sửa bài viết',
            'page' => 'news',
            'article' => $this->adminModel->getArticleById($id),
            'contentFile' => APP_ROOT . '/views/admin/news/edit.php'
        ];
        $this->view('admin/admin', $data);
    }

    public function deleteNews() {
        $id = $_GET['id'] ?? 0;
        $this->adminModel->deleteArticle($id);
        $this->redirect('admin/news');
    }

    // ================= PRODUCT CONTROLLER LOGIC =================
    public function products() {
        $data = [
            'title' => 'Quản lý sản phẩm',
            'page' => 'products',
            'products' => $this->productModel->getAllProductsForAdmin(),
            'contentFile' => APP_ROOT . '/views/admin/products/index.php'
        ];
        $this->view('admin/admin', $data);
    }

    public function createProduct() {
        if ($this->isPost()) {
            // Chuẩn bị dữ liệu sản phẩm
            $productData = [
                ':title' => $_POST['title'] ?? '',
                ':price' => $_POST['price'] ?? 0,
                ':old_price' => $_POST['old_price'] ?? null,
                ':description' => $_POST['description'] ?? '',
                ':stock_quantity' => $_POST['stock_quantity'] ?? 0,
                ':publisher' => $_POST['publisher'] ?? null,
                ':published_date' => $_POST['published_date'] ?? null,
                ':supplier' => $_POST['supplier'] ?? null,
                ':year' => $_POST['year'] ?? null,
                ':language' => $_POST['language'] ?? null,
                ':pages' => $_POST['pages'] ?? null,
                ':product_type' => $_POST['product_type'] ?? null,
                ':weight' => $_POST['weight'] ?? null,
                ':dimensions' => $_POST['dimensions'] ?? null,
                ':size' => $_POST['size'] ?? null
            ];

            // Tạo sản phẩm và lấy ID
            $productId = $this->productModel->createProduct($productData);

            // Thêm ảnh nếu có
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $imagePath = $this->uploadImage($_FILES['image']);
                if ($imagePath) {
                    $this->productModel->addProductImage($productId, $imagePath);
                }
            }

            // Thêm tác giả nếu có
            if (!empty($_POST['author'])) {
                $this->productModel->addProductAuthor($productId, $_POST['author']);
            }

            // Thêm danh mục nếu có
            if (!empty($_POST['category_id'])) {
                $this->productModel->addProductCategory($productId, $_POST['category_id']);
            }

            $this->redirect('admin/products');
        }

        // Load categories cho form
        $data = [
            'title' => 'Thêm sản phẩm mới',
            'page' => 'products',
            'categories' => $this->categoryModel->getAllCategories(),
            'contentFile' => APP_ROOT . '/views/admin/products/create.php'
        ];
        $this->view('admin/admin', $data);
    }

    public function editProduct($id) {
        if ($this->isPost()) {
            // Cập nhật thông tin sản phẩm
            $productData = [
                ':title' => $_POST['title'] ?? '',
                ':price' => $_POST['price'] ?? 0,
                ':old_price' => $_POST['old_price'] ?? null,
                ':description' => $_POST['description'] ?? '',
                ':stock_quantity' => $_POST['stock_quantity'] ?? 0,
                ':publisher' => $_POST['publisher'] ?? null,
                ':published_date' => $_POST['published_date'] ?? null,
                ':supplier' => $_POST['supplier'] ?? null,
                ':year' => $_POST['year'] ?? null,
                ':language' => $_POST['language'] ?? null,
                ':pages' => $_POST['pages'] ?? null,
                ':product_type' => $_POST['product_type'] ?? null,
                ':weight' => $_POST['weight'] ?? null,
                ':dimensions' => $_POST['dimensions'] ?? null,
                ':size' => $_POST['size'] ?? null
            ];

            $this->productModel->updateProduct($id, $productData);

            // Cập nhật ảnh nếu có upload mới
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $imagePath = $this->uploadImage($_FILES['image']);
                if ($imagePath) {
                    // Xóa ảnh cũ và thêm ảnh mới
                    $this->productModel->deleteProductImages($id);
                    $this->productModel->addProductImage($id, $imagePath);
                }
            }

            // Cập nhật tác giả
            if (!empty($_POST['author'])) {
                $this->productModel->deleteProductAuthors($id);
                $this->productModel->addProductAuthor($id, $_POST['author']);
            }

            // Cập nhật danh mục
            if (!empty($_POST['category_id'])) {
                $this->productModel->deleteProductCategories($id);
                $this->productModel->addProductCategory($id, $_POST['category_id']);
            }

            $this->redirect('admin/products');
        }

        // Load dữ liệu để hiển thị form
        $product = $this->productModel->getProductDetailsById($id);
        $data = [
            'title' => 'Sửa sản phẩm: ' . ($product['title'] ?? ''),
            'page' => 'products',
            'product' => $product,
            'categories' => $this->categoryModel->getAllCategories(),
            'contentFile' => APP_ROOT . '/views/admin/products/edit.php'
        ];
        $this->view('admin/admin', $data);
    }

    public function deleteProduct() {
        $id = $_GET['id'] ?? 0;
        if ($id > 0) {
            // Xóa sản phẩm (các bảng liên quan sẽ tự động xóa nhờ ON DELETE CASCADE)
            $this->productModel->deleteProduct($id);
        }
        $this->redirect('admin/products');
    }

    // ================= ORDER CONTROLLER LOGIC =================
    public function orders() {
        $data = [
            'title' => 'Quản lý Đơn hàng',
            'page' => 'orders',
            'orders' => $this->adminModel->getAllOrders(),
            'stats' => $this->adminModel->getOrderStats(),
            'contentFile' => APP_ROOT . '/views/admin/orders/index.php'
        ];
        $this->view('admin/admin', $data);
    }

    public function orderDetail($orderId) {
        $order = $this->adminModel->getOrderById($orderId);
        if (!$order) {
            $this->redirect('admin/orders');
            return;
        }

        $data = [
            'title' => 'Chi tiết đơn hàng #' . $orderId,
            'page' => 'orders',
            'order' => $order,
            'items' => $this->adminModel->getOrderItems($orderId),
            'contentFile' => APP_ROOT . '/views/admin/orders/detail.php'
        ];
        $this->view('admin/admin', $data);
    }

    public function updateOrderStatus() {
        if ($this->isPost()) {
            $orderId = $_POST['order_id'] ?? 0;
            $status = $_POST['status'] ?? '';

            if ($orderId > 0 && !empty($status)) {
                $this->adminModel->updateOrderStatus($orderId, $status);
            }

            // Redirect về trang chi tiết đơn hàng hoặc danh sách
            if (isset($_POST['return_to_detail'])) {
                $this->redirect('admin/orderDetail/' . $orderId);
            } else {
                $this->redirect('admin/orders');
            }
        }
    }

    public function deleteOrder() {
        $id = $_GET['id'] ?? 0;
        if ($id > 0) {
            $this->adminModel->deleteOrder($id);
        }
        $this->redirect('admin/orders');
    }

    /**
     * API endpoint để lấy chi tiết đơn hàng (AJAX)
     */
    public function getOrderDetailAjax() {
        header('Content-Type: application/json');

        $orderId = $_GET['order_id'] ?? 0;

        if (!$orderId) {
            echo json_encode(['success' => false, 'message' => 'Thiếu order_id']);
            return;
        }

        $order = $this->adminModel->getOrderById($orderId);

        if (!$order) {
            echo json_encode(['success' => false, 'message' => 'Không tìm thấy đơn hàng']);
            return;
        }

        $items = $this->adminModel->getOrderItems($orderId);

        // Map status text
        $statusMap = [
            'pending' => 'Chờ xử lý',
            'processing' => 'Đang xử lý',
            'shipped' => 'Đang giao',
            'completed' => 'Hoàn thành',
            'cancelled' => 'Đã hủy'
        ];

        echo json_encode([
            'success' => true,
            'order' => [
                'order_id' => $order['order_id'],
                'created_date' => $order['created_date'],
                'recipient_name' => $order['recipient_name'],
                'recipient_phone' => $order['recipient_phone'],
                'shipping_address' => $order['shipping_address'],
                'payment_method' => $order['payment_method'],
                'status' => $order['status'],
                'status_text' => $statusMap[$order['status']] ?? $order['status'],
                'subtotal' => $order['subtotal'],
                'shipping_fee' => $order['shipping_fee'],
                'total' => $order['total'],
                'note' => $order['note']
            ],
            'items' => $items
        ]);
    }

    // ================= CUSTOMER CONTROLLER LOGIC =================
    public function customers() {
        $data = [
            'title' => 'Quản lý Khách hàng',
            'page' => 'customers',
            'customers' => $this->adminModel->getAllCustomers(),
            'contentFile' => APP_ROOT . '/views/admin/customers/index.php'
        ];
        $this->view('admin/admin', $data);
    }

    public function customerDetail($customerId) {
        $customer = $this->adminModel->getCustomerById($customerId);
        if (!$customer) {
            $this->redirect('admin/customers');
            return;
        }

        $data = [
            'title' => 'Chi tiết khách hàng: ' . $customer['fullname'],
            'page' => 'customers',
            'customer' => $customer,
            'orders' => $this->adminModel->getCustomerOrders($customerId),
            'stats' => $this->adminModel->getCustomerStats($customerId),
            'contentFile' => APP_ROOT . '/views/admin/customers/detail.php'
        ];
        $this->view('admin/admin', $data);
    }

    public function deleteCustomer() {
        $id = $_GET['id'] ?? 0;
        if ($id > 0) {
            $this->adminModel->deleteCustomer($id);
        }
        $this->redirect('admin/customers');
    }

    // ================= CATEGORY CONTROLLER LOGIC =================
    public function categories() {
        $data = [
            'title' => 'Quản lý Danh mục',
            'page' => 'categories',
            'categories' => $this->adminModel->getAllCategories(),
            'contentFile' => APP_ROOT . '/views/admin/categories/index.php'
        ];
        $this->view('admin/admin', $data);
    }

    public function createCategory() {
        if ($this->isPost()) {
            $categoryData = [
                'category_name' => $_POST['category_name'] ?? '',
                'description' => $_POST['description'] ?? ''
            ];

            $this->adminModel->createCategory($categoryData);
            $this->redirect('admin/categories');
        }
    }

    public function updateCategory() {
        if ($this->isPost()) {
            $categoryId = $_POST['category_id'] ?? 0;
            $categoryData = [
                'category_name' => $_POST['category_name'] ?? '',
                'description' => $_POST['description'] ?? ''
            ];

            if ($categoryId > 0) {
                $this->adminModel->updateCategory($categoryId, $categoryData);
            }
            $this->redirect('admin/categories');
        }
    }

    public function deleteCategory() {
        $id = $_GET['id'] ?? 0;
        if ($id > 0) {
            $this->adminModel->deleteCategory($id);
        }
        $this->redirect('admin/categories');
    }
}