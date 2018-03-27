<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <h1>Кабинет пользователя</h1>
            <h2>Hello <?php Session::showLogin()?></h2>
            <ul>
                <li><a href="/user/edit">Редктировани данных</a></li>
                <li><a href="/user/history">Список покупок</a></li>

            </ul>
        </div>

    </div>

</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>