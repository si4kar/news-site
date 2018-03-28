
<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление комментариями</li>
                </ol>
            </div>

            <h4>Список комментариев</h4>

            <br/>


            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID заказа</th>
                    <th>Название категории</th>
                    <th>Название статьи</th>
                    <th>Имя пользователя</th>
                    <th>Дата комментария</th>
                    <th>Статус</th>
                    <th></th>
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
                        <td><?php echo $comment['date']; ?></td>
                        <td><?php echo Comment::getStatusText($comment['validation']); ?></td>
                        <td><a href="/admin/comment/view/<?=$comment['id']?>" title="Смотреть"><i class="fa fa-eye"></i>Смотреть</a></td>
                        <td><a href="/admin/comment/update/<?=$comment['id']?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i>Редактировать</a></td>
                        <td><a href="/admin/comment/delete/<?=$comment['id']?>" title="Удалить"><i class="fa fa-times"></i>Удалить</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>