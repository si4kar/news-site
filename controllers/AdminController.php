<?php

class AdminController extends AdminBase
{
    public function actionIndex()
    {
        self::checkAdmin();

        require_once (ROOT.'/views/admin/index.php');
        return true;
    }

    public function actionBackground()
    {
        self::checkAdmin();

        if (isset($_POST['back_admin']) || isset($_POST['back_main'])) {
            $background = $_POST['background'];
            if (isset($_POST['back_admin'])) {
                Session::set('background_admin', $background);
                } elseif (isset($_POST['back_main'])) {
                Session::set('background_main', $background);
                }
            Router::redirect('/admin/index');

        }
        require_once (ROOT.'/views/admin/background.php');
        return true;
    }
}