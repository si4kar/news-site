<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/category">Управление категориями</a></li>
                    <li class="active">Добавить категорию</li>
                </ol>
            </div>


            <h4>Добавить новую категорию</h4>

            <br/>

            <?php if (Session::hasFlashError()) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php Session::flashError(); ?>
                </div>
            <?php } ?>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post">

                        <p>Название</p>
                        <input type="text" name="name" placeholder="" value="">

                        <p>Порядковый номер</p>
                        <input type="text" name="sort_order" placeholder="" value="">

                        <p>Статус</p>
                        <select name="status">
                            <option value="1" selected="selected">Отображается</option>
                            <option value="0">Скрыта</option>
                        </select>

                        <br><br>

                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                    </form>
                </div>
            </div>


        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>
