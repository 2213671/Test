<?php
/**
 * UserModel - Quản lý thông tin người dùng
 */
class UserModel extends DB {

    /**
     * Lấy thông tin user theo ID
     */
    public function getById($userId) {
        $sql = "SELECT user_id, fullname, email, phone, role, note, created_date
                FROM users
                WHERE user_id = :user_id
                LIMIT 1";
        return $this->single($sql, ['user_id' => $userId]);
    }

    /**
     * Lấy thông tin user theo email
     */
    public function getByEmail($email) {
        $sql = "SELECT user_id, fullname, email, phone, role, note, created_date
                FROM users
                WHERE email = :email
                LIMIT 1";
        return $this->single($sql, ['email' => $email]);
    }

    /**
     * Cập nhật thông tin cá nhân
     */
    public function updateProfile($userId, $data) {
        $sql = "UPDATE users
                SET fullname = :fullname,
                    email = :email,
                    phone = :phone
                WHERE user_id = :user_id";

        return $this->query($sql, [
            'user_id' => $userId,
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'phone' => $data['phone']
        ]);
    }

    /**
     * Kiểm tra email đã tồn tại chưa (trừ user hiện tại)
     */
    public function isEmailExists($email, $excludeUserId = null) {
        $sql = "SELECT user_id FROM users WHERE email = :email";

        if ($excludeUserId) {
            $sql .= " AND user_id != :exclude_id";
            $result = $this->single($sql, [
                'email' => $email,
                'exclude_id' => $excludeUserId
            ]);
        } else {
            $result = $this->single($sql, ['email' => $email]);
        }

        return $result !== false;
    }

    /**
     * Kiểm tra phone đã tồn tại chưa (trừ user hiện tại)
     */
    public function isPhoneExists($phone, $excludeUserId = null) {
        if (empty($phone)) return false;

        $sql = "SELECT user_id FROM users WHERE phone = :phone";

        if ($excludeUserId) {
            $sql .= " AND user_id != :exclude_id";
            $result = $this->single($sql, [
                'phone' => $phone,
                'exclude_id' => $excludeUserId
            ]);
        } else {
            $result = $this->single($sql, ['phone' => $phone]);
        }

        return $result !== false;
    }

    /**
     * Lấy tất cả users (cho admin)
     */
    public function getAllUsers() {
        $sql = "SELECT user_id, fullname, email, phone, role, created_date
                FROM users
                ORDER BY created_date DESC";
        return $this->all($sql);
    }

    /**
     * Tạo user mới
     */
    public function createUser($data) {
        $sql = "INSERT INTO users (fullname, email, phone, password, role, created_date)
                VALUES (:fullname, :email, :phone, :password, :role, NOW())";

        return $this->query($sql, [
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role' => $data['role'] ?? 'Customer'
        ]);
    }

    /**
     * Cập nhật mật khẩu
     */
    public function updatePassword($userId, $newPassword) {
        $sql = "UPDATE users
                SET password = :password
                WHERE user_id = :user_id";

        return $this->query($sql, [
            'user_id' => $userId,
            'password' => password_hash($newPassword, PASSWORD_DEFAULT)
        ]);
    }

    /**
     * Xóa user
     */
    public function deleteUser($userId) {
        $sql = "DELETE FROM users WHERE user_id = :user_id";
        return $this->query($sql, ['user_id' => $userId]);
    }
}
