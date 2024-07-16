<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_user_by_id($user_id) {
        $query = $this->db->get_where('userskin', array('id_user' => $user_id));
        return $query->row_array();
    }

}
?>
