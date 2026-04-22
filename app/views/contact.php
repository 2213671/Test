<?php require_once APP_ROOT . '/views/components/header.php'; ?>

<style>
    .breadcrumb-section {
        background-color: var(--fahasa-light-gray);
        padding: 15px 0;
        margin-bottom: 30px;
    }

    .breadcrumb {
        background: none;
        margin-bottom: 0;
        padding: 0;
    }

    .breadcrumb-item a {
        color: var(--fahasa-gray);
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        color: var(--fahasa-red);
    }

    .breadcrumb-item.active {
        color: var(--fahasa-dark);
    }

    .page-title {
        color: var(--fahasa-red);
        font-weight: 700;
        margin-bottom: 30px;
        position: relative;
        padding-bottom: 15px;
    }

    .page-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 80px;
        height: 3px;
        background-color: var(--fahasa-orange);
    }

    .contact-hero {
        background: linear-gradient(135deg, var(--fahasa-red) 0%, var(--fahasa-orange) 100%);
        color: white;
        padding: 60px 0;
        margin-bottom: 50px;
        border-radius: 10px;
        text-align: center;
    }

    .contact-hero h2 {
        font-weight: 700;
        margin-bottom: 20px;
    }

    .contact-hero p {
        font-size: 18px;
        margin-bottom: 0;
    }

    .contact-info {
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 25px;
    }

    .contact-item:last-child {
        margin-bottom: 0;
    }

    .contact-icon {
        width: 60px;
        height: 60px;
        background-color: var(--fahasa-light-gray);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        flex-shrink: 0;
    }

    .contact-icon i {
        font-size: 24px;
        color: var(--fahasa-red);
    }

    .contact-details h5 {
        color: var(--fahasa-red);
        font-weight: 600;
        margin-bottom: 5px;
    }

    .contact-details p {
        color: var(--fahasa-gray);
        margin-bottom: 0;
        line-height: 1.6;
    }

    .contact-form {
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        font-weight: 500;
        color: var(--fahasa-dark);
        margin-bottom: 8px;
    }

    .form-control {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 12px 15px;
    }

    .form-control:focus {
        border-color: var(--fahasa-red);
        box-shadow: 0 0 0 0.2rem rgba(201, 33, 39, 0.25);
    }

    .form-control.error {
        border-color: #dc3545;
    }

    .error-message {
        color: #dc3545;
        font-size: 14px;
        margin-top: 5px;
    }

    .btn-submit {
        background-color: var(--fahasa-red);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 4px;
        font-weight: 500;
        cursor: pointer;
        width: 100%;
        transition: background-color 0.3s;
    }

    .btn-submit:hover {
        background-color: #a81b20;
    }

    .social-contacts {
        display: flex;
        gap: 15px;
        margin-top: 20px;
    }

    .social-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background-color: var(--fahasa-light-gray);
        color: var(--fahasa-dark);
        text-decoration: none;
        transition: all 0.3s;
    }

    .social-btn:hover {
        background-color: var(--fahasa-red);
        color: white;
        transform: translateY(-3px);
    }

    .success-message {
        background-color: #d4edda;
        color: #155724;
        padding: 15px;
        border-radius: 4px;
        margin-bottom: 20px;
        border: 1px solid #c3e6cb;
    }

    .hours-table {
        width: 100%;
        border-collapse: collapse;
    }

    .hours-table th,
    .hours-table td {
        padding: 8px 12px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    .hours-table th {
        color: var(--fahasa-red);
        font-weight: 600;
    }
</style>

<!-- Breadcrumb -->
<div class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fas fa-home"></i> Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Liên hệ</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Main Content -->
<div class="container">
    <div class="contact-hero">
        <h2><i class="fas fa-phone-alt"></i> Liên hệ với chúng tôi</h2>
        <p>Tiệm sách FAHASA - Nơi chia sẻ tri thức, lan tỏa yêu thương</p>
    </div>

    <div class="row">
        <!-- Contact Information -->
        <div class="col-md-5">
            <div class="contact-info">
                <h3 class="page-title mb-4">Thông tin liên hệ</h3>
                
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="contact-details">
                        <h5>Địa chỉ</h5>
                        <p>Địa chỉ: <?= htmlspecialchars($settings['address'] ?? 'Chưa cập nhật') ?></p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="contact-details">
                        <h5>Điện thoại</h5>
                        <p>Hotline: <?= htmlspecialchars($settings['phone'] ?? 'Chưa cập nhật') ?></p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="contact-details">
                        <h5>Email</h5>
                        <p>Email: <?= htmlspecialchars($settings['email'] ?? 'Chưa cập nhật') ?></p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="contact-details">
                        <h5>Thời gian làm việc</h5>
                        <table class="hours-table">
                            <tr>
                                <td>Thứ 2 - Thứ 6</td>
                                <td>8:00 - 21:00</td>
                            </tr>
                            <tr>
                                <td>Thứ 7 - Chủ nhật</td>
                                <td>8:00 - 22:00</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="social-contacts">
                    <a href="#" class="social-btn" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-btn" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-btn" title="Zalo">
                        <i class="fas fa-comment-alt"></i>
                    </a>
                    <a href="#" class="social-btn" title="Youtube">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

        </div>

        <!-- Contact Form -->
        <div class="col-md-7">
            <div class="contact-form">
                <h3 class="page-title mb-4">Gửi yêu cầu liên hệ</h3>
                
                <?php if (isset($success)): ?>
                    <div class="success-message">
                        <i class="fas fa-check-circle"></i> <?= htmlspecialchars($success) ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?= BASE_URL ?>contact/submit" id="contactForm" novalidate>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-label">Họ và tên <span class="text-danger" aria-label="bắt buộc">*</span></label>
                                <input type="text"
                                       class="form-control <?= isset($errors['name']) ? 'error' : '' ?>"
                                       id="name"
                                       name="name"
                                       value="<?= htmlspecialchars($old_data['name'] ?? '') ?? '' ?>"
                                       placeholder="Nhập họ tên của bạn"
                                       required
                                       aria-describedby="name-error">
                                <?php if (isset($errors['name'])): ?>
                                    <div class="error-message" id="name-error"><?= $errors['name'] ?></div>
                                <?php else: ?>
                                    <div class="error-message" id="name-error" style="display:none;"></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="form-label">Email <span class="text-danger" aria-label="bắt buộc">*</span></label>
                                <input type="email"
                                       class="form-control <?= isset($errors['email']) ? 'error' : '' ?>"
                                       id="email"
                                       name="email"
                                       value="<?= htmlspecialchars($old_data['email'] ?? '') ?? '' ?>"
                                       placeholder="Nhập địa chỉ email"
                                       required
                                       aria-describedby="email-error">
                                <?php if (isset($errors['email'])): ?>
                                    <div class="error-message" id="email-error"><?= $errors['email'] ?></div>
                                <?php else: ?>
                                    <div class="error-message" id="email-error" style="display:none;"></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone" class="form-label">Số điện thoại <span class="text-danger" aria-label="bắt buộc">*</span></label>
                        <input type="tel"
                               class="form-control <?= isset($errors['phone']) ? 'error' : '' ?>"
                               id="phone"
                               name="phone"
                               value="<?= htmlspecialchars($old_data['phone'] ?? '') ?? '' ?>"
                               placeholder="Nhập số điện thoại"
                               required
                               aria-describedby="phone-error">
                        <?php if (isset($errors['phone'])): ?>
                            <div class="error-message" id="phone-error"><?= $errors['phone'] ?></div>
                        <?php else: ?>
                            <div class="error-message" id="phone-error" style="display:none;"></div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="subject" class="form-label">Tiêu đề <span class="text-danger" aria-label="bắt buộc">*</span></label>
                        <input type="text"
                               class="form-control <?= isset($errors['subject']) ? 'error' : '' ?>"
                               id="subject"
                               name="subject"
                               value="<?= htmlspecialchars($old_data['subject'] ?? '') ?? '' ?>"
                               placeholder="Nhập tiêu đề"
                               required
                               aria-describedby="subject-error">
                        <?php if (isset($errors['subject'])): ?>
                            <div class="error-message" id="subject-error"><?= $errors['subject'] ?></div>
                        <?php else: ?>
                            <div class="error-message" id="subject-error" style="display:none;"></div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="message" class="form-label">Nội dung <span class="text-danger" aria-label="bắt buộc">*</span></label>
                        <textarea class="form-control <?= isset($errors['message']) ? 'error' : '' ?>"
                                  id="message"
                                  name="message"
                                  rows="5"
                                  placeholder="Nhập nội dung tin nhắn của bạn"
                                  required
                                  aria-describedby="message-error"><?= htmlspecialchars($old_data['message'] ?? '') ?? '' ?></textarea>
                        <?php if (isset($errors['message'])): ?>
                            <div class="error-message" id="message-error"><?= $errors['message'] ?></div>
                        <?php else: ?>
                            <div class="error-message" id="message-error" style="display:none;"></div>
                        <?php endif; ?>
                    </div>
                    
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-paper-plane"></i> Gửi yêu cầu
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Enhanced real-time form validation
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contactForm');
        if (!form) return;

        // Add input event listeners for real-time validation
        const fields = ['name', 'email', 'phone', 'subject', 'message'];
        fields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (field) {
                field.addEventListener('blur', function() {
                    validateField(fieldId);
                });

                field.addEventListener('input', function() {
                    if (this.classList.contains('error')) {
                        validateField(fieldId);
                    }
                });
            }
        });

        // Form submission handler
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Validate all fields
            let isValid = true;
            for (const fieldId of fields) {
                if (!validateField(fieldId)) {
                    isValid = false;
                }
            }

            if (isValid) {
                // If all validations pass, submit the form
                e.target.submit();
            } else {
                // Focus on the first invalid field
                const firstErrorField = form.querySelector('.form-control.error');
                if (firstErrorField) {
                    firstErrorField.focus();
                    firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });

        function validateField(fieldId) {
            const field = document.getElementById(fieldId);
            const errorElement = document.getElementById(fieldId + '-error');
            let isValid = true;
            let errorMessage = '';

            const value = field.value.trim();

            // Clear previous error
            field.classList.remove('error');
            if (errorElement) {
                errorElement.style.display = 'none';
                errorElement.textContent = '';
            }

            // Required validation
            if (!value) {
                errorMessage = getRequiredMessage(fieldId);
                isValid = false;
            } else {
                // Additional field-specific validation
                switch(fieldId) {
                    case 'email':
                        if (!isValidEmail(value)) {
                            errorMessage = 'Email không hợp lệ';
                            isValid = false;
                        }
                        break;
                    case 'phone':
                        if (!isValidPhone(value)) {
                            errorMessage = 'Số điện thoại không hợp lệ';
                            isValid = false;
                        }
                        break;
                }
            }

            if (!isValid && errorElement) {
                field.classList.add('error');
                errorElement.textContent = errorMessage;
                errorElement.style.display = 'block';
            }

            return isValid;
        }

        function getRequiredMessage(fieldId) {
            const messages = {
                'name': 'Vui lòng nhập họ tên',
                'email': 'Vui lòng nhập email',
                'phone': 'Vui lòng nhập số điện thoại',
                'subject': 'Vui lòng nhập tiêu đề',
                'message': 'Vui lòng nhập nội dung'
            };
            return messages[fieldId] || 'Trường này là bắt buộc';
        }

        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function isValidPhone(phone) {
            const phoneRegex = /^[0-9]{10,11}$/;
            return phoneRegex.test(phone);
        }
    });
</script>

<?php require_once APP_ROOT . '/views/components/footer.php'; ?>