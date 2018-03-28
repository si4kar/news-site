<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление статьями</li>
                </ol>
            </div>

            <?php if (Session::hasFlash()) { ?>
                <div class="alert alert-info" role="alert">
                    <?php Session::flash(); ?>
                </div>
            <?php } ?>

            <a href="/admin/article/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить статью</a>

            <h4>Список статей</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID статьи</th>
                    <th>Название статьи</th>
                    <th style="width: 50%">Описание</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($articlesList as $article): ?>
                    <tr>
                        <td><?php echo $article['id']; ?></td>
                        <td><?php echo $article['name']; ?></td>
                        <td><?php echo $article['description']; ?></td>
                        <td><a href="/admin/article/update/<?=$article['id']?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i>Редактировать</a></td>
                        <td><a href="/admin/article/delete/<?=$article['id']?>" title="Удалить"><i class="fa fa-times"></i>Удалить</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>
