<div class="container articles">
    <h2 class="text-center forbold">ARTICLE</h2>
        <div class="row card-detail">
        <?php foreach ($articles as $article): ?>
            <div class="col-md-4">
                <div class="card">
                    <img src="<?php echo base_url('uploads/' . $article['image_url']); ?>" class="card-img-top" alt="Article Image" width="100" height="200">
                    <div class="card-body text-center">
                        <h5 class="card-title text-left"><?php echo $article['title']; ?></h5>
                        <p class="card-text text-left"><?php echo substr($article['content'], 0, 150) . '...'; ?></p>
                        <a href="<?php echo site_url('articles/view/'.$article['id']); ?>" class="btn btn-outline-primary">View Article</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>