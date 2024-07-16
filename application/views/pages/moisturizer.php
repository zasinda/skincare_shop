<div class="container list-produk">
    <h2 class="text-center forbold">Moisturizer</h2>

        <?php foreach ($moisturizer as $prdk) : ?>

    <div class="row text-center card-detail">
        <div class="col-md-4">
            <div class="card">
                <img src="<?php echo base_url(). './uploads/'.$prdk->foto ?>" class="card-img-top rounded-img" alt="Product Image">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $prdk->nama_produk ?></h5>
                    <small><?php echo $prdk->detail ?></small><br>
                    <small><?php echo $prdk->stok ?></small><br>
                    <p class="card-text">Rp <?php echo number_format($prdk->harga, 0,',','.') ?></p>
                    <form action="<?php echo base_url('store/add_to_cart'); ?>" method="post">
                            <input type="hidden" name="id_produk" value="<?php echo $prdk->id_produk; ?>">
                            <button type="submit" class="btn btn-outline-primary">Add to cart</button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>