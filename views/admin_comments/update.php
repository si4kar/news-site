
<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/order">Управление комментариями</a></li>
                    <li class="active">Редактировать комментарий</li>
                </ol>
            </div>

            <?php if (Session::hasFlashError()) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php Session::flashError(); ?>
                </div>
            <?php } ?>

            <h4>Редактировать комментарий #<?=$id?></h4>

            <br/>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post">

                        <p>Комментарий пользователя</p>
                        <input type="text" name="description" placeholder="" value="<?=$comment['description']?>">

                        <p>Статус</p>
                        <select name="validation">
                            <option value="1" <?php if ($comment['validation'] == 1) echo ' selected="selected"'; ?>>Комментарий на одобрении</option>
                            <option value="0" <?php if ($comment['validation'] == 0) echo ' selected="selected"'; ?>>Комментарий одобрен</option>
                        </select>
                        <br>
                        <br>
                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                    </form>
                </div>
            </div>



        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>