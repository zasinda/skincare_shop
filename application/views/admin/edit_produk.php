<div class="container-fluid">
    <h3>EDIT PRODUCT</h3>

    <?php foreach ($produk as $prdk) : ?>
        <form method="post" action="<?php echo base_url().'admin/product_data/update'?>" enctype="multipart/form-data">

            <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="nama_produk" class="form-control" value="<?php echo $prdk->nama_produk?>">
            </div>

            <div class="form-group">
                <label>Price</label>
                <input type="text" name="harga" class="form-control" value="<?php echo $prdk->harga?>">
            </div>

            <div class="form-group">
                <label>Category</label>
                <input type="text" name="kategori" class="form-control" value="<?php echo $prdk->kategori?>">
            </div>

            <div class="form-group">
                <label>Stock</label>
                <select name="stok" id="stok" class="form-control" value="<?php echo $prdk->stok?>">
                    <option value="tersedia" <?php echo ($prdk->stok == 'tersedia') ? 'selected' : ''; ?>>Tersedia</option>
                    <option value="habis" <?php echo ($prdk->stok == 'habis') ? 'selected' : ''; ?>>Habis</option>
                </select>
            </div>

            <div class="form-group">
                <p>Picture</p>
                <img src="<?php echo base_url(). './uploads/'.$prdk->foto ?>" style="width:20%">
                <input type="file" name="foto" class="form-control">
                <input type="hidden" name="old_foto" value="<?php echo $prdk->foto; ?>">
            </div>

            <div class="form-group">
                <label>Description</label>
                <input type="hidden" name="id_produk" class="form-control" value="<?php echo $prdk->id_produk?>">
                <input type="text" name="detail" class="form-control" value="<?php echo $prdk->detail?>">
            </div>

            <button type="submit" class="btn btn-warning">SAVE</button>
        </form>
    <?php endforeach; ?>
</div>
