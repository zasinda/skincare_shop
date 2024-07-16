<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

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
    public $Auth_model;
    public $Order_model;

    public function __construct() {
        parent::__construct();

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
        $this->load->model('Model_barang');
        $this->load->model('Model_kategori');
        $this->load->model('Auth_model');
        $this->load->library('form_validation');
        $this->load->model('Order_model');

    }

    public function login() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // Cek admin login
            $admin = $this->Auth_model->login_admin($username, $password);
            if ($admin) {
                $this->session->set_userdata('admin_logged_in', TRUE);
                redirect('admin/dashboard_admin');
            }

            // Cek user login
            $user = $this->Auth_model->login_user($username, $password);
            if ($user) {
                $this->session->set_userdata('user_logged_in', TRUE);
                redirect('landingpage');
            }

            $this->session->set_flashdata('error', 'Invalid username or password');
            redirect('auth/login');
        }
    }

    public function register() {
        $this->form_validation->set_rules('nama_lengkap', 'Full Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[userskin.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('email_user', 'Email', 'required|valid_email|is_unique[userskin.email_user]');
        $this->form_validation->set_rules('alamat_user', 'Address', 'required');
        $this->form_validation->set_rules('nohp_user', 'Phone Number', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('register');
        } else {
            $data = [
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'), // Menggunakan password teks biasa
                'email_user' => $this->input->post('email_user'),
                'alamat_user' => $this->input->post('alamat_user'),
                'nohp_user' => $this->input->post('nohp_user')
            ];

            $this->Auth_model->register_user($data);
            $this->session->set_flashdata('success', 'Registration successful. Please login.');
            redirect('auth/login');
        }
    }

    public function logout() {
        $this->session->unset_userdata('admin_logged_in');
        $this->session->unset_userdata('user_logged_in');
        redirect('auth/login');
    }
}
?>