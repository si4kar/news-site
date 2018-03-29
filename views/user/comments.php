<?php include ROOT . '/views/layouts/header.php'; ?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Каталог</h2>
                        <div class="panel-group category-products" id="accordian">
                            <?php foreach ($categories as $categoryItem): ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a href="/category/<?php echo $categoryItem['id'];?>">
                                                <?php echo $categoryItem['name'];?>
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    <h3 style="text-align: center">Комментатор <?=$userName?></h3>
                    <h5>Список комментариев:</h5>
                    <div class="product-details">
                        <div class="row">
                            <div class="col-sm-5">
                                <?php foreach ($comments as $comment): ?>
                                    <p><a href="/article/<?=$comment['article_id']?>"><?=$comment['article']?></a></p>
                                    <p><?=$comment['description']?></p>
                                    <p><?=$comment['date']?></p>
                                    <br/>
                                    <br/>
                                <?php endforeach; ?>
                            </div>

                        </div>
                    </div>
                </div>

    </section>

    <div class="container contPagination">
        <h5>
            <?php echo $pagination->get(); ?>
        </h5>
    </div>
<?php include ROOT . '/views/layouts/footer.php'; ?>