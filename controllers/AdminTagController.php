<?php

class AdminTagController extends AdminBase
{
    public function actionIndex()
    {
        self::checkAdmin();

        $tagsList = Tag::getTagsList();

        require_once(ROOT . '/views/admin_tag/index.php');
        return true;
    }

    public function actionCreate()
    {
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];

            $error = false;
            if (!isset($options['name']) || empty($options['name'])) {
                $error = true;
                Session::setFlashError("Заполните поля");
            }
            if ($error == false) {
                $id = Tag::createTag($options);
            };
                Router::redirect('/admin/tag/');
        }

        require_once(ROOT . '/views/admin_tag/create.php');
        return true;

    }

    public function actionUpdate($id)
    {
        self::checkAdmin();
        $id = intval($id);

        $tag = Tag::getTagById($id);

        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];


            Tag::updateTagById($id, $options);

            Router::redirect('/admin/tag');
        }

        require_once(ROOT . '/views/admin_tag/update.php');
        return true;

    }

    public function actionDelete($id)
    {
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            Tag::deleteTagById($id);
            Router::redirect('/admin/tag');
        } elseif (isset($_POST['back'])) {
            Router::redirect('/admin/tag');
        }
        require_once(ROOT . '/views/admin_tag/delete.php');

        return true;

    }
}