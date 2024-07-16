<?php

class Kategori extends CI_Controller {
    // Declare properties explicitly
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

    public function __construct() {
        parent::__construct();
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
        $this->load->database();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('Model_barang');
        $this->load->model('Model_kategori');
    }

    public function sunscreen() {
        // Correct property access to $this->Model_kategori
        $data['sunscreen'] = $this->Model_kategori->data_sunscreen()->result();
        $this->load->helper('url');
        $this->load->view('components/header');
        $this->load->view('components/navbar');
        $this->load->view('pages/sunscreen', $data);
        $this->load->view('components/footer');
    }

    public function mask() {
        // Correct property access to $this->Model_kategori
        $data['mask'] = $this->Model_kategori->data_mask()->result();
        $this->load->helper('url');
        $this->load->view('components/header');
        $this->load->view('components/navbar');
        $this->load->view('pages/mask', $data);
        $this->load->view('components/footer');
    }

    public function moisturizer() {
        // Correct property access to $this->Model_kategori
        $data['moisturizer'] = $this->Model_kategori->data_moisturizer()->result();
        $this->load->helper('url');
        $this->load->view('components/header');
        $this->load->view('components/navbar');
        $this->load->view('pages/moisturizer', $data);
        $this->load->view('components/footer');
    }

    public function facewash() {
        // Correct property access to $this->Model_kategori
        $data['facewash'] = $this->Model_kategori->data_facewash()->result();
        $this->load->helper('url');
        $this->load->view('components/header');
        $this->load->view('components/navbar');
        $this->load->view('pages/facewash', $data);
        $this->load->view('components/footer');
    }
}

?>
