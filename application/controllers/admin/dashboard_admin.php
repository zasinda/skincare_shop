<?php 

class Dashboard_admin extends CI_Controller{

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
    // if($this->session->userdata('id_admin') != '1'){
    //     // Debugging output
    //     log_message('debug', 'User is not logged in as admin.');
        
    //     $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
    //     You are not logged in!
    //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //       <span aria-hidden="true">&times;</span>
    //     </button>
    //   </div>');
    //   redirect('auth/login');
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
        $this->load->database();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('Model_barang');
        $this->load->model('Model_kategori');
    }
    public function index(){
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('layout/footer');
        $this->load->view('admin/dashboard');
    }
}
?>