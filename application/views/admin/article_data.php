<div class="container-fluid">
    <button type="button" class="btn btn-warning" data-target="#addArticleModal" data-toggle="modal">
        Add Article
    </button>

    <div class="table-responsive mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Image</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($articles)) : ?>
                    <?php $no=1; foreach($articles as $article): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $article['title']; ?></td>
                        <td><?php echo substr($article['content'], 0, 100); ?>...</td>
                        <td><img src="<?php echo base_url('uploads/'.$article['image_url']); ?>" width="100"></td>
                        <td><?php echo $article['created_at']; ?></td>
                        <td>
                            <a href="<?php echo site_url('admin/articles_admin/edit/'.$article['id']); ?>" class="btn btn-primary btn-block mb-2">Edit</a>
                            <a href="<?php echo site_url('admin/articles_admin/delete/'.$article['id']); ?>" class="btn btn-danger btn-block">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6" class="text-center">No articles found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addArticleModal" tabindex="-1" role="dialog" aria-labelledby="addArticleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addArticleModalLabel">Add Article</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="<?php echo base_url(). 'admin/Articles_admin/add'?>" method="post" enctype="multipart/form-data">
      <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
          </div>
          <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
          </div>
          <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
          </div>
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
