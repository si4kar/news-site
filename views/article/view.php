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
                <h2><?php echo $article['name']; ?></h2>

                <img src="<?php echo Article::getImage(20)?>" width="300" height="200" alt="no" />

                <h5>Описание статьи</h5>
                <p> <?php echo $article['description'] ?></p>

                <h5>Текущее кол-во просмотров <?php Article::currentVisitors() ?></h5>
                <h5>Количество просмотров данной статьи <?=$article['visitors']?></h5>


                <br/>
                <br/>
                <?php /*include ROOT.'/views/comments/comments.php'; */?>
                <div class="col-sm-5">
                    <h3>Комментарии:</h3>
                    <?php foreach ($comments as $comment): ?>
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
                        <br/>
                        <br/>
                    <?php endforeach; ?>
                </div>

                <div class="col-sm-5">
                    <?php if(Session::get('login') != null) { ?>

                        <div class="login-form">
                            <form action="#" method="post">

                                <p>Добавить комментарий</p>
                                <textarea name="description"  cols="80" rows="7"></textarea>
                                <input type="hidden" name="article_id" value="<?=$article['id']?>">
                                <input type="hidden" name="user_id" value="<?=Session::get('userId')?>">

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