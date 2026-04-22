<?php
class Order {
    private $db;

    public function __construct() {
        $dbInstance = new DB();
        $this->db = $dbInstance->con;
    }

    /**
     * Tạo đơn hàng mới
     * @param array $orderData - Thông tin đơn hàng
     * @param array $products - Danh sách sản phẩm [{product_id, quantity, price}, ...]
     * @return int|false - order_id nếu thành công, false nếu thất bại
     */
    public function createOrder($orderData, $products) {
        try {
            // Bắt đầu transaction
            $this->db->beginTransaction();

            // 1. Insert vào bảng orders
            $query = "INSERT INTO orders
                      (user_id, recipient_name, recipient_phone, shipping_address,
                       payment_method, subtotal, shipping_fee, total_amount, status, note)
                      VALUES
                      (:user_id, :recipient_name, :recipient_phone, :shipping_address,
                       :payment_method, :subtotal, :shipping_fee, :total_amount, :status, :note)";

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':user_id', $orderData['user_id'], PDO::PARAM_INT);
            $stmt->bindParam(':recipient_name', $orderData['recipient_name'], PDO::PARAM_STR);
            $stmt->bindParam(':recipient_phone', $orderData['recipient_phone'], PDO::PARAM_STR);
            $stmt->bindParam(':shipping_address', $orderData['shipping_address'], PDO::PARAM_STR);
            $stmt->bindParam(':payment_method', $orderData['payment_method'], PDO::PARAM_STR);
            $stmt->bindParam(':subtotal', $orderData['subtotal'], PDO::PARAM_STR);
            $stmt->bindParam(':shipping_fee', $orderData['shipping_fee'], PDO::PARAM_STR);
            $stmt->bindParam(':total_amount', $orderData['total_amount'], PDO::PARAM_STR);

            $status = $orderData['status'] ?? 'pending';
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);

            $note = $orderData['note'] ?? null;
            $stmt->bindParam(':note', $note, PDO::PARAM_STR);

            $stmt->execute();

            // Lấy order_id vừa tạo
            $orderId = $this->db->lastInsertId();

            // 2. Insert vào bảng order_product
            $query = "INSERT INTO order_product
                      (order_id, product_id, quantity, price, subtotal)
                      VALUES
                      (:order_id, :product_id, :quantity, :price, :subtotal)";

            $stmt = $this->db->prepare($query);

            foreach ($products as $product) {
                $subtotal = $product['price'] * $product['quantity'];

                $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
                $stmt->bindParam(':product_id', $product['product_id'], PDO::PARAM_INT);
                $stmt->bindParam(':quantity', $product['quantity'], PDO::PARAM_INT);
                $stmt->bindParam(':price', $product['price'], PDO::PARAM_STR);
                $stmt->bindParam(':subtotal', $subtotal, PDO::PARAM_STR);

                $stmt->execute();
            }

            // Commit transaction
            $this->db->commit();

            return $orderId;

        } catch (Exception $e) {
            // Rollback nếu có lỗi
            $this->db->rollBack();
            error_log("Error creating order: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Lấy thông tin đơn hàng theo ID
     */
    public function getOrderById($orderId, $userId = null) {
        $query = "SELECT * FROM orders WHERE order_id = :order_id";

        if ($userId !== null) {
            $query .= " AND user_id = :user_id";
        }

        $query .= " LIMIT 1";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);

        if ($userId !== null) {
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        }

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Lấy danh sách sản phẩm trong đơn hàng
     */
    public function getOrderProducts($orderId) {
        $query = "SELECT op.*,
                         p.title,
                         pi.image_url,
                         GROUP_CONCAT(ap.author_name SEPARATOR ', ') as author
                  FROM order_product op
                  JOIN product p ON op.product_id = p.product_id
                  LEFT JOIN product_image pi ON p.product_id = pi.product_id
                  LEFT JOIN author_of_product ap ON p.product_id = ap.product_id
                  WHERE op.order_id = :order_id
                  GROUP BY op.order_id, op.product_id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Lấy tất cả đơn hàng của user
     */
    public function getOrdersByUserId($userId, $limit = 10, $offset = 0) {
        $query = "SELECT * FROM orders
                  WHERE user_id = :user_id
                  ORDER BY created_at DESC
                  LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Đếm tổng số đơn hàng của user
     */
    public function countOrdersByUserId($userId) {
        $query = "SELECT COUNT(*) as total FROM orders WHERE user_id = :user_id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    /**
     * Cập nhật trạng thái đơn hàng
     */
    public function updateOrderStatus($orderId, $status) {
        $query = "UPDATE orders SET status = :status WHERE order_id = :order_id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Hủy đơn hàng
     */
    public function cancelOrder($orderId, $userId) {
        $query = "UPDATE orders
                  SET status = 'cancelled', updated_at = NOW()
                  WHERE order_id = :order_id AND user_id = :user_id
                  AND status IN ('pending', 'processing')";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
