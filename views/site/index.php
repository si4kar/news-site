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
                <h2><a href="/category/<?=$category['id']?>"><?=$category['name']?></a></h2>
                    <?php $articles = Article::getArticleListByCategory($category['id']);?>

                    <?php foreach ($articles as $article): ?>
                        <p><a href="/article/<?=$article['id']?>"><?=$article['name']?></a></p>

                    <?php endforeach; ?>
                <?php endforeach; ?>

                <br/>
                <br/>
                <h4>ТОП 5 комментаторов</h4>
                <?php foreach ($topCommentators as $commentators): ?>
                    <p>Комментатор <a href="/user/<?=$commentators['user_id']?>"><?=$commentators['user_name']?></a> Количество комментариев <?=$commentators['count']?></p>
                    <p></p>

                <?php endforeach; ?>

                <h4>ТОП 3 активных темы:</h4>
                <?php foreach ($topArticles as $topArticle): ?>
                    <p><a href="/article/<?=$topArticle['article_id']?>"><?=$topArticle['article']?></a></p>

                <?php endforeach; ?>

            </div>


        </div>

<?php include ROOT . '/views/layouts/footer.php'; ?>