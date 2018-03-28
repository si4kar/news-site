<?php include ROOT . '/views/layouts/header.php'; ?>

    <div class="container">
        <!-- Example row of columns -->
        <div class="row">
            <div class="col-md-2">
                <h2>Heading</h2>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
            </div>
            <div class="col-md-8">

                <?php foreach ($categories as $category): ?>
                <h2><?=$category['name']?></h2>
                    <?php $articles = Article::getArticleListByCategory($category['id']);?>
                    <?php foreach ($articles as $article): ?>
                    <p><a href=""><?=$article['name']?></a></p>


                    <?php endforeach; ?>
                <?php endforeach; ?>


        </div>

<?php include ROOT . '/views/layouts/footer.php'; ?>