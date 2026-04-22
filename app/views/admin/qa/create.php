<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<div class="page-wrapper"> <div class="page-header d-print-none mb-3">

<div class="page-header d-print-none mb-3">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Quản lý câu hỏi
                </h2>
                <div class="text-muted mt-1">Tạo mới câu hỏi và câu trả lời mẫu</div>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <a href="<?= BASE_URL ?>admin/qa" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left"></i> &nbsp; Quay lại
                </a>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-lg-8 offset-lg-2">
                <form method="POST" action="" class="card">
                    
                    <div class="card-status-top bg-primary"></div>
                    
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="fa-solid fa-pen-to-square me-2"></i> Thông tin câu hỏi
                        </h4>
                    </div>
                    
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label required">Câu hỏi thường gặp</label>
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                  <i class="fa-solid fa-question"></i>
                                </span>
                                <input type="text" name="question" class="form-control" placeholder="Ví dụ: Làm sao để đổi trả hàng?" required>
                            </div>
                            <small class="form-hint">Câu hỏi ngắn gọn hiển thị ngoài trang chủ.</small>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label required">Danh mục</label>
                            <select name="category" class="form-select">
                                <option value="Chung">Chung</option>
                                <option value="Thanh toán">Thanh toán</option>
                                <option value="Vận chuyển">Vận chuyển</option>
                                <option value="Bảo hành">Bảo hành</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Nội dung trả lời</label>
                            <textarea name="answer" class="form-control" rows="6" placeholder="Nhập chi tiết câu trả lời..." required></textarea>
                        </div>
                    </div>
                    
                    <div class="card-footer d-flex justify-content-between">
                        <a href="<?= BASE_URL ?>admin/qa" class="btn btn-link link-secondary">Hủy bỏ</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-check"></i> &nbsp; Lưu dữ liệu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>