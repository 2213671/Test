<?php
// controllers/AuthController.php

class AuthController extends Controller
{
    // Hiển thị form đăng nhập
    public function login()
    {
        // 1. Nếu đã đăng nhập thì đá về trang tương ứng
        if (isset($_SESSION['users_id'])) {
            if (isset($_SESSION['users_role']) && $_SESSION['users_role'] === 'admin') {
                $this->redirect('admin');
            } else {
                $this->redirect('home');
            }
        }

        // 2. Xử lý khi bấm nút Đăng nhập (POST)
        if ($this->isPost()) {
            $emailOrPhone = trim($_POST['emailOrPhone'] ?? '');
            $password = $_POST['password'] ?? '';

            $errors = [];
            if ($emailOrPhone === '') $errors[] = 'Vui lòng nhập Email hoặc SĐT.';
            if ($password === '') $errors[] = 'Vui lòng nhập mật khẩu.';

            if (empty($errors)) {
                $userModel = $this->model('User');

                // Tìm user trong DB
                $user = $userModel->findUserByEmailOrPhone($emailOrPhone);

                // Kiểm tra mật khẩu
                if ($user && password_verify($password, $user['password'])) {

                    // --- ĐĂNG NHẬP THÀNH CÔNG ---
                    $_SESSION['users_id'] = $user['user_id'];
                    $_SESSION['users_username'] = $user['username'];
                    $_SESSION['users_role'] = $user['role']; // QUAN TRỌNG CHO ADMIN
                    // Merge guest wishlist (nếu có)
                if (!empty($_SESSION['guest_wishlist'])) {
                    $wm = $this->model('WishlistModel'); // hoặc new WishlistModel() nếu model() ko autoload
                    foreach (array_unique($_SESSION['guest_wishlist']) as $pid) {
                       $pid = (int)$pid;
                       if ($pid <= 0) continue;
                       $wm->add($_SESSION['users_id'], $pid);
                    }
                    unset($_SESSION['guest_wishlist']);
                }
                    // Chuyển hướng đúng (Sửa lỗi Location /)
                    if ($user['role'] === 'admin') {
                        $this->redirect('admin');
                    } else {
                        // ✅ THÊM: Set flag để JS biết cần sync cart
                        $_SESSION['need_sync_cart'] = true;
                        $this->redirect('home');
                    }
                } else {
                    $errors[] = 'Tài khoản hoặc mật khẩu không đúng.';
                }
            }

            $data = [
                'errors' => $errors,
                'old' => ['emailOrPhone' => $emailOrPhone]
            ];
            $this->view('auth/login', $data);
        }
        // 3. Hiển thị form (GET)
        else {
            $this->view('auth/login');
        }
    }

    // Hiển thị form đăng ký
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullname = trim($_POST['fullname'] ?? '');
            $emailOrPhone = trim($_POST['emailOrPhone'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirm = $_POST['confirmPassword'] ?? '';

            $errors = [];
            if ($fullname === '') $errors[] = 'Vui lòng nhập họ và tên.';
            if ($emailOrPhone === '') $errors[] = 'Vui lòng nhập Email hoặc Số điện thoại.';
            if (strlen($password) < 6) $errors[] = 'Mật khẩu tối thiểu 6 ký tự.';
            if ($password !== $confirm) $errors[] = 'Mật khẩu xác nhận không khớp.';

            require_once APP_ROOT . '/models/User.php';
            $userModel = new User();

            // kiểm tra đã tồn tại
            if ($userModel->findUserByEmailOrPhone($emailOrPhone)) {
                $errors[] = 'Email hoặc Số điện thoại đã được sử dụng.';
            }

            if (empty($errors)) {
                $created = $userModel->create([
                    'fullname' => $fullname,
                    'email_or_phone' => $emailOrPhone,
                    'password' => $password, // model sẽ hash
                ]);

                if ($created) {
                    // tự động login hoặc chuyển tới trang login
                    header('Location: /auth/login');
                    exit;
                } else {
                    $errors[] = 'Có lỗi khi tạo tài khoản, thử lại sau.';
                }
            }

            $data = [
                'errors' => $errors,
                'old' => ['fullname' => $fullname, 'emailOrPhone' => $emailOrPhone],
            ];
            $this->view('auth/register', $data);
            return;
        }

        $this->view('auth/register');
    }

    // Logout
    public function logout()
    {
        if (!session_id()) session_start();
        session_destroy();
        $this->redirect('auth/login');
    }
    public function forgot()
{
    require_once APP_ROOT . '/models/User.php';
    $userModel = new User();
    
    // Nếu form gửi yêu cầu tạo OTP
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'send') {
        $email = trim($_POST['email'] ?? '');
        $errors = [];

        if ($email === '') $errors[] = 'Vui lòng nhập email.';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email không hợp lệ.';

        if (!empty($errors)) {
            $this->view('auth/forgot', ['errors' => $errors, 'old' => ['email' => $email]]);
            return;
        }

        $user = $userModel->findByEmail($email);
        if (!$user) {
            // Không tiết lộ tồn tại hay không -> thông báo chung
            $this->view('auth/forgot', ['success' => 'Nếu email tồn tại, bạn sẽ nhận OTP qua email.']);
            return;
        }

        // Tạo OTP 6 chữ số
        $otp = random_int(100000, 999999);
        $expires = date('Y-m-d H:i:s', time() + 15*60); // 15 phút

        $userModel->createPasswordResetOTP((int)$user['id'], (string)$otp, $expires);

        // Gửi email bằng PHPMailer (cần composer require)
        $subject = "Mã OTP đặt lại mật khẩu FAHASA";
        $body = "Xin chào {$user['fullname']}\n\n";
        $body .= "Mã OTP đặt lại mật khẩu của bạn là: {$otp}\n";
        $body .= "Mã có hiệu lực trong 15 phút.\n\n";
        $body .= "Nếu bạn không yêu cầu, hãy bỏ qua email này.\n\nFAHASA";

        $sent = $this->sendMailPHPMailer($user['email'], $subject, $body);

        if ($sent) {
            // Hiển thị form nhập OTP & mật khẩu mới
            $this->view('auth/forgot', [
                'sent' => true,
                'email' => $user['email'],
                'message' => 'Mã OTP đã được gửi đến email của bạn. Vui lòng kiểm tra (hộp thư đến hoặc spam).'
            ]);
            return;
        } else {
            $this->view('auth/forgot', ['errors' => ['Không thể gửi email. Vui lòng thử lại sau.']]);
            return;
        }
    }

    // Nếu form gửi xác thực OTP và mật khẩu mới
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'verify') {
        $email = trim($_POST['email'] ?? '');
        $otp = trim($_POST['otp'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['confirmPassword'] ?? '';
        $errors = [];

        if ($email === '' || $otp === '') $errors[] = 'Vui lòng nhập email và mã OTP.';
        if (strlen($password) < 6) $errors[] = 'Mật khẩu tối thiểu 6 ký tự.';
        if ($password !== $confirm) $errors[] = 'Mật khẩu xác nhận không khớp.';

        if (!empty($errors)) {
            $this->view('auth/forgot', ['errors' => $errors, 'email' => $email]);
            return;
        }

        $record = $userModel->findResetByOtp($email, $otp);
        if (!$record) {
            $this->view('auth/forgot', ['errors' => ['OTP không hợp lệ hoặc đã hết hạn.'], 'email' => $email]);
            return;
        }

        // cập nhật mật khẩu
        $userModel->updatePassword((int)$record['user_id'], $password);
        // đánh dấu otp đã dùng
        $userModel->useResetOtp($otp, (int)$record['user_id']);

        // tự động login (tuỳ bạn)
        $_SESSION['user'] = ['id' => $record['user_id'], 'email' => $record['email'], 'name' => $record['email']];

        // redirect về trang account hoặc login
        header('Location: ' . (defined('BASE_URL') ? BASE_URL . 'account' : '/account'));
        exit;
    }

    // GET: hiển thị form nhập email
    $this->view('auth/forgot');
}

/**
 * Gửi mail qua PHPMailer
 */
private function sendMailPHPMailer($toEmail, $subject, $body)
{
    // load config
    $cfgPath = APP_ROOT . '/config/config.php';
    $cfg = file_exists($cfgPath) ? include $cfgPath : [];
    $smtp = $cfg['smtp'] ?? null;

    if (!class_exists('PHPMailer\PHPMailer\PHPMailer')) {
        // nếu chưa cài PHPMailer, fallback to mail()
        $headers = "From: " . ($smtp['from_email'] ?? 'no-reply@yourdomain.com') . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        return @mail($toEmail, $subject, $body, $headers);
    }

    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = $smtp['host'] ?? 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $smtp['user'] ?? '';
        $mail->Password = $smtp['pass'] ?? '';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $smtp['port'] ?? 587;

        $fromEmail = $smtp['from_email'] ?? $smtp['user'] ?? 'no-reply@yourdomain.com';
        $fromName = $smtp['from_name'] ?? 'FAHASA';

        $mail->setFrom($fromEmail, $fromName);
        $mail->addAddress($toEmail);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->send();
        return true;
    } catch (Exception $e) {
        // bạn có thể log $e->getMessage()
        return false;
    }
}
}
