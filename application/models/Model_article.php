<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_article extends CI_Model {

    public function get_all_articles() {
        $query = $this->db->get('articles');
        return $query->result_array();
    }

    public function get_article_by_id($id) {
        $query = $this->db->get_where('articles', array('id' => $id));
        return $query->row_array();
    }

    public function insert_article($data) {
        return $this->db->insert('articles', $data);
    }

    public function update_article($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('articles', $data);
    }

    public function delete_article($id) {
        return $this->db->delete('articles', array('id' => $id));
    }
}
?>
