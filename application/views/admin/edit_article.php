<div class="container">
    <h3>Edit Article</h3>
    <form action="<?php echo base_url('admin/articles_admin/update'); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
        <input type="hidden" name="current_image" value="<?php echo $article['image_url']; ?>">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $article['title']; ?>" required>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="content" rows="5" required><?php echo $article['content']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            <?php if (!empty($article['image_url'])): ?>
                <img src="<?php echo base_url('uploads/'.$article['image_url']); ?>" class="img-fluid mt-2" width="100">
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
