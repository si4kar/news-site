<?php

class Advertising
{
    public static function getAdvertisingList($side)
    {
        $db = Db::getConnection();
        $advertisingList = [];

        $result = $db->query('SELECT * from advertising WHERE side ='. $side);

        $i = 0;
        while ($row = $result->fetch()) {
            $advertisingList[$i]['id'] = $row['id'];
            $advertisingList[$i]['company_name'] = $row['company_name'];
            $advertisingList[$i]['price'] = $row['price'];
            $advertisingList[$i]['description'] = $row['description'];
            $advertisingList[$i]['link'] = $row['link'];
            $i++;
        }
        return $advertisingList;
    }

    public static function getAdvertisingListAll()
    {
        $db = Db::getConnection();
        $advertisingList = [];

        $result = $db->query('SELECT * from advertising');

        $i = 0;
        while ($row = $result->fetch()) {
            $advertisingList[$i]['id'] = $row['id'];
            $advertisingList[$i]['company_name'] = $row['company_name'];
            $advertisingList[$i]['price'] = $row['price'];
            $advertisingList[$i]['description'] = $row['description'];
            $advertisingList[$i]['link'] = $row['link'];
            $advertisingList[$i]['side'] = $row['side'];
            $i++;
        }
        return $advertisingList;
    }
    public static function getAdvertisingById($id)
    {
        $id = intval($id);

        if($id) {
            $db = Db::getConnection();

            $result = $db->query("SELECT * FROM advertising WHERE id=" . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();

        }
    }

    public static function createAdvertising($options)
    {
        $db  = Db::getConnection();
        $sql = 'INSERT INTO advertising '
            . '(company_name, price, description, link, side)'
            . 'VALUES (:company_name, :price, :description, :link, :side)';

        $result = $db->prepare($sql);
        $result->bindParam(':company_name', $options['company_name'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':link', $options['link'], PDO::PARAM_STR);
        $result->bindParam(':side', $options['side'], PDO::PARAM_INT);

        if ($result->execute()) {
            Session::setFlash('OK');
            return $db->lastInsertId();
        }
        return 0;
    }

    public static function updateAdvertisingById($id, $options)
    {
        $db  = Db::getConnection();
        $sql = "UPDATE advertising
            SET 
                company_name = :company_name, 
                price = :price, 
                description = :description, 
                link = :link, 
                side = :side
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':company_name', $options['company_name'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':link', $options['link'], PDO::PARAM_STR);
        $result->bindParam(':side', $options['side'], PDO::PARAM_INT);

        if ($result->execute()) {
            Session::setFlash('OK');
            return true;
        }
        Session::setFlashError("Что-то пошло не так");
        return 0;
    }

    public static function deleteAdvertisingById($id)
    {
        $db = Db::getConnection();

        $sql = "DELETE FROM advertising WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

}