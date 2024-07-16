<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends CI_Controller {
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
//  public $Cart_model;
//  public $Order_model;
//  public $User_model;
 public $Article_model;

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
    //  $this->load->model('Order_model');
    //  $this->load->model('User_model');
    //  $this->load->model('Model_barang');
    //  $this->load->model('Cart_model');
    $this->load->model('Article_model');
    }

    public function index() {
        $data['articles'] = $this->Article_model->get_articles();
        $this->load->view('components/header');
        $this->load->view('components/navbar');
        $this->load->view('pages/articles', $data);
        $this->load->view('components/footer');
    }

    public function view($id) {
        $data['article'] = $this->Article_model->get_article_by_id($id);
        if (empty($data['article'])) {
            show_404();
        }
        $this->load->view('components/header');
        $this->load->view('components/navbar');
        $this->load->view('pages/detail_articles', $data);
        $this->load->view('components/footer');
    }
}
?>
