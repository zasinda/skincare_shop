<div class="container-fluid">
<button type="button" class="btn btn-warning"  data-target="#addproduct" data-toggle="modal">
  Add Product
</button>


    <div class="table-responsive mt-3">
        <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Picture</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <?php
                $no=1;
                foreach($produk as $prdk) : ?>

                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $prdk->nama_produk ?></td>
                    <td><?php echo $prdk->kategori ?></td>
                    <td><?php echo $prdk->harga ?></td>
                    <td><?php echo $prdk->stok ?></td>
                    <td><a href="<?php echo base_url(). './uploads/'.$prdk->foto ?>" target="_blank"> <img src="<?php echo base_url(). './uploads/'.$prdk->foto ?> ?>" width="180px"></a></td>
                    <td><?php echo $prdk->detail ?></td>
                    <td><?php echo $prdk->tgl_masuk ?></td>
                    <td><?php echo anchor('admin/product_data/edit/' .$prdk->id_produk, '<div class="btn btn-primary">Edit</div>')?></td>
                    <td><?php echo anchor('admin/product_data/delete/' .$prdk->id_produk, '<div class="btn btn-danger">Delete</div>')?></td>
                </tr>

                <?php endforeach; ?>

        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addproduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url(). 'admin/product_data/tambah_aksi'?>" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label>Product Name</label>
            <input type="text" name="nama_produk" class="form-control">
        </div>

        <div class="form-group">
            <label>Price</label>
            <input type="text" name="harga" class="form-control">
        </div>

        <div class="form-group">
            <label>Category</label>
            <input type="text" name="kategori" class="form-control">
        </div>

        <div class="form-group">
            <label>Stock</label>
            <select name="stok" id="stok" class="form-control">
                <option value="tersedia">Tersedia</option>
                <option value="habis">Habis</option>
            </select>
        </div>

        <div class="form-group">
            <label>Picture</label>
            <input type="file" name="foto" accept="image/png, image/jpeg, image/jpg" class="form-control">
        </div>

        <?php if (isset($error)) : ?>
					<div class="invalid-feedback"><?= $error ?></div>
				<?php endif; ?>

        <div class="form-group">
            <label>Description</label>
            <input type="text" name="detail" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-warning" style="width: 30%">Add Product</button>
      </div>
      </form>
    </div>
  </div>
</div>