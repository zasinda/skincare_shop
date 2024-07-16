<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_articles() {
        return $this->db->get('articles')->result_array();
    }

    public function get_article_by_id($id) {
        return $this->db->get_where('articles', array('id' => $id))->row_array();
    }
}
?>
