<?php

class AdminProductController extends AdminBase
{
    public function ActionIndex()
    {
        self::checkAdmin();

        $productsList = Product::getProductsList();

        require_once (ROOT.'/views/admin_product/index.php');
        return true;
    }

    public function ActionCreate()
    {
        self::checkAdmin();

        $categoriesList = Category::getCategoriesListAdmin();

        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];

            $error = false;

            if (!isset($options['name']) || empty($options['name'])) {
                $error = true;
                Session::setFlashError("Заполните поля");
            }
            if ($error == false) {
                $id = Product::createProduct($options);

                if ($id) {
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']
                            . "/webroot/upload/images/products/{$id}.jpg");
                    }
                };
                Router::redirect('/admin/product/');
            }
        }
        require_once (ROOT.'/views/admin_product/create.php');
        return true;

    }

    public function actionUpdate($id)
    {
        self::checkAdmin();
        $id = intval($id);

        $product = Product::getProductById($id);
        $categoriesList = Category::getCategoriesListAdmin();

        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];

            if (Product::updateProductById($id, $options)) {
                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                    move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/webroot/upload/images/products/{$id}.jpg");
                }
            }
            Router::redirect('/admin/product');
        }

        require_once (ROOT.'/views/admin_product/update.php');
        return true;

    }


    public function actionDelete($id)
    {
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            Product::deleteProductById($id);
            Router::redirect('/admin/product');
        } elseif (isset($_POST['back'])) {
            Router::redirect('/admin/product');
        }
        require_once (ROOT.'/views/admin_product/delete.php');

        return true;

    }

}