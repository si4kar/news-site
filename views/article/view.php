<?php include ROOT.'/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3 left-sidebar">
                    <h3 style="text-align: center">Каталог</h3>
                        <?php foreach ($categories as $categoryItem): ?>
                            <div class="panel panel-default">
                                    <h5 class="panel-title" style="text-align: center">
                                        <a href="/category/<?php echo $categoryItem['id'];?>">
                                            <?php echo $categoryItem['name'];?>
                                        </a>
                                    </h5>
                            </div>
                        <?php endforeach; ?>
            </div>

            <div class="col-sm-9">
                <?php if (Session::hasFlash()) { ?>
                <p><?=Session::flash()?></p>
                <?php } ?>

                <h2>Категория <a href="/category/<?=$categoryName['id']?>"><?=$categoryName['name']?></a></h2>
                <h2>Статья <?=$article['name']?></h2>

                <img src="<?php echo Article::getImage($article['id'])?>" width="200" height="180" alt="no" />

                <h5>Описание статьи</h5>
                <?php if(Session::get('login') != null) { ?>
                    <p> <?=$article['description']?></p>
                <?php }  ?>

                <?php if(Session::get('login') == null && $article['analytic'] == 1) { ?>
                    <p> <?php echo Article::splitText($article['description']);?></p>
                <?php }  ?>

                <h6>Теги по данной статье:</h6>
                <div>
                    <?php foreach ($tags as $key => $value): ?>
                    <a href="/tag/<?=$key?>"><?=$value?></a>
                    <?php endforeach; ?>
                </div>

                <h5>Текущее кол-во просмотров <?php Article::currentVisitors() ?></h5>
                <h5>Количество просмотров данной статьи <?=$article['visitors']?></h5>


                <br/>
                <br/>
                <?php /*include ROOT.'/views/comments/comments.php'; */?>
                <div class="col-sm-5">
                    <?php foreach ($comments as $comment): ?>
                        <h3>Комментарии:</h3>
                        <?php if($comment['category_id'] != 4){ ?>

                            <p><a href="/user/<?=$comment['user_id']?>">Автор <?=Comment::getUserById($comment['user_id'])?></a> </p>
                            <p><?=$comment['description']?></p>
                            <p><?=$comment['date']?></p>
                            <p>Рейтинг <?=$comment['rating']?></p>
                            <form action="" method="post">
                                <input type="submit" name="down" value="down">
                                <input type="submit" name="up" value="up">
                                <input type="hidden" name = "comment_id" value="<?=$comment['id']?>">
                                <input type="hidden" name = "rating" value="<?=$comment['rating']?>">
                            </form>

                    <?php } ?>

                        <?php if($comment['category_id'] == 4 && $comment['validation'] == 0 ){ ?>
                            <p><a href="/user/<?=$comment['user_id']?>">Автор <?=Comment::getUserById($comment['user_id'])?></a> </p>
                            <p><?=$comment['description']?></p>
                            <p><?=$comment['date']?></p>

                            <p>Рейтинг <?=$comment['rating']?></p>

                            <form action="" method="post">
                                <input type="submit" name="down" value="down">
                                <input type="submit" name="up" value="up">
                                <input type="hidden" name = "comment_id" value="<?=$comment['id']?>">
                                <input type="hidden" name = "rating" value="<?=$comment['rating']?>">
                            </form>

                    <?php } ?>
                    <?php endforeach; ?>
                        <br>
                        <br>
                    <div class="container contPagination">
                        <h5>
                            <?php echo $pagination->get(); ?>
                        </h5>
                    </div>
                </div>

                <div class="col-sm-5">
                    <?php if(Session::get('login') != null) { ?>

                        <div class="login-form">
                            <form action="#" method="post">

                                <p>Добавить комментарий</p>
                                <textarea name="description"  cols="80" rows="7"></textarea>
                                <input type="hidden" name="article_id" value="<?=$article['id']?>">
                                <input type="hidden" name="user_id" value="<?=Session::get('userId')?>">

                                <?php if($article['category_id'] == 4) { ?>
                                    <input type="hidden" name="validation" value="1">
                                    <?php Session::setFlash("Комментарий появится после одобрения модератора"); ?>
                                <?php } ?>

                                <?php if($article['category_id'] != 4) { ?>
                                    <input type="hidden" name="validation" value="0">
                                <?php } ?>
                                <br><br>

                                <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                            </form>
                        </div>

                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<br/>
<br/>

<?php include ROOT.'/views/layouts/footer.php'; ?>