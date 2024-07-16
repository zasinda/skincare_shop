<?php

class Model_barang extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database(); // Ensure the database is loaded
    }

    public function ambil_data_by_id($id_produk) {
        $result = $this->db->where('id_produk', $id_produk)
                           ->get('product');
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return null;
        }
    }

    public function tampil_data() {
        return $this->db->get('product');
    }

    public function tambah_barang($data, $table) {
        $this->db->insert($table, $data);
    }

    public function edit_produk($where, $table) {
        return $this->db->get_where($table, $where);
    }

    public function update_data($where, $data, $table) {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function hapus_data($where, $table) {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function find($kd) {
        $result = $this->db->where('id_produk', $kd)
                           ->limit(1)
                           ->get('product');
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return array();
        }
    }

    public function join($table, $tbljoin, $join) {
        $this->db->join($tbljoin, $join);
        return $this->db->get($table);
    }
}

?>
