<?php
class Cart_model extends CI_Model {
    public function contents() {
        // Logika untuk mendapatkan konten keranjang dari session atau database
        // Contoh sederhana, sebaiknya disesuaikan dengan implementasi keranjang Anda
        return $this->session->userdata('cart');
    }

    public function total() {
        $cart = $this->contents();
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['harga'] * $item['qty'];
        }
        return $total;
    }
}
?>
