<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin/">Админпанель</a></li>
                    <li><a href="/admin/advertising">Управление рекламой</a></li>
                    <li class="active">Редактировать рекламу</li>
                </ol>
            </div>


            <h4>Редактировать рекламу <?=$advertising['company_name']?></h4>

            <br/>

            <?php if (Session::hasFlashError()) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php Session::flashError(); ?>
                </div>
            <?php } ?>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Название компании</p>
                        <input type="text" name="company_name" placeholder="" value="<?=$advertising['company_name']?>">

                        <br/><br/>

                        <p>Цена</p>
                        <input type="text" name="price" placeholder="" value="<?=$advertising['price']?>">

                        <br/><br/>

                        <p>Детальное описание</p>
                        <textarea name="description" rows = 6><?=$advertising['description']?></textarea>

                        <br/><br/>

                        <p>Ссылка на страницу</p>
                        <textarea name="link"><?=$advertising['link']?></textarea>

                        <br/><br/>

                        <p>Положение на странице</p>
                        <select name="side">
                            <option value="1" <?php if ($advertising['side'] == 1) echo ' selected="selected"'; ?>>Слева</option>
                            <option value="0" <?php if ($advertising['side'] == 0) echo ' selected="selected"'; ?>>Справа</option>
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
