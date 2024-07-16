<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function login_admin($username, $password) {
        $this->db->where('username_admin', $username);
        $admin = $this->db->get('adminskin')->row();

        if ($admin && $password === $admin->password_admin) {
            return $admin;
        }

        return FALSE;
    }

    public function login_user($username, $password) {
        $this->db->where('username', $username);
        $user = $this->db->get('userskin')->row();

        if ($user && $password === $user->password) {
            return $user;
        }

        return FALSE;
    }

    public function register_user($data) {
        return $this->db->insert('userskin', $data);
    }
}
