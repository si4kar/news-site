<?php

class User
{
    public static function register($name, $email, $password)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO user (name, email, password) VALUES (:name, :email, :password)';
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function checkName($name)
    {
        if(strlen($name)>2) return true;
        Session::setFlashError("Name must contain more than 2 characters");
        return false;
    }

    public static function checkEmail($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) return true;
        Session::setFlashError("Email is not correct");
        return false;
    }

    public static function checkPassword($password)
    {
        if(strlen($password >=6)) return true;
        Session::setFlashError("Password must be longer than 5 characters");
        return false;
    }

    public static function checkEmailExists($email)
    {
        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR );
        $result->execute();

        if ($result->fetchColumn()) {
            Session::setFlashError("This email has already busy");
            return true;
        }
            return false;
    }

    public static function checkUserData($email, $password)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM user WHERE email = :email AND password = :password';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_INT);

        $result->execute();

        $user = $result->fetch();
        if ($user) return $user['id'];
        Session::setFlashError("Email or password is not correct");
        return false;

    }

    public static function checkPhone($phone)
    {
        if (strlen($phone) >= 10) {
            return true;
        }

        Session::setFlashError("Phone number is incorrect");
        return false;
    }

    public static function user_login($userId)
    {
        $userId = intval($userId);
        $db = Db::getConnection();
        $result = $db->query('SELECT name FROM user WHERE id='.$userId);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $name = $result->fetch();

        Session::set('userId', $userId);
        Session::set('login', $name);
        Router::redirect('/catalog/');
    }

    public static function isGuest()
    {
        if (Session::get('login')) {
            return false;
        }

        return true;
    }

    public static function checkLogged($key = 'login')
    {
        if (Session::get($key)) {
            return Session::get($key);
        }

        Router::redirect('/user/login/');
    }

    public static function user_logout()
    {
        Session::destroy();
        Router::redirect('/user/login/');
    }

    public static function getUserById($id)
    {
        if ($id) {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM user WHERE id = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            // Указываем, что хотим получить данные в виде массива
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();


            return $result->fetch();
        }
    }
}