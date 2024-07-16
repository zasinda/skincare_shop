<?php

class model_kategori extends CI_model{
    public function data_sunscreen(){
        return $this->db->get_where("product",array('kategori' => 'SUNSCREEN'));
    }
    public function data_mask(){
        return $this->db->get_where("product",array('kategori' => 'MASK'));
    }
    public function data_moisturizer(){
        return $this->db->get_where("product",array('kategori' => 'MOISTURIZER'));
    }
    public function data_facewash(){
        return $this->db->get_where("product",array('kategori' => 'FACEWASH'));
    }
}