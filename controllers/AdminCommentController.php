<?php

class AdminCommentController extends AdminBase
{
    public function actionIndex()
    {
        self::checkAdmin();
        $commentsList = Comment::getCommentList();

        require_once(ROOT . '/views/admin_comments/index.php');
        return true;
    }

    public function actionDelete($id)
    {
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            Comment::deleteCommentById($id);
            Router::redirect('/admin/comment');
        } elseif (isset($_POST['back'])) {
            Router::redirect('/admin/comment');
        }
        require_once(ROOT . '/views/admin_comments/delete.php');
        return true;
    }

    public function actionUpdate($id)
    {
        self::checkAdmin();

        $id = intval($id);

        $comment = Comment::getCommentById($id);

        if (isset($_POST['submit'])) {
            $options['description'] = $_POST['description'];
            $options['validation'] = $_POST['validation'];
            Comment::updateCommentById($id, $options);

            Router::redirect('/admin/comment');
        }

        require_once(ROOT . '/views/admin_comments/update.php');
        return true;
    }

    public function actionView($id)
    {
        self::checkAdmin();

        $comment = Comment::getCommentById($id);
        $comment['user_name'] = Comment::getUserById($comment['user_id']);
        $comment['article'] = Comment::getArticleById($comment['article_id']);
        $comment['category'] = Comment::getCategoryByArticleId($comment['article_id']);

        $userComments = Comment::getUserComments($comment['user_id']);

        require_once(ROOT . '/views/admin_comments/view.php');
        return true;
    }
}