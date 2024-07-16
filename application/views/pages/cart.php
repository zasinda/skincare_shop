<div class="container cart-container mt-5">
    <h2 class="text-center mb-4">Detail Keranjang Belanja</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($cart) {
                $no = 1;
                foreach ($cart as $item) {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td>
                            <?php if (!empty($item['foto']) && file_exists('./uploads/' . $item['foto'])): ?>
                                <img src="<?php echo base_url('uploads/' . $item['foto']); ?>" class="img-thumbnail" style="width: 100px;">
                            <?php else: ?>
                                <span class="text-muted">Foto tidak tersedia</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $item['nama_produk']; ?></td>
                        <td>Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></td>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-outline-secondary" onclick="updateQty('<?php echo $item['id_produk']; ?>', -1)">-</button>
                                </div>
                                <input type="number" class="form-control text-center" style="max-width: 70px;" value="<?php echo $item['qty']; ?>" min="1" name="qty_<?php echo $item['id_produk']; ?>" onchange="updateQty('<?php echo $item['id_produk']; ?>', 0)">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary" onclick="updateQty('<?php echo $item['id_produk']; ?>', 1)">+</button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="<?php echo site_url('store/remove_cart/' . $item['id_produk']); ?>" class="btn btn-sm btn-danger">Hapus</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="6" class="text-center">Keranjang belanja kosong</td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    
    <div class="text-right">
        <h4>Total Belanja: <span id="total_belanja">Rp 0</span></h4>
    </div>
    
    <div class="text-right mt-3">
        <a href="<?php echo site_url('store/checkout'); ?>" class="btn btn-primary">Checkout</a>
        <a href="<?php echo site_url('store'); ?>" class="btn btn-secondary">Kembali ke Toko</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        updateTotalBelanja(); // Panggil fungsi pertama kali saat halaman dimuat
    });

    function updateQty(productId, change) {
        var currentQty = parseInt($('input[name="qty_' + productId + '"]').val());
        var newQty = currentQty + change;
        
        if (newQty < 1) {
            newQty = 1;
        }
        
        $('input[name="qty_' + productId + '"]').val(newQty);
        
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('store/update_cart'); ?>",
            data: { id_produk: productId, qty: newQty },
            success: function(response) {
                console.log(response); // Tambahkan ini untuk memeriksa respons dari server
                
                var subtotal = parseInt(response) * newQty;
                $('#subtotal_' + productId).text('Rp ' + formatNumber(subtotal));
                
                updateTotalBelanja(); // Panggil fungsi untuk memperbarui total belanja setelah perubahan subtotal
            }
        });

    }

    function updateTotalBelanja() {
        var total = 0;

        <?php foreach ($cart as $item): ?>
            var qty = parseInt($('input[name="qty_<?php echo $item['id_produk']; ?>"]').val());
            var harga = <?php echo $item['harga']; ?>;
            var subtotal = harga * qty;
            total += subtotal;
        <?php endforeach; ?>

        $('#total_belanja').text('Rp ' + formatNumber(total));
    }

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }
</script>

<!-- Add your custom CSS -->
<style>
    .cart-container {
        padding: 40px 20px; /* Apply padding to all sides, adjust top padding as needed */
        background-color: #f8f9fa; /* Light background for better contrast */
        border-radius: 8px; /* Rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        position: relative;
    }

    .table th, .table td {
        vertical-align: middle; /* Center-align content vertically */
    }

    .table img {
        max-width: 100px;
        border-radius: 8px; /* Rounded corners for images */
    }

    .table thead th {
        background-color: #343a40;
        color: #fff;
        text-align: center;
    }

    .btn-primary {
        background-color: #2B6377;
        border-color: #2B6377;
    }

    .btn-primary:hover {
        background-color: #12947f;
        border-color: #12947f;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }
</style>