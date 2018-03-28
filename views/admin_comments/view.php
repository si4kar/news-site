<?php include ROOT . '/views/layouts/header_admin.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <br/>

                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админпанель</a></li>
                        <li><a href="/admin/comment">Управление комментариями</a></li>
                        <li class="active">Просмотр комментария</li>
                    </ol>
                </div>


                <h4>Просмотр комментария #<?=$comment['id']?></h4>
                <br/>

                <h5>Информация о комментарии</h5>
                <table class="table-admin-small table-bordered table-striped table">
                    <tr>
                        <td>Номер комментария</td>
                        <td><?php echo $comment['id']; ?></td>
                    </tr>
                    <tr>
                        <td>Название статьи</td>
                        <td><?php echo $comment['article']; ?></td>
                    </tr>
                    <tr>
                        <td>Название катеории</td>
                        <td><?php echo $comment['category']; ?></td>
                    </tr>
                    <tr>
                        <td>Имя пользователя</td>
                        <td><?php echo $comment['user_name']; ?></td>
                    </tr><tr>
                        <td>Комментарий пользователя</td>
                        <td><?php echo $comment['description']; ?></td>
                    </tr>
                    <tr>
                        <td><b>Статус комментария</b></td>
                        <td><?php echo Comment::getStatusText($comment['validation']); ?></td>
                    </tr>
                    <tr>
                        <td><b>Дата комментария</b></td>
                        <td><?php echo $comment['date']; ?></td>
                    </tr>
                </table>

                <h5>Все комментарии данного пользователя</h5>

                <table class="table-admin-medium table-bordered table-striped table ">
                    <tr>
                        <th>Статья</th>
                        <th>Категория</th>
                        <th>Комментарии</th>
                        <th>Статус</th>
                    </tr>
                    <?php foreach ($userComments as $userComment): ?>
                        <tr>
                            <td><?php echo $userComment['article']; ?></td>
                            <td><?php echo $userComment['category']; ?></td>
                            <td><?php echo $userComment['description']; ?></td>
                            <td><?php echo Comment::getStatusText($userComment['validation']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>

                <a href="/admin/comment/" class="btn btn-default back"><i class="fa fa-arrow-left"></i> Назад</a>
            </div>


    </section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>