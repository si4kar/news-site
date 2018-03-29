<?php

class UserController
{
    public function actionRegister()
    {

        $name = '';
        $email = '';
        $password = '';
        $result = false;

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $error = false;

            if (!User::checkName($name)) {
                $error = true;

            }
            if (!User::checkEmail($email)) {
                $error = true;
            }
            if (!User::checkPassword($password)) {
                $error = true;
            }

            if (User::checkEmailExists($email)) {
                $error = true;
            }

            if ($error == false) {
                $result = User::register($name, $email, $password);
                Session::setFlash("Success");
                Router::redirect('/user/login/');
            }

        }

        require_once (ROOT . '/views/user/register.php');
        return true;
    }

    public function actionLogin()
    {
        $email = '';
        $password = '';

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $error = false;

            if (!User::checkEmail($email)) {
                $error = true;
            }
            if (!User::checkPassword($password)) {
                $error = true;
            }

            $userId = User::checkUserData($email, $password);

            if ($userId == false) {
                $error = true;

            }
            if ($error == false){
                User::user_login($userId);

            }
        }

        require_once (ROOT . '/views/user/login.php');
        return true;


    }

    public function actionExit()
    {
        Session::destroy();
        Router::redirect('/');
    }

    public function actionCommentators($id, $page =1)
    {
        $comments = Comment::getUserComments($id, $page);
        $userName = Comment::getUserById($id);

        $total = Comment::getTotalCommentsById($id);
        $pagination = new Pagination($total, $page, Article::SHOW_BY_DEFAULT, 'page-');

        require_once (ROOT . '/views/user/comments.php');
        return true;
    }
}