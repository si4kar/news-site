<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin/">Админпанель</a></li>
                    <li><a href="/admin/product">Управление статьями</a></li>
                    <li class="active">Редактировать статью</li>
                </ol>
            </div>


            <h4>Редактировать товар <?=$article['name']?></h4>

            <br/>

            <?php if (Session::hasFlashError()) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php Session::flashError(); ?>
                </div>
            <?php } ?>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Название статьи</p>
                        <input type="text" name="name" placeholder="" value="<?=$article['name']?>">

                        <p>Категория</p>
                        <select name="category_id">
                            <?php if (is_array($categoriesList)): ?>
                                <?php foreach ($categoriesList as $category): ?>
                                    <option value="<?=$category['id']?>" <?php if ($article['category_id'] == $category['id'])
                                        echo ' selected="selected"'; ?>>
                                        <?=$category['name']?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>

                        <br/><br/>

                        <p>Изображение статьи</p>
                        <img src="<?=Article::getImage($article['id'])?>" width="200" alt="" />
                        <input type="file" name="image" placeholder="" value="">

                        <p>Детальное описание</p>
                        <textarea name="description" rows = 6><?php echo $article['description']; ?></textarea>

                        <br/><br/>

                        <p>Аналитика</p>
                        <select name="analytic">
                            <option value="1" <?php if ($article['analytic'] == 1) echo ' selected="selected"'; ?>>Да</option>
                            <option value="0" <?php if ($article['analytic'] == 0) echo ' selected="selected"'; ?>>Нет</option>
                        </select>

                        <br/><br/>
                        <p>Новинка</p>
                        <select name="is_new">
                            <option value="1" <?php if ($article['is_new'] == 1) echo ' selected="selected"'; ?>>Да</option>
                            <option value="0" <?php if ($article['is_new'] == 0) echo ' selected="selected"'; ?>>Нет</option>
                        </select>

                        <br/><br/>

                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">

                        <br/><br/>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>
