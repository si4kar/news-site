<?php

class CabinetController
{
    public function actionIndex()
    {
        require_once (ROOT . '/views/cabinet/index.php');

        return true;
    }

    public function actionBackground()
    {
        if (isset($_POST['back_main'])) {
            $background = $_POST['background'];
            Session::set('background_main', $background);
            Router::redirect('/cabinet/index');

        }
        require_once (ROOT.'/views/cabinet/background.php');
        return true;
    }


}