<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

    public function create_order($order_data) {
        $this->db->insert('orders', $order_data);
        return $this->db->insert_id();
    }

    public function create_order_items($order_id, $items) {
        foreach ($items as $item) {
            $item['order_id'] = $order_id;
            $this->db->insert('order_items', $item);
        }
    }
}
?>
