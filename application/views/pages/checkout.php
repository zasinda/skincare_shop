<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="checkout-container">
            <div class="checkout-header">
                <h2 class="text-center mb-4">Checkout</h2>
            </div>
            <div class="checkout-body">
                <form action="<?php echo site_url('store/process_payment'); ?>" method="post">
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo $nama_lengkap; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email_user">Email</label>
                        <input type="email" class="form-control" id="email_user" name="email_user" value="<?php echo $email_user; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="alamat_user">Alamat</label>
                        <input type="text" class="form-control" id="alamat_user" name="alamat_user" value="<?php echo $alamat_user; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="kurir">Opsi Pengiriman</label>
                        <select class="form-control" id="kurir" name="kurir" required>
                            <option value="">-- Pilih Opsi Pengiriman --</option>
                            <option value="jne">JNE</option>
                            <option value="JnT">JnT</option>
                            <option value="pos">POS Indonesia</option>
                            <option value="tiki">TIKI</option>
                            <option value="SiCepat">SiCepat</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="biaya_pengiriman">Biaya Pengiriman</label>
                        <input type="number" class="form-control" id="biaya_pengiriman" name="biaya_pengiriman" value="12000" required>
                    </div>
                    <div class="form-group">
                        <label for="metode_pembayaran">Metode Pembayaran</label>
                        <select class="form-control" id="metode_pembayaran" name="metode_pembayaran" required>
                        <option value="">-- Pilih Opsi Pembayaran --</option>
                            <option value="transfer_bank">BRI</option>
                            <option value="transfer_bank">BCA</option>
                            <option value="transfer_bank">BNI</option>
                            <option value="transfer_bank">Mandiri</option>
                            <option value="transfer_bank">Danamon</option>
                            <option value="ovo">OVO</option>
                            <option value="gopay">GoPay</option>
                            <option value="shopeepay">ShopeePay</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="total_harga">Total Harga</label>
                        <input type="text" class="form-control" id="total_harga" name="total_harga" value="Rp <?php echo number_format($total, 0, ',', '.'); ?>" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Bayar</button>
                </form>
                
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .checkout-container {
            margin-top: 50px;
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .checkout-header h2 {
            font-weight: bold;
            color: #2B6377;
        }

        .form-group label {
            font-weight: bold;
            color: #343a40;
        }

        .btn-primary {
            background-color: #2B6377;
            border-color: #2B6377;
        }

        .btn-primary:hover {
            background-color: #12947f;
            border-color: #12947f;
        }
    </style>
</body>
</html>
