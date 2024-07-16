<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles_admin extends CI_Controller {
    public $benchmark;
    public $hooks;
    public $config;
    public $log;
    public $utf8;
    public $uri;
    public $router;
    public $output;
    public $security;
    public $input;
    public $lang;
    public $load;
    public $db;
    public $session;
    public $form_validation;
    public $Model_article;
    public $Model_admin;
    public $upload;
    public $Model_barang;


    public function __construct() {
        parent::__construct();
        // if(!$this->session->userdata('admin')) {
        //     $this->session->set_flashdata('error', 'You must be logged in to view this page.');
        //     redirect('auth/login');
        // }

        // Initialize properties
        $this->benchmark = &load_class('Benchmark', 'core');
        $this->hooks = &load_class('Hooks', 'core');
        $this->config = &load_class('Config', 'core');
        $this->log = &load_class('Log', 'core');
        $this->utf8 = &load_class('Utf8', 'core');
        $this->uri = &load_class('URI', 'core');
        $this->router = &load_class('Router', 'core');
        $this->output = &load_class('Output', 'core');
        $this->security = &load_class('Security', 'core');
        $this->input = &load_class('Input', 'core');
        $this->lang = &load_class('Lang', 'core');

        // Load CI libraries and models
       // Load CI libraries and models
        $this->load->database();
        $this->load->library(['session', 'form_validation', 'upload']);
        $this->load->model('Model_article');
    }

    public function index() {
        $data['articles'] = $this->Model_article->get_all_articles();

        if (empty($data['articles'])) {
            $data['articles'] = []; // Ensure $articles is an empty array if no articles are found
        }

        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('layout/footer');
        $this->load->view('admin/article_data', $data);
    }

    public function add() {
        $title = $this->input->post('title');
        $content = $this->input->post('content');
    
        // Menggunakan $_FILES['image'] untuk mendapatkan file yang diunggah
        $image = $_FILES['image'];
    
        if ($image['name'] != '') {  // Periksa apakah ada file yang diunggah
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
    
            $this->load->library('upload');
            $this->upload->initialize($config);
    
            if (!$this->upload->do_upload('image')) {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('admin/article_data', $error);
                die(); // Hentikan proses jika gagal mengunggah gambar
            } else {
                $upload_data = $this->upload->data();
                $image_url = $upload_data['file_name'];  // Ambil nama file hasil upload
            }
        } else {
            $image_url = '';  // Jika tidak ada gambar diunggah, set default ke kosong atau sesuai kebutuhan aplikasi
        }
    
        $data = array (
            'title'   => $title,
            'content' => $content,
            'image_url' => $image_url,  // Gunakan $image_url untuk menyimpan nama file gambar
        );
    
        $this->Model_article->insert_article($data);  // Hapus parameter kedua yang tidak diperlukan
        redirect('admin/articles_admin/index');
    }
    
    public function edit($id) {
        $data['article'] = $this->Model_article->get_article_by_id($id);
        if (!$data['article']) {
            show_error('Article not found', 404);
        }
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('layout/footer');
        $this->load->view('admin/edit_article', $data);
    }

    public function update() {
        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $content = $this->input->post('content');
        
        // Handle image upload
        $image_url = $this->input->post('current_image');
        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('image')) {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('admin/edit_article', $error);
                return;
            } else {
                $upload_data = $this->upload->data();
                $image_url = $upload_data['file_name'];
            }
        }

        // Prepare data to update
        $data = array (
            'title'   => $title,
            'content' => $content,
            'image_url' => $image_url,
        );

        // Update article
        if (!$this->Model_article->update_article($id, $data)) {
            // Jika update gagal, tampilkan pesan error
            $error = array('error' => 'Failed to update article');
            $this->load->view('admin/edit_article', $error);
            return;
        }

        // Redirect to article list after successful update
        redirect('admin/articles_admin/index');
    }

    public function delete($id) {
        $this->Model_article->delete_article($id);
        redirect('admin/articles_admin/index');
    }
}
?>