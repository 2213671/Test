<?php

class ProductModel extends DB
{
  /**
   * Lấy sản phẩm có kèm filter, phân trang và join các bảng liên quan
   */
  public function getFilteredProducts($options = [])
  {
    // Default options
    $search = $options['search'] ?? '';
    $category_id = $options['category_id'] ?? null;
    $sort = $options['sort'] ?? '';
    $limit = $options['limit'] ?? 12;
    $offset = $options['offset'] ?? 0;

    $sql = "SELECT
                p.*,
                pi.image_url,
                aop.author_name as author
            FROM product p
            LEFT JOIN (
                SELECT product_id, image_url
                FROM product_image
                GROUP BY product_id
            ) AS pi ON p.product_id = pi.product_id
            LEFT JOIN author_of_product aop ON p.product_id = aop.product_id
            LEFT JOIN category_product cp ON p.product_id = cp.product_id";

    $params = [];
    $whereClauses = [];

    if (!empty($search)) {
      $whereClauses[] = "(p.title LIKE :search1 OR aop.author_name LIKE :search2)";
      $params[':search1'] = '%' . $search . '%';
      $params[':search2'] = '%' . $search . '%';
    }

    if (!empty($category_id) && is_numeric($category_id)) {
      $whereClauses[] = "cp.category_id = :category_id";
      $params[':category_id'] = $category_id;
    }

    if (count($whereClauses) > 0) {
      $sql .= " WHERE " . implode(' AND ', $whereClauses);
    }

    $sql .= " GROUP BY p.product_id";

    // Thêm ORDER BY clause dựa trên sort parameter
    $orderClause = " ORDER BY p.product_id DESC"; // Mặc định
    if ($sort == 'price-asc') {
      $orderClause = " ORDER BY p.price ASC";
    } elseif ($sort == 'price-desc') {
      $orderClause = " ORDER BY p.price DESC";
    } elseif ($sort == 'name-asc') {
      $orderClause = " ORDER BY p.title ASC";
    } elseif ($sort == 'name-desc') {
      $orderClause = " ORDER BY p.title DESC";
    }
    $sql .= $orderClause;

    // Thêm LIMIT và OFFSET trực tiếp vào SQL (đã ép kiểu int nên an toàn)
    $sql .= " LIMIT " . (int)$limit . " OFFSET " . (int)$offset;

    $result = $this->query($sql, $params);
    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Đếm tổng số sản phẩm dựa trên filter (để phân trang)
   */
  public function countFilteredProducts($options = [])
  {
    $search = $options['search'] ?? '';
    $category_id = $options['category_id'] ?? null;

    // A simplified query to count distinct products
    $sql = "SELECT COUNT(DISTINCT p.product_id) as total
            FROM product p
            LEFT JOIN author_of_product aop ON p.product_id = aop.product_id
            LEFT JOIN category_product cp ON p.product_id = cp.product_id";
    
    $params = [];
    $whereClauses = [];

    if (!empty($search)) {
      $whereClauses[] = "(p.title LIKE :search1 OR aop.author_name LIKE :search2)";
      $params[':search1'] = '%' . $search . '%';
      $params[':search2'] = '%' . $search . '%';
    }

    if (!empty($category_id) && is_numeric($category_id)) {
      $whereClauses[] = "cp.category_id = :category_id";
      $params[':category_id'] = $category_id;
    }

    if (count($whereClauses) > 0) {
      $sql .= " WHERE " . implode(' AND ', $whereClauses);
    }

    $result = $this->query($sql, $params);
    return $result->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
  }


  /**
   * Lấy thông tin chi tiết của một sản phẩm
   */
  public function getProductDetailsById($id)
  {
    $sql = "SELECT 
                p.*, 
                pi.image_url, 
                aop.author_name as author,
                cp.category_id
            FROM product p
            LEFT JOIN (
                SELECT product_id, image_url 
                FROM product_image 
                GROUP BY product_id
            ) AS pi ON p.product_id = pi.product_id
            LEFT JOIN author_of_product aop ON p.product_id = aop.product_id
            LEFT JOIN category_product cp ON p.product_id = cp.product_id
            WHERE p.product_id = :id
            GROUP BY p.product_id";

    $result = $this->query($sql, [':id' => $id]);
    return $result->fetch(PDO::FETCH_ASSOC);
  }

  /**
   * Lấy các sản phẩm liên quan (cùng danh mục)
   */
  public function getRelatedProducts($categoryId, $currentProductId, $limit = 4)
  {
    $sql = "SELECT
                p.*,
                pi.image_url,
                aop.author_name as author
            FROM product p
            JOIN category_product cp ON p.product_id = cp.product_id
            LEFT JOIN (
                SELECT product_id, image_url
                FROM product_image
                GROUP BY product_id
            ) AS pi ON p.product_id = pi.product_id
            LEFT JOIN author_of_product aop ON p.product_id = aop.product_id
            WHERE cp.category_id = :category_id AND p.product_id != :current_product_id
            GROUP BY p.product_id
            LIMIT :limit";

    $params = [
        ':category_id' => $categoryId,
        ':current_product_id' => $currentProductId,
        ':limit' => $limit
    ];

    $result = $this->query($sql, $params);
    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * ================= ADMIN CRUD METHODS =================
   */

  /**
   * Lấy tất cả sản phẩm cho admin (với đầy đủ thông tin)
   */
  public function getAllProductsForAdmin()
  {
    $sql = "SELECT
                p.*,
                pi.image_url,
                aop.author_name as author,
                c.category_name,
                cp.category_id
            FROM product p
            LEFT JOIN (
                SELECT product_id, image_url
                FROM product_image
                GROUP BY product_id
            ) AS pi ON p.product_id = pi.product_id
            LEFT JOIN author_of_product aop ON p.product_id = aop.product_id
            LEFT JOIN category_product cp ON p.product_id = cp.product_id
            LEFT JOIN category c ON cp.category_id = c.category_id
            GROUP BY p.product_id
            ORDER BY p.product_id DESC";

    return $this->all($sql);
  }

  /**
   * Thêm sản phẩm mới
   */
  public function createProduct($data)
  {
    $sql = "INSERT INTO product (title, price, old_price, description, stock_quantity,
            publisher, published_date, supplier, year, language, pages, product_type, weight, dimensions, size)
            VALUES (:title, :price, :old_price, :description, :stock_quantity,
            :publisher, :published_date, :supplier, :year, :language, :pages, :product_type, :weight, :dimensions, :size)";

    $result = $this->query($sql, $data);
    return $this->pdo->lastInsertId(); // Trả về ID sản phẩm vừa tạo
  }

  /**
   * Cập nhật thông tin sản phẩm
   */
  public function updateProduct($productId, $data)
  {
    $sql = "UPDATE product SET
            title = :title,
            price = :price,
            old_price = :old_price,
            description = :description,
            stock_quantity = :stock_quantity,
            publisher = :publisher,
            published_date = :published_date,
            supplier = :supplier,
            year = :year,
            language = :language,
            pages = :pages,
            product_type = :product_type,
            weight = :weight,
            dimensions = :dimensions,
            size = :size
            WHERE product_id = :product_id";

    $data['product_id'] = $productId;
    return $this->query($sql, $data);
  }

  /**
   * Xóa sản phẩm (và các dữ liệu liên quan sẽ tự động xóa nhờ ON DELETE CASCADE)
   */
  public function deleteProduct($productId)
  {
    $sql = "DELETE FROM product WHERE product_id = :product_id";
    return $this->query($sql, [':product_id' => $productId]);
  }

  /**
   * Thêm ảnh cho sản phẩm
   */
  public function addProductImage($productId, $imageUrl)
  {
    $sql = "INSERT INTO product_image (product_id, image_url) VALUES (:product_id, :image_url)";
    return $this->query($sql, [
      ':product_id' => $productId,
      ':image_url' => $imageUrl
    ]);
  }

  /**
   * Xóa tất cả ảnh của sản phẩm
   */
  public function deleteProductImages($productId)
  {
    $sql = "DELETE FROM product_image WHERE product_id = :product_id";
    return $this->query($sql, [':product_id' => $productId]);
  }

  /**
   * Thêm tác giả cho sản phẩm
   */
  public function addProductAuthor($productId, $authorName)
  {
    $sql = "INSERT INTO author_of_product (product_id, author_name) VALUES (:product_id, :author_name)";
    return $this->query($sql, [
      ':product_id' => $productId,
      ':author_name' => $authorName
    ]);
  }

  /**
   * Xóa tác giả của sản phẩm
   */
  public function deleteProductAuthors($productId)
  {
    $sql = "DELETE FROM author_of_product WHERE product_id = :product_id";
    return $this->query($sql, [':product_id' => $productId]);
  }

  /**
   * Thêm danh mục cho sản phẩm
   */
  public function addProductCategory($productId, $categoryId)
  {
    $sql = "INSERT INTO category_product (product_id, category_id) VALUES (:product_id, :category_id)";
    return $this->query($sql, [
      ':product_id' => $productId,
      ':category_id' => $categoryId
    ]);
  }

  /**
   * Xóa danh mục của sản phẩm
   */
  public function deleteProductCategories($productId)
  {
    $sql = "DELETE FROM category_product WHERE product_id = :product_id";
    return $this->query($sql, [':product_id' => $productId]);
  }

  /**
   * Lấy danh sách product_id theo mảng IDs (cho cart localStorage)
   */
  public function getProductsByIds($productIds)
  {
    if (empty($productIds)) {
      return [];
    }

    $placeholders = implode(',', array_fill(0, count($productIds), '?'));
    $sql = "SELECT
                p.*,
                pi.image_url,
                aop.author_name as author
            FROM product p
            LEFT JOIN (
                SELECT product_id, image_url
                FROM product_image
                GROUP BY product_id
            ) AS pi ON p.product_id = pi.product_id
            LEFT JOIN author_of_product aop ON p.product_id = aop.product_id
            WHERE p.product_id IN ($placeholders)
            GROUP BY p.product_id";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($productIds);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function getById($id) {
        return $this->single("SELECT id, name, image, price, old_price, author, rating, sold FROM products WHERE id = :id", ['id'=>$id]);
    }

  public function getByIds(array $ids) {
        if (empty($ids)) return [];
        $in = implode(',', array_fill(0, count($ids), '?'));
        // your DB->all may not accept positional params; adapt if needed
        $sql = "SELECT id, name, image, price, old_price, author, rating, sold FROM products WHERE id IN ($in)";
        return $this->all($sql, $ids);
  }
}