<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">


            <h2 style="padding-top: 30px">Добрый день, <?php Session::showLogin() ?>!</h2>
            <p><h4>Вам доступны такие возможности:</h4></p>


            <ul>
                <li><a href="/admin/article">Управление статьями</a></li>
                <li><a href="/admin/category">Управление категориями</a></li>
                <li><a href="/admin/comment">Управление комментариями</a></li>
                <li><a href="/admin/accept">Список комментариев на авторизацию</a></li>
                <li><a href="/admin/background">Изминения фона сайта</a></li>
            </ul>

    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>
