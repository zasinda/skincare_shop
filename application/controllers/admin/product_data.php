<?php

class Product_data extends CI_Controller {

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
    public $Model_barang;
    public $Model_kategori;
    public $Model_user;
    public $Model_admin;
    public $upload;

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
       $this->load->model(['Model_barang', 'Model_kategori']);
   }

   public function index() {
       $data['produk'] = $this->Model_barang->tampil_data()->result();
       $this->load->view('layout/header');
       $this->load->view('layout/sidebar');
       $this->load->view('layout/footer');
       $this->load->view('admin/product_data', $data);
   }

   public function tambah_aksi(){
    $productname = $this->input->post('nama_produk');
    $kategori = $this->input->post('kategori');
    $price = $this->input->post('harga');
    $stock = $this->input->post('stok');
    $desc = $this->input->post('detail');
    $foto = $_FILES['foto'];
    if ($foto='') {
    } else {
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|webp';

        $this->load->library('upload');
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('foto')) {
            echo "foto gagal diupload !"; die();
        } else {
            $foto = $this->upload->data('file_name');
        }
    }
    $data = array (
        'nama_produk'   => $productname,
        'harga'  => $price,
        'kategori' => $kategori,
        'stok'   => $stock,
        'detail' => $desc,
        'foto'   => $foto,
    );
    $this->Model_barang->tambah_barang($data, 'product');
    redirect('admin/product_data/index');
   }


   public function edit($kd) {
       $where = array('id_produk' => $kd);
       $data['produk'] = $this->Model_barang->edit_produk($where, 'product')->result();
       $this->load->view('layout/header');
       $this->load->view('layout/sidebar');
       $this->load->view('layout/footer');
       $this->load->view('admin/edit_produk', $data);
   }

   public function update(){
    $kd = $this->input->post('id_produk');
    $productname = $this->input->post('nama_produk');
    $kategori = $this->input->post('kategori');
    $price = $this->input->post('harga');
    $stock = $this->input->post('stok');
    $desc = $this->input->post('detail');
    $foto = $_FILES['foto'];
    if ($foto = '') {
    } else {
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] ='jpg|jpeg|png|webp';

        $this->load->library('upload');
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('foto')) {
            echo "Foto gagal diupload !"; die();
        } else {
            $foto = $this->upload->data('file_name');
        }
    }

    $data = array (
        'nama_produk'   => $productname,
        'harga'  => $price,
        'kategori' => $kategori,
        'stok'   => $stock,
        'detail' => $desc,
        'foto'   => $foto,
    );

    $where = array(
        'id_produk' => $kd
    );

    $this->Model_barang->update_data($where, $data, 'product');
    redirect('admin/product_data/index');
}

public function delete ($kd){
    $where = array('id_produk' => $kd);
    $this->Model_barang->hapus_data($where, 'product');
    redirect('admin/product_data/index');
}
}
?>