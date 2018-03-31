<?php include ROOT . '/views/layouts/header.php'; ?>

    <div class="container">
        <div class="row">

            <div class="card col-md-3">

                <?php foreach ($advertisingLeft as $advertising):?>
                    <div class="card" style="height: 250px;">
                        <h5 class="card-title">Реклама</h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?=$advertising['company_name']?></h6>
                        <p class="card-text"><?=$advertising['description']?></p>
                        <p class="card-price">Price <?=$advertising['price']?></p>
                        <a href="<?=$advertising['link']?>" target="_blank" class="card-link">Сайт продавца</a>
                    </div>
                <?php endforeach; ?>

            </div>

            <div class="col-md-6">

                <?php foreach ($categories as $category): ?>
                    <h2><a href="/category/<?=$category['id']?>">Категория <?=$category['name']?></a></h2>
                    <h4>5 последних новостей:</h4>
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

                <h4>ТОП 3 активных темы за сегодня:</h4>
                <?php foreach ($topArticles as $topArticle): ?>
                    <p><a href="/article/<?=$topArticle['article_id']?>"><?=$topArticle['article']?></a></p>

                <?php endforeach; ?>
                <br><br>
                <h4>Последние новости</h4>
                <div class="cycle-slideshow"
                     data-cycle-fx="scrollHorz"
                     data-cycle-speed="200">
                    <div class="cycle-overlay" style="padding-left: 100px"></div>


                    <?php foreach ($lastArticles as $article): ?>
                        <img src="<?php echo Article::getImage($article['id']); ?>"
                        data-cycle-title="<?=$article['name']?>" data-cycle-desc="" style="width: 300px; height: 200px">
                    <?php endforeach; ?>
                </div>

            </div>

            <div class="card col-md-3">
                <?php foreach ($advertisingRight as $advertising):?>
                    <div class="card" style="height: 250px">
                        <h5 class="card-title">Реклама</h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?=$advertising['company_name']?></h6>
                        <p class="card-text"><?=$advertising['description']?></p>
                        <p class="card-price">Price <?=$advertising['price']?></p>
                        <a href="<?=$advertising['link']?>" target="_blank" class="card-link">Сайт продавца</a>
                    </div>
                <?php endforeach; ?>
            </div>



        </div>


    </div>


<?php include ROOT . '/views/layouts/footer.php'; ?>