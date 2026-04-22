<?php
/**
 * ABOUT CONTROLLER
 * Trang Giới thiệu
 */

class AboutController extends Controller {
    
    /**
     * Trang giới thiệu chính
     */
    public function index() {
        $data = [
            'title' => 'Giới thiệu - ' . APP_NAME,
            'page' => 'about'
        ];
        
        $this->view('about', $data);
    }
}
