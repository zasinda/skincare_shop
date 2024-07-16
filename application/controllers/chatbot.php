<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chatbot extends CI_Controller {
     // Declare all used properties
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
     public $db;
     public $session;
     public $form_validation;
     public $Model_barang;
 
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
     }

    public function index() {
        $this->load->view('components/header');
        $this->load->view('components/navbar');
        $this->load->view('chatbot_view');
    }

    public function send_message() {
        $userInput = $this->input->post('userInput');

        $url = 'http://localhost:3000/chat'; // URL backend buat chatbot

        $data = array('userInput' => $userInput);
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json",
                'method'  => 'POST',
                'content' => json_encode($data),
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        if ($result === FALSE) {
            $response = 'Error: Unable to connect to backend';
        } else {
            $response = json_decode($result)->response;
        }

        echo $response;
    }

}
