<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">

            <h2>Кабинет пользователя</h2>
            <h3><p>Hello <?php Session::showLogin()?></p></h3>
            <ul>
                <li><a href="/user/edit">Редктировани данных</a></li>

            </ul>

    </div>

</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>