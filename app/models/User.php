<?php
class User extends DB {

    /**
     * Tìm user theo Email hoặc SĐT
     * Hàm này sửa lỗi "Call to undefined method User::findUserByEmail()"
     */
    public function findUserByEmailOrPhone($emailOrPhone) {
        // SỬA: Dùng 2 placeholder khác nhau (:email và :phone)
        $sql = "SELECT * FROM users WHERE email = :email OR phone = :phone LIMIT 1";
        
        // SỬA: Truyền mảng tham số map với 2 key trên
        return $this->single($sql, [
            'email' => $emailOrPhone,
            'phone' => $emailOrPhone
        ]);
    }

    /**
     * Tạo tài khoản mới (Dùng cho chức năng Đăng ký)
     */
    public function create($data) {
        // $data nhận vào mảng gồm: fullname, email_or_phone, password
        
        // 1. Mã hóa mật khẩu
        $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);

        // 2. Tách Email hoặc Phone (Logic đơn giản)
        $email = null;
        $phone = null;
        
        if (strpos($data['email_or_phone'], '@') !== false) {
            $email = $data['email_or_phone'];
        } else {
            $phone = $data['email_or_phone'];
        }

        // 3. Câu SQL Insert
        $sql = "INSERT INTO users (fullname, email, phone, password, created_date) 
                VALUES (:fullname, :email, :phone, :password, NOW())";

        // 4. Thực thi
        return $this->query($sql, [
            'fullname' => $data['fullname'],
            'email'    => $email,
            'phone'    => $phone,
            'password' => $passwordHash
        ]);
    }
    // tìm user theo email (trả về assoc hoặc false)
public function findByEmail(string $email)
{
    $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
    return $this->single($sql, ['email' => $email]);
}

// tạo token reset (dùng token dạng chuỗi)
public function createPasswordResetToken(int $userId, string $token, string $expiresAt)
{
    $sql = "INSERT INTO password_resets (user_id, token, expires_at) VALUES (:uid, :token, :exp)";
    return $this->query($sql, [
        'uid' => $userId,
        'token' => $token,
        'exp' => $expiresAt
    ]);
}

// tìm record reset theo token (nối với users)
public function findResetByToken(string $token)
{
    $sql = "SELECT pr.*, u.email, u.id as user_id FROM password_resets pr
            JOIN users u ON pr.user_id = u.id
            WHERE pr.token = :token AND pr.used = 0 AND pr.expires_at > NOW()
            LIMIT 1";
    return $this->single($sql, ['token' => $token]);
}

// đánh dấu token là đã dùng
public function useResetToken(string $token)
{
    $sql = "UPDATE password_resets SET used = 1 WHERE token = :token";
    return $this->query($sql, ['token' => $token]);
}

// cập nhật mật khẩu user bằng user_id
public function updatePassword(int $userId, string $newPassword)
{
    $hash = password_hash($newPassword, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET password = :pw WHERE id = :id";
    return $this->query($sql, [
        'pw' => $hash,
        'id' => $userId
    ]);
}
    public function getById($id) {
    $sql = "SELECT user_id AS id, username, fullname, email, phone, avatar, gender, birthday, address, created_at
            FROM users
            WHERE user_id = :id
            LIMIT 1";
    return $this->single($sql, ['id' => $id]);
}

    public function updateProfile($id, $data) {
        $sql = "UPDATE users SET fullname=:fullname, phone=:phone, email=:email, gender=:gender, birthday=:birthday, address=:address WHERE id=:id";
        $data['id'] = $id;
        return $this->query($sql, $data);
    }
}