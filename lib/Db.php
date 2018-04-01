<?php

class Db
{
    public static function getConnection()
    {
        $host = Config::get('db.host');
        $dbName = Config::get('db.db_name');

        $db = new PDO("mysql:host={$host};dbname={$dbName}", Config::get('db.user'), Config::get('db.password'));
        $db->exec("set names utf8");
        return $db;
    }

}