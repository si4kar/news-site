<?php include ROOT . '/views/layouts/header.php'; ?>

    <section>
        <div class="container" id="categoryIndexContainer">
        <div class="container-fluid">
            <div class="row row-offcanvas row-offcanvas-right">
                <div class="col-xs-6 col-sm-2 col-sm-pull-9 sidebar-offcanvas" id="sidebar">
                    <div class="list-group">
                        <h4>Collections:</h4>
                        <div class="panel-group category-products">
                            <div >
                                    <h4 class="panel-title" id="categoriesList">
                                        <?php echo $categories;?>
                                    </h4>
                            </div>
                        </div>
                    </div>
                </div><!--/.sidebar-offcanvas-->
                <div class="col-xs-12 col-sm-10 col-sm-push-3">

                    <div class="row" id="categoriesList">
                        <?php foreach ($productsList as $product): ?>
                        <div class="col-xs-6 col-lg-4">

                            <div class="card">
                                <div class="card-img">
                                    <img src="<?=Product::getImage($product['id'])?>" width="275px" height="300px" >
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        <?=$product['name']?>
                                    <p>price <?=$product['price']?>$</p>
                                    </p>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="/cart/add/<?php echo $product['id'];?>" data-id="<?=$product['id']?>" class="card-link">Add to cart</a>
                                </div>
                                <!--Нужно пофиксить вывод картинки is_new-->
                                <?php /*if ($product['is_new']): */?><!--
                                <img src="/webroot/images/home/new.png" class="new" alt="" />
                            --><?php /*endif; */?>
                            </div>
                        </div><!--/.col-xs-6.col-lg-4-->
                    <?php endforeach; ?>

                    </div><!--/row-->
                </div><!--/.col-xs-12.col-sm-9-->


            </div><!--/row-->



        </div><!--/.container-->
        </div>
    </section>

    <div class="container contPagination">
    <h5>
            <?php echo $pagination->get(); ?>
    </h5>
    </div>
<?php include ROOT . '/views/layouts/footer.php'; ?>