<?php

class Session
{
    protected static $flash_message;
    protected static $flash_error;

    public static function setFlash($message)
    {
        self::$flash_message = $message;
    }
    public static function setFlashError($message)
    {
        self::$flash_error = $message;
    }

    public static function hasFlash()
    {
        return !is_null(self::$flash_message);
    }

    public static function hasFlashError()
    {
        return !is_null(self::$flash_error);
    }

    public static function flash()
    {
        echo self::$flash_message;
        self::$flash_message = null;
    }
    public static function flashError()
    {
        echo self::$flash_error;
        self::$flash_error = null;
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        if(isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }

    public static function delete($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public static function destroy()
    {
        session_destroy();
    }

    public static function showLogin()
    {
        if (isset($_SESSION['login'])) {
            echo implode("','", Session::get('login'));
        }

        return false;
    }
}