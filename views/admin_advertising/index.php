<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление рекламой</li>
                </ol>
            </div>

            <?php if (Session::hasFlash()) { ?>
                <div class="alert alert-info" role="alert">
                    <?php Session::flash(); ?>
                </div>
            <?php } ?>

            <a href="/admin/advertising/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить рекламу</a>

            <h4>Список рекламы</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID</th>
                    <th>Компания</th>
                    <th>Цена</th>
                    <th style="width: 50%">Описание</th>
                    <th>Сторона</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($advertisingList as $advertising): ?>
                    <tr>
                        <td><?php echo $advertising['id']; ?></td>
                        <td><?php echo $advertising['company_name']; ?></td>
                        <td><?php echo $advertising['price']; ?></td>
                        <td><?php echo $advertising['description']; ?></td>
                        <td><?php echo $advertising['side']; ?></td>
                        <td><a href="/admin/advertising/update/<?=$advertising['id']?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i>Редактировать</a></td>
                        <td><a href="/admin/advertising/delete/<?=$advertising['id']?>" title="Удалить"><i class="fa fa-times"></i>Удалить</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>
