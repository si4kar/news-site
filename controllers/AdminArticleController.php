<?php

class AdminArticleController extends AdminBase
{
    public function actionIndex()
    {
        self::checkAdmin();

        $articlesList = Article::getArticlesList();

        require_once(ROOT . '/views/admin_article/index.php');
        return true;
    }

    public function actionCreate()
    {
        self::checkAdmin();
        $tagsList = Tag::getTagsList();
        $categoriesList = Category::getCategoriesListAdmin();
        $tagsArr = [];

        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['category_id'] = $_POST['category_id'];
            $options['analytic'] = $_POST['analytic'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $tagsArr = $_POST['tags'];


            $error = false;
            if (!isset($options['name']) || empty($options['name'])) {
                $error = true;
                Session::setFlashError("Заполните поля");
            }
            if ($error == false) {
                $id = Article::createArticle($options);
                Tag::addTagstoArticle($id, $tagsArr);
                if ($id) {
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/webroot/upload/images/article/{$id}.jpg");
                    }
                };
                Router::redirect('/admin/article/');
            }
        }

        require_once(ROOT . '/views/admin_article/create.php');
        return true;

    }

    public function actionUpdate($id)
    {
        self::checkAdmin();
        $id = intval($id);
        $tagsList = Tag::getTagsList();
        $article = Article::getArticleById($id);
        $categoriesList = Category::getCategoriesListAdmin();

        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['category_id'] = $_POST['category_id'];
            $options['description'] = $_POST['description'];
            $options['analytic'] = $_POST['analytic'];
            $options['is_new'] = $_POST['is_new'];
            $tagsArr = $_POST['tags'];

            if (Article::updateArticleById($id, $options)) {
                Tag::updateTagstoArticle($id, $tagsArr);
                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                    move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/webroot/upload/images/article/{$id}.jpg");
                }
            }
            Router::redirect('/admin/article');
        }

        require_once(ROOT . '/views/admin_article/update.php');
        return true;

    }


    public function actionDelete($id)
    {
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            Article::deleteArticleById($id);
            Router::redirect('/admin/article');
        } elseif (isset($_POST['back'])) {
            Router::redirect('/admin/article');
        }
        require_once(ROOT . '/views/admin_article/delete.php');

        return true;

    }

}