<?php
/**
 * QA CONTROLLER
 * Trang Hỏi/Đáp
 */

class QaController extends Controller {
    
    /**
     * Trang hỏi đáp chính
     */
    public function index() {
        $data = [
            'title' => 'Hỏi/Đáp - ' . APP_NAME,
            'page' => 'qa'
        ];
        
        $this->view('qa', $data);
    }
}
