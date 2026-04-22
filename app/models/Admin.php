<?php
class Admin extends DB {

    // ================= TASK 1: QUẢN LÝ CẤU HÌNH (SETTINGS) =================
    
    public function getSettings() {
        $result = $this->all("SELECT * FROM settings");
        $settings = [];
        if ($result) {
            foreach ($result as $row) {
                $settings[$row['key_name']] = $row['value'];
            }
        }
        return $settings;
    }

    public function updateSetting($key, $value) {
        return $this->query("UPDATE settings SET value = :value WHERE key_name = :key", 
            ['value' => $value, 'key' => $key]
        );
    }

    // ================= TASK 1: QUẢN LÝ LIÊN HỆ (CONTACTS) =================

    public function getAllContacts() {
        return $this->all("SELECT * FROM contacts ORDER BY created_at DESC");
    }

    public function deleteContact($id) {
        return $this->query("DELETE FROM contacts WHERE id = :id", ['id' => $id]);
    }

    // ================= TASK 2: QUẢN LÝ TRANG (PAGES) =================

    public function getPageContent($pageName) {
        $result = $this->single("SELECT content FROM pages WHERE page_name = :page", ['page' => $pageName]);
        return $result ? $result['content'] : '';
    }

    public function updatePageContent($pageName, $content) {
        $check = $this->getPageContent($pageName);
        
        if ($check !== '') {
            $sql = "UPDATE pages SET content = :content, updated_at = NOW() WHERE page_name = :page";
        } else {
            $sql = "INSERT INTO pages (page_name, content, created_at) VALUES (:page, :content, NOW())";
        }
        return $this->query($sql, ['page' => $pageName, 'content' => $content]);
    }

    // ================= TASK 2: QUẢN LÝ HỎI ĐÁP (QA) =================

    public function getAllQA() {
        return $this->all("SELECT * FROM qa ORDER BY id DESC");
    }

    public function createQA($question, $answer, $category) {
        $sql = "INSERT INTO qa (question, answer, category) VALUES (:q, :a, :c)";
        return $this->query($sql, ['q' => $question, 'a' => $answer, 'c' => $category]);
    }

    public function deleteQA($id) {
        return $this->query("DELETE FROM qa WHERE id = :id", ['id' => $id]);
    }



// ================= QUẢN LÝ TIN TỨC (NEWS) =================
    public function getAllArticles() {
        $sql = "SELECT n.*, u.fullname as author_name
                FROM news n
                LEFT JOIN users u ON n.author_id = u.user_id
                ORDER BY n.created_at DESC";
        return $this->all($sql);
    }

    public function getArticleById($id) {
        $sql = "SELECT n.*, u.fullname as author_name
                FROM news n
                LEFT JOIN users u ON n.author_id = u.user_id
                WHERE n.id = :id
                LIMIT 1";
        return $this->single($sql, ['id' => $id]);
    }

    public function addArticle($data) {
        $sql = "INSERT INTO news (title, summary, content, category, image_url, published_date, author_id)
                VALUES (:title, :summary, :content, :category, :image_url, :published_date, :author_id)";
        return $this->query($sql, [
            'title' => $data['title'],
            'summary' => $data['summary'] ?? null,
            'content' => $data['content'],
            'category' => $data['category'] ?? null,
            'image_url' => $data['image_url'] ?? null,
            'published_date' => $data['published_date'] ?? date('Y-m-d'),
            'author_id' => $data['author_id']
        ]);
    }

    public function updateArticle($id, $data) {
        $sql = "UPDATE news
                SET title = :title,
                    summary = :summary,
                    content = :content,
                    category = :category";

        $params = [
            'id' => $id,
            'title' => $data['title'],
            'summary' => $data['summary'] ?? null,
            'content' => $data['content'],
            'category' => $data['category'] ?? null
        ];

        // Nếu có ảnh mới thì update
        if (!empty($data['image_url'])) {
            $sql .= ", image_url = :image_url";
            $params['image_url'] = $data['image_url'];
        }

        $sql .= " WHERE id = :id";

        return $this->query($sql, $params);
    }

    public function deleteArticle($id) {
        return $this->query("DELETE FROM news WHERE id = :id", ['id' => $id]);
    }

    // ================= QUẢN LÝ SẢN PHẨM (PRODUCTS) =================
    public function getAllProducts() {
        return $this->all("SELECT * FROM product ORDER BY product_id DESC");
    }

    public function getProductById($id) {
        return $this->single("SELECT * FROM product WHERE product_id = :id", ['id' => $id]);
    }

    public function addProduct($data) {
        $sql = "INSERT INTO product (title, price, old_price, description, stock_quantity, publisher)
                VALUES (:title, :price, :old_price, :description, :stock_quantity, :publisher)";
        return $this->query($sql, $data);
    }

    public function updateProduct($id, $data) {
        $sql = "UPDATE product SET title=:title, price=:price, old_price=:old_price,
                description=:description, stock_quantity=:stock_quantity, publisher=:publisher
                WHERE product_id=:id";
        $data['id'] = $id;
        return $this->query($sql, $data);
    }

    public function deleteProduct($id) {
        return $this->query("DELETE FROM product WHERE product_id = :id", ['id' => $id]);
    }

    // ================= QUẢN LÝ ĐƠN HÀNG (ORDERS) =================

    public function getAllOrders() {
        $sql = "SELECT
                    o.order_id,
                    o.user_id,
                    o.recipient_name,
                    o.recipient_phone,
                    o.shipping_address,
                    o.payment_method,
                    o.subtotal,
                    o.shipping_fee,
                    o.total_amount as total,
                    o.status,
                    o.note,
                    o.created_at as created_date,
                    o.updated_at,
                    u.fullname as customer_name,
                    u.email as customer_email,
                    u.phone as customer_phone
                FROM orders o
                LEFT JOIN users u ON o.user_id = u.user_id
                ORDER BY o.created_at DESC, o.order_id DESC";
        return $this->all($sql);
    }

    public function getOrderById($orderId) {
        $sql = "SELECT
                    o.order_id,
                    o.user_id,
                    o.recipient_name,
                    o.recipient_phone,
                    o.shipping_address,
                    o.payment_method,
                    o.subtotal,
                    o.shipping_fee,
                    o.total_amount as total,
                    o.status,
                    o.note,
                    o.created_at as created_date,
                    o.updated_at,
                    u.fullname as customer_name,
                    u.email as customer_email,
                    u.phone as customer_phone
                FROM orders o
                LEFT JOIN users u ON o.user_id = u.user_id
                WHERE o.order_id = :order_id";
        return $this->single($sql, ['order_id' => $orderId]);
    }

    public function getOrderItems($orderId) {
        $sql = "SELECT
                    op.product_id,
                    op.quantity,
                    op.price,
                    op.subtotal,
                    p.title,
                    pi.image_url,
                    GROUP_CONCAT(ap.author_name SEPARATOR ', ') as author
                FROM order_product op
                JOIN product p ON op.product_id = p.product_id
                LEFT JOIN product_image pi ON p.product_id = pi.product_id
                LEFT JOIN author_of_product ap ON p.product_id = ap.product_id
                WHERE op.order_id = :order_id
                GROUP BY op.product_id, op.order_id";
        return $this->all($sql, ['order_id' => $orderId]);
    }

    public function updateOrderStatus($orderId, $status) {
        $sql = "UPDATE orders SET status = :status, updated_at = NOW() WHERE order_id = :order_id";
        return $this->query($sql, ['status' => $status, 'order_id' => $orderId]);
    }

    public function deleteOrder($orderId) {
        return $this->query("DELETE FROM orders WHERE order_id = :order_id", ['order_id' => $orderId]);
    }

    public function getOrderStats() {
        $sql = "SELECT
                    COUNT(*) as total_orders,
                    SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending_orders,
                    SUM(CASE WHEN status = 'processing' THEN 1 ELSE 0 END) as processing_orders,
                    SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed_orders,
                    SUM(CASE WHEN status = 'cancelled' THEN 1 ELSE 0 END) as cancelled_orders,
                    SUM(total_amount) as total_revenue
                FROM orders";
        return $this->single($sql);
    }

    // ================= QUẢN LÝ KHÁCH HÀNG (CUSTOMERS) =================

    public function getAllCustomers() {
        $sql = "SELECT
                    u.user_id,
                    u.fullname,
                    u.email,
                    u.phone,
                    u.created_date,
                    c.member_type,
                    c.total_fpoint,
                    COUNT(DISTINCT o.order_id) as total_orders,
                    SUM(CASE WHEN o.status = 'completed' THEN o.total_amount ELSE 0 END) as total_spent
                FROM users u
                LEFT JOIN customer c ON u.user_id = c.user_id
                LEFT JOIN orders o ON u.user_id = o.user_id
                WHERE u.role = 'customer'
                GROUP BY u.user_id
                ORDER BY u.created_date DESC";
        return $this->all($sql);
    }

    public function getCustomerById($customerId) {
        $sql = "SELECT
                    u.user_id,
                    u.fullname,
                    u.email,
                    u.phone,
                    u.note,
                    u.created_date,
                    c.member_type,
                    c.total_fpoint
                FROM users u
                LEFT JOIN customer c ON u.user_id = c.user_id
                WHERE u.user_id = :customer_id AND u.role = 'customer'";
        return $this->single($sql, ['customer_id' => $customerId]);
    }

    public function getCustomerOrders($customerId) {
        $sql = "SELECT
                    o.order_id,
                    o.created_at as created_date,
                    o.status,
                    o.total_amount as total,
                    o.shipping_fee,
                    o.payment_method,
                    COUNT(DISTINCT op.product_id) as total_items
                FROM orders o
                LEFT JOIN order_product op ON o.order_id = op.order_id
                WHERE o.user_id = :customer_id
                GROUP BY o.order_id
                ORDER BY o.created_at DESC";
        return $this->all($sql, ['customer_id' => $customerId]);
    }

    public function getCustomerStats($customerId) {
        $sql = "SELECT
                    COUNT(DISTINCT o.order_id) as total_orders,
                    SUM(CASE WHEN o.status = 'completed' THEN o.total_amount ELSE 0 END) as total_spent,
                    SUM(CASE WHEN o.status = 'pending' THEN 1 ELSE 0 END) as pending_orders,
                    SUM(CASE WHEN o.status = 'completed' THEN 1 ELSE 0 END) as completed_orders
                FROM orders o
                WHERE o.user_id = :customer_id";
        return $this->single($sql, ['customer_id' => $customerId]);
    }

    public function deleteCustomer($customerId) {
        // Xóa customer record
        $this->query("DELETE FROM customer WHERE user_id = :id", ['id' => $customerId]);
        // Xóa user record
        return $this->query("DELETE FROM users WHERE user_id = :id AND role = 'customer'", ['id' => $customerId]);
    }

    // ================= QUẢN LÝ DANH MỤC (CATEGORIES) =================

    public function getAllCategories() {
        // Kiểm tra xem bảng category_product có tồn tại không
        try {
            $sql = "SELECT
                        c.category_id,
                        c.category_name,
                        c.description,
                        COUNT(DISTINCT cp.product_id) as total_products
                    FROM category c
                    LEFT JOIN category_product cp ON c.category_id = cp.category_id
                    GROUP BY c.category_id
                    ORDER BY c.category_name ASC";
            return $this->all($sql);
        } catch (Exception $e) {
            // Nếu bảng category_product chưa tồn tại, chỉ lấy từ category
            $sql = "SELECT
                        category_id,
                        category_name,
                        description,
                        0 as total_products
                    FROM category
                    ORDER BY category_name ASC";
            return $this->all($sql);
        }
    }

    public function getCategoryById($categoryId) {
        $sql = "SELECT * FROM category WHERE category_id = :category_id";
        return $this->single($sql, ['category_id' => $categoryId]);
    }

    public function createCategory($data) {
        $sql = "INSERT INTO category (category_name, description)
                VALUES (:category_name, :description)";
        return $this->query($sql, $data);
    }

    public function updateCategory($categoryId, $data) {
        $sql = "UPDATE category
                SET category_name = :category_name,
                    description = :description
                WHERE category_id = :category_id";
        $data['category_id'] = $categoryId;
        return $this->query($sql, $data);
    }

    public function deleteCategory($categoryId) {
        // Xóa liên kết category-product trước (nếu có ON DELETE CASCADE thì không cần)
        $this->query("DELETE FROM category_product WHERE category_id = :id", ['id' => $categoryId]);
        // Xóa category
        return $this->query("DELETE FROM category WHERE category_id = :id", ['id' => $categoryId]);
    }
}