<?php
/**
 * NewsModel - Quản lý tin tức
 */
class NewsModel extends DB
{
  /**
   * Lấy danh sách tin tức có lọc, tìm kiếm, phân trang
   */
  public function getFilteredNews($options = [])
  {
    $search = $options['search'] ?? '';
    $category = $options['category'] ?? '';
    $limit = $options['limit'] ?? 9;
    $offset = $options['offset'] ?? 0;

    $sql = "SELECT n.*, u.fullname as author_name
            FROM news n
            LEFT JOIN users u ON n.author_id = u.user_id";

    $params = [];
    $whereClauses = [];

    // Tìm kiếm theo từ khóa
    if (!empty($search)) {
      $whereClauses[] = "(n.title LIKE :search1 OR n.summary LIKE :search2 OR n.content LIKE :search3)";
      $params[':search1'] = '%' . $search . '%';
      $params[':search2'] = '%' . $search . '%';
      $params[':search3'] = '%' . $search . '%';
    }

    // Lọc theo danh mục
    if (!empty($category) && $category !== 'all') {
      $whereClauses[] = "n.category = :category";
      $params[':category'] = $category;
    }

    if (count($whereClauses) > 0) {
      $sql .= " WHERE " . implode(' AND ', $whereClauses);
    }

    $sql .= " ORDER BY n.created_at DESC";
    $sql .= " LIMIT " . (int)$limit . " OFFSET " . (int)$offset;

    return $this->all($sql, $params);
  }

  /**
   * Đếm tổng số tin tức (cho phân trang)
   */
  public function countFilteredNews($options = [])
  {
    $search = $options['search'] ?? '';
    $category = $options['category'] ?? '';

    $sql = "SELECT COUNT(*) as total FROM news n";

    $params = [];
    $whereClauses = [];

    if (!empty($search)) {
      $whereClauses[] = "(n.title LIKE :search1 OR n.summary LIKE :search2 OR n.content LIKE :search3)";
      $params[':search1'] = '%' . $search . '%';
      $params[':search2'] = '%' . $search . '%';
      $params[':search3'] = '%' . $search . '%';
    }

    if (!empty($category) && $category !== 'all') {
      $whereClauses[] = "n.category = :category";
      $params[':category'] = $category;
    }

    if (count($whereClauses) > 0) {
      $sql .= " WHERE " . implode(' AND ', $whereClauses);
    }

    $result = $this->single($sql, $params);
    return $result['total'] ?? 0;
  }

  /**
   * Lấy tất cả tin tức
   */
  public function getAllNews()
  {
    $sql = "SELECT n.*, u.fullname as author_name
            FROM news n
            LEFT JOIN users u ON n.author_id = u.user_id
            ORDER BY n.created_at DESC";
    return $this->all($sql);
  }

  /**
   * Lấy tin tức theo ID
   */
  public function getNewsById($id)
  {
    $sql = "SELECT n.*, u.fullname as author_name
            FROM news n
            LEFT JOIN users u ON n.author_id = u.user_id
            WHERE n.id = :id
            LIMIT 1";
    return $this->single($sql, ['id' => $id]);
  }

  /**
   * Tăng lượt xem
   */
  public function incrementViews($id)
  {
    $sql = "UPDATE news SET views = views + 1 WHERE id = :id";
    return $this->query($sql, ['id' => $id]);
  }

  /**
   * Lấy tin tức liên quan (cùng category)
   */
  public function getRelatedNews($category, $currentId, $limit = 3)
  {
    $sql = "SELECT n.*, u.fullname as author_name
            FROM news n
            LEFT JOIN users u ON n.author_id = u.user_id
            WHERE n.category = :category AND n.id != :current_id
            ORDER BY n.created_at DESC
            LIMIT " . (int)$limit;

    return $this->all($sql, [
      'category' => $category,
      'current_id' => $currentId
    ]);
  }

  /**
   * Lấy tin tức mới nhất
   */
  public function getLatestNews($limit = 5)
  {
    $sql = "SELECT n.*, u.fullname as author_name
            FROM news n
            LEFT JOIN users u ON n.author_id = u.user_id
            ORDER BY n.created_at DESC
            LIMIT " . (int)$limit;
    return $this->all($sql);
  }

  /**
   * Lấy tin tức hot (nhiều view nhất)
   */
  public function getHotNews($limit = 5)
  {
    $sql = "SELECT n.*, u.fullname as author_name
            FROM news n
            LEFT JOIN users u ON n.author_id = u.user_id
            ORDER BY n.views DESC
            LIMIT " . (int)$limit;
    return $this->all($sql);
  }

  /**
   * Lấy tất cả category
   */
  public function getAllCategories()
  {
    $sql = "SELECT DISTINCT category FROM news WHERE category IS NOT NULL ORDER BY category";
    return $this->all($sql);
  }

  // ============== ADMIN METHODS ==============

  /**
   * Tạo tin tức mới
   */
  public function createNews($data)
  {
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

  /**
   * Cập nhật tin tức
   */
  public function updateNews($id, $data)
  {
    $sql = "UPDATE news
            SET title = :title,
                summary = :summary,
                content = :content,
                category = :category,
                image_url = :image_url,
                published_date = :published_date
            WHERE id = :id";

    return $this->query($sql, [
      'id' => $id,
      'title' => $data['title'],
      'summary' => $data['summary'] ?? null,
      'content' => $data['content'],
      'category' => $data['category'] ?? null,
      'image_url' => $data['image_url'],
      'published_date' => $data['published_date'] ?? date('Y-m-d')
    ]);
  }

  /**
   * Xóa tin tức
   */
  public function deleteNews($id)
  {
    $sql = "DELETE FROM news WHERE id = :id";
    return $this->query($sql, ['id' => $id]);
  }
}