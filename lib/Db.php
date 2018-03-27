<?php

class Db
{
    public static function getConnection()
    {
        $host = Config::get('db.host');
        $dbName = Config::get('db.db_name');

        $db = new PDO("mysql:host={$host};dbname={$dbName}", Config::get('db.user'), Config::get('db.password'));

        return $db;
    }

}