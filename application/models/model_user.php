<?php
class Model_user extends CI_Model {
    public function register($data) {
        return $this->db->insert('userskin', $data);
    }

    public function login($username, $password) {
        $this->db->where('username', $username);
        $user = $this->db->get('userskin')->row();

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }
}
?>
