<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends CI_Controller {

    // Deklarasi properti secara eksplisit
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
    public $Cart_model;
    public $Order_model;
    public $User_model;

    public function __construct() {
        parent::__construct();
        // Inisialisasi properti
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

        // Memuat library CI dan model
        $this->load->database();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('Model_barang');
        $this->load->model('Order_model');
        $this->load->model('User_model');
        $this->load->model('Model_barang');
        $this->load->model('Cart_model');
    }

    public function index() {
        $data['produk'] = $this->Model_barang->tampil_data()->result();

        $this->load->helper('url');
        $this->load->view('components/header');
        $this->load->view('components/navbar');
        $this->load->view('pages/store', $data);
        $this->load->view('components/footer');
    }

    public function add_to_cart() {
        $id_produk = $this->input->post('id_produk');
    
        $produk = $this->Model_barang->ambil_data_by_id($id_produk);
    
        $cart_data = array(
            'id_produk' => $produk->id_produk,
            'nama_produk' => $produk->nama_produk,
            'harga' => $produk->harga,
            'qty' => 1
        );
    
        $cart = $this->session->userdata('cart');
        if (!is_array($cart)) {
            $cart = array();
        }
        $cart[] = $cart_data;
        $this->session->set_userdata('cart', $cart);
    
        redirect('store'); 
    }

    public function detail_cart() {
        $cart = $this->session->userdata('cart');
    
        $this->load->view('components/header');
        $this->load->view('components/navbar');
        $this->load->view('pages/cart', ['cart' => $cart]);
        $this->load->view('components/footer');
    }

    public function checkout() {
        $id_user = $this->session->userdata('user_logged_in');
        if (!$id_user) {
            // Handle jika user tidak terautentikasi
            redirect('auth/login');
        }
        
        // Ambil data user dari database menggunakan User_model
        $user_data = $this->User_model->get_user_by_id($id_user);

        $data['nama_lengkap'] = $user_data['nama_lengkap'];
        $data['email_user'] = $user_data['email_user'];
        $data['alamat_user'] = $user_data['alamat_user'];
        $data['nohp_user'] = $user_data['nohp_user'];
        $data['cart'] = $this->session->userdata('cart');
        $data['total'] = 0;
        foreach ($data['cart'] as $item) {
            $data['total'] += $item['harga'] * $item['qty'];
        }
        $this->load->view('components/header');
        $this->load->view('components/navbar');
        $this->load->view('pages/checkout', $data);
        $this->load->view('components/footer');
    }

    public function update_cart() {
        $id_produk = $this->input->post('id_produk');
        $qty = $this->input->post('qty');
    
        $cart = $this->session->userdata('cart');
        foreach ($cart as &$item) {
            if ($item['id_produk'] == $id_produk) {
                $item['qty'] = $qty;
                break;
            }
        }
        $this->session->set_userdata('cart', $cart);
    
        echo $this->subtotal($id_produk); // Mengembalikan subtotal untuk dikirim kembali ke JavaScript
    }

    private function subtotal($id_produk) {
        $cart = $this->session->userdata('cart');
        foreach ($cart as $item) {
            if ($item['id_produk'] == $id_produk) {
                return $item['harga'] * $item['qty'];
            }
        }
        return 0;
    }

    public function remove_cart($id_produk) {
        $cart = $this->session->userdata('cart');
        foreach ($cart as $key => $item) {
            if ($item['id_produk'] == $id_produk) {
                unset($cart[$key]);
                break;
            }
        }
        $this->session->set_userdata('cart', $cart);
    
        redirect('store/detail_cart');
    }

    public function process_payment(){
        $this->session->unset_userdata('cart');
        $this->load->view('components/header');
        $this->load->view('components/navbar');
        $this->load->view('pages/process_payment');
        $this->load->view('components/footer');
    }
}
?>
