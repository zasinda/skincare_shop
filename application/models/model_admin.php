<?php
class Model_admin extends CI_Model {
    public function login($username, $password) {
        $this->db->where('username_admin', $username);
        $admin = $this->db->get('adminskin')->row();

        if ($admin && password_verify($password, $admin->password_admin)) {
            return $admin;
        }
        return false;
    }
}
?>
