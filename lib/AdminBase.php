<?php

abstract class AdminBase
{
    public static function checkAdmin()
    {

        $userId = User::checkLogged('userId');
        $user = User::getUserById($userId);

        if ($user['role'] == 'admin') {
            return true;
        }
        die('Access denied');
    }
}