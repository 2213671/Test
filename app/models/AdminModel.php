<?php
class AdminModel extends DB {

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
        return $this->all("SELECT * FROM articles ORDER BY published_date DESC");
    }

    public function getArticleById($id) {
        return $this->single("SELECT * FROM articles WHERE id = :id", ['id' => $id]);
    }

    public function addArticle($data) {
        $sql = "INSERT INTO articles (title, summary, content, image, category, author, published_date) 
                VALUES (:title, :summary, :content, :image, :category, :author, NOW())";
        return $this->query($sql, $data);
    }

    public function updateArticle($id, $data) {
        // Nếu có ảnh mới thì update cả ảnh, không thì giữ nguyên
        if (!empty($data['image'])) {
            $sql = "UPDATE articles SET title=:title, summary=:summary, content=:content, image=:image, category=:category WHERE id=:id";
        } else {
            $sql = "UPDATE articles SET title=:title, summary=:summary, content=:content, category=:category WHERE id=:id";
            unset($data['image']); // Bỏ key image khỏi mảng data
        }
        $data['id'] = $id; // Thêm id vào mảng tham số
        return $this->query($sql, $data);
    }

    public function deleteArticle($id) {
        return $this->query("DELETE FROM articles WHERE id = :id", ['id' => $id]);
    }

    // ================= QUẢN LÝ SẢN PHẨM (PRODUCTS) =================
    public function getAllProducts() {
        return $this->all("SELECT * FROM products ORDER BY id DESC");
    }

    public function getProductById($id) {
        return $this->single("SELECT * FROM products WHERE id = :id", ['id' => $id]);
    }

    public function addProduct($data) {
        $sql = "INSERT INTO products (name, price, old_price, description, image, category) 
                VALUES (:name, :price, :old, :desc, :image, :cat)";
        return $this->query($sql, $data);
    }

    public function updateProduct($id, $data) {
        if (!empty($data['image'])) {
            $sql = "UPDATE products SET name=:name, price=:price, old_price=:old, description=:desc, image=:image, category=:cat WHERE id=:id";
        } else {
            $sql = "UPDATE products SET name=:name, price=:price, old_price=:old, description=:desc, category=:cat WHERE id=:id";
            unset($data['image']);
        }
        $data['id'] = $id;
        return $this->query($sql, $data);
    }

    public function deleteProduct($id) {
        return $this->query("DELETE FROM products WHERE id = :id", ['id' => $id]);
    }
}