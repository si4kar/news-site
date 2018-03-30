<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Изминения цвета фона сайта</li>
                </ol>
            </div>

            <form action="" method="post">
                <select name="background">
                    <option value="white">White</option>
                    <option value="lightgreen">Green</option>
                    <option value="paleturquoise">Blue</option>
                </select>

                <input type="submit" name="back_admin" value="Применить для admin">
                <input type="submit" name="back_main" value="Применить для сайта">

            </form>
          
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>
