<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $article['title']; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <style>
        .article-container {
            margin-top: 100px;
        }
        .article-title {
            font-weight: bold;
            margin-bottom: 20px;
        }
        .article-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            margin-bottom: 20px;
        }
        .article-content {
            margin-bottom: 20px;
        }
        .btn-back {
            display: block;
            width: 150px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<div class="container article-container">
    <h2 class="article-title text-center"><?php echo $article['title']; ?></h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?php if (!empty($article['image_url'])): ?>
                <img src="<?php echo base_url('uploads/' . $article['image_url']); ?>" class="img-fluid article-image" alt="Article Image">
            <?php endif; ?>
            <div class="article-content">
                <?php
                $content = nl2br($article['content']); // Convert newline to <br>
                $content = str_replace(['<b>', '</b>'], ['<strong>', '</strong>'], $content); // Replace <b> with <strong>
                echo $content;
                ?>
            </div>
            <!-- <a href="<?php echo site_url('articles'); ?>" class="btn btn-primary btn-back">Back to Articles</a> -->
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/js/jquery-3.5.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>

</body>
</html>
