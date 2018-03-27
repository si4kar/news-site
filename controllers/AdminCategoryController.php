<?php

class AdminCategoryController extends AdminBase
{
    public function actionIndex()
    {
        self::checkAdmin();

        $categoriesList = Category::getCategoriesListAdmin();

        require_once (ROOT.'/views/admin_category/index.php');
        return true;
    }

    public function actionCreate()
    {
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['sort_order'] = $_POST['sort_order'];
            $options['status'] = $_POST['status'];

            $error = false;
            if (!isset($options['name']) || empty($options['name']) || empty($options['sort_order']) ||  empty($options['status'])) {
                $error = true;
                Session::setFlashError("Заполните поля");
            }
            if ($error == false) {
                Category::createCategory($options);

                Router::redirect('/admin/category/');
            }
        }
        require_once (ROOT.'/views/admin_category/create.php');
        return true;
    }

    public function actionDelete($id)
    {
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            Category::deleteCategoryById($id);
            Router::redirect('/admin/category');
        } elseif (isset($_POST['back'])) {
            Router::redirect('/admin/category');
        }
        require_once (ROOT.'/views/admin_category/delete.php');
        return true;
    }

    public function actionUpdate($id)
    {
        self::checkAdmin();

        $id = intval($id);

        $category = Category::getCategoryById($id);

        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['sort_order'] = $_POST['sort_order'];
            $options['status'] = $_POST['status'];
            Category::updateCategoryById($id, $options);

            Router::redirect('/admin/category');
        }

        require_once (ROOT.'/views/admin_category/update.php');
        return true;

    }

}