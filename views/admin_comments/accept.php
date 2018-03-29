
<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Авторизация комментариев</li>
                </ol>
            </div>

            <h4>Список комментариев на авторизации</h4>

            <br/>


            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID заказа</th>
                    <th>Название категории</th>
                    <th>Название статьи</th>
                    <th>Имя пользователя</th>
                    <th>Описание</th>
                    <th>Дата комментария</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($commentsList as $comment): ?>
                    <tr>
                        <td>
                            <a href="/admin/comment/view/<?=$comment['id']?>">
                                <?php echo $comment['id']; ?>
                            </a>
                        </td>
                        <td><?php echo $comment['category']; ?></td>
                        <td><?php echo $comment['article']; ?></td>
                        <td><?php echo $comment['user_name']; ?></td>
                        <td><?php echo $comment['description']; ?></td>
                        <td><?php echo $comment['date']; ?></td>
                        <td><a href="/admin/comment/check/<?=$comment['id']?>" title="Авторизировать"><i class="fa fa-pencil-square-o"></i>Авторизировать</a></td>
                        <td><a href="/admin/comment/delete/accept/<?=$comment['id']?>" title="Удалить"><i class="fa fa-times"></i>Удалить</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>