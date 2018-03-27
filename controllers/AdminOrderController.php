<?php

class AdminOrderController extends AdminBase
{
    public function actionIndex()
    {
        self::checkAdmin();
        $ordersList = Order::getOrderList();

        require_once (ROOT.'/views/admin_order/index.php');
        return true;
    }

    public function actionDelete($id)
    {
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            Order::deleteOrderById($id);
            Router::redirect('/admin/order');
        } elseif (isset($_POST['back'])) {
            Router::redirect('/admin/order');
        }
        require_once (ROOT.'/views/admin_order/delete.php');
        return true;
    }

    public function actionUpdate($id)
    {
        self::checkAdmin();

        $id = intval($id);

        $order = Order::getOrderById($id);

        if (isset($_POST['submit'])) {
            $options['user_name'] = $_POST['user_name'];
            $options['user_phone'] = $_POST['user_phone'];
            $options['user_comment'] = $_POST['user_comment'];
            $options['date'] = $_POST['date'];
            $options['status'] = $_POST['status'];
            Order::updateOrderById($id, $options);

            Router::redirect('/admin/order');
        }

        require_once (ROOT.'/views/admin_order/update.php');
        return true;
    }

    public function actionView($id)
    {
        self::checkAdmin();

        $order = Order::getOrderById($id);
        $productsQuantity = json_decode($order['products'], true);
        $productsIds = array_keys($productsQuantity);

        $products = Product::getProductsByIds($productsIds);

        require_once(ROOT . '/views/admin_order/view.php');
        return true;
    }
}