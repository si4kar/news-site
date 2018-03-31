<?php

class AdminAdvertisingController extends AdminBase
{
    public function actionIndex()
    {
        self::checkAdmin();

        $advertisingList = Advertising::getAdvertisingListAll();

        require_once(ROOT . '/views/admin_advertising/index.php');
        return true;
    }

    public function actionCreate()
    {
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            $options['company_name'] = $_POST['company_name'];
            $options['price'] = $_POST['price'];
            $options['description'] = $_POST['description'];
            $options['link'] = $_POST['link'];
            $options['side'] = $_POST['side'];

            $error = false;
            if (!isset($options['company_name']) || empty($options['company_name'])) {
                $error = true;
                Session::setFlashError("Заполните поля");
            }
            if ($error == false) {
                $id = Advertising::createAdvertising($options);
                Router::redirect('/admin/advertising/');
            }
        }

        require_once(ROOT . '/views/admin_advertising/create.php');
        return true;

    }

    public function actionUpdate($id)
    {
        self::checkAdmin();
        $id = intval($id);

        $advertising = Advertising::getAdvertisingById($id);

        if (isset($_POST['submit'])) {
            $options['company_name'] = $_POST['company_name'];
            $options['price'] = $_POST['price'];
            $options['description'] = $_POST['description'];
            $options['side'] = $_POST['side'];
            $options['link'] = $_POST['link'];


            Advertising::updateAdvertisingById($id, $options);
            Router::redirect('/admin/advertising');
        }

        require_once(ROOT . '/views/admin_advertising/update.php');
        return true;
    }

    public function actionDelete($id)
    {
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            Advertising::deleteAdvertisingById($id);
            Router::redirect('/admin/advertising');
        } elseif (isset($_POST['back'])) {
            Router::redirect('/admin/advertising');
        }
        require_once(ROOT . '/views/admin_advertising/delete.php');

        return true;

    }



}