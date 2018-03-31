<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление тегами</li>
                </ol>
            </div>

            <?php if (Session::hasFlash()) { ?>
                <div class="alert alert-info" role="alert">
                    <?php Session::flash(); ?>
                </div>
            <?php } ?>

            <a href="/admin/tag/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить тег</a>

            <h4>Список тегов</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID статьи</th>
                    <th>Название тега</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($tagsList as $tag): ?>
                    <tr>
                        <td><?php echo $tag['id']; ?></td>
                        <td><?php echo $tag['name']; ?></td>
                        <td><a href="/admin/tag/update/<?=$tag['id']?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i>Редактировать</a></td>
                        <td><a href="/admin/tag/delete/<?=$tag['id']?>" title="Удалить"><i class="fa fa-times"></i>Удалить</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>
