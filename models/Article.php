<?php


class Article
{
    const SHOW_BY_DEFAULT = 5;

    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT, $page =1)
    {
        $page = intval($page);
        $count = intval($count);
        $offset = ($page) * $count;

        $db = Db::getConnection();
        $productList = [];

        $result = $db->query('SELECT id, name, price, availability, is_new FROM product '
            . 'WHERE status = "1"'
            . 'ORDER BY id DESC '
            . "LIMIT " . $count
            . ' OFFSET '. $offset);

        $i = 0;

        while ($row = $result->fetch()) {
            $productList[$i]['id'] = $row['id'];
            $productList[$i]['name'] = $row['name'];
            $productList[$i]['availability'] = $row['availability'];
            $productList[$i]['price'] = $row['price'];
            $productList[$i]['is_new'] = $row['is_new'];
            $i++;
        }

        return $productList;
    }

    public static function getArticleListByCategory($categoryId = false, $page = 1)
    {
        if($categoryId) {

            $page = intval($page);
            $offset = ($page-1) * self::SHOW_BY_DEFAULT;
            $db = Db::getConnection();

            $articles = [];

            $result = $db->query("SELECT id, name FROM article "
                    . "WHERE category_id = '$categoryId' "
                    . "LIMIT ".self::SHOW_BY_DEFAULT
                    . ' OFFSET '. $offset);

            $i =0;

            while ($row = $result->fetch()) {
                $articles[$i]['id'] = $row['id'];
                $articles[$i]['name'] = $row['name'];
               // $products[$i]['image'] = $row['image'];
                $i++;
            }
            return $articles;
        }
    }

    public static function getArticleById($id)
    {
        $id = intval($id);

        if($id) {
            $db = Db::getConnection();

            $result = $db->query("SELECT * FROM article WHERE id=" . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();

        }
    }

/*    public static function getTotalProductsInCategory($categoryId)
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM product '
                                        . 'WHERE status="1" AND category_id="'.$categoryId.'"');


        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }*/

/*    public static function getTotalProducts()
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM product '
            . 'WHERE status="1"');


        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }*/

/*    public static function getProductsByIds($idsArray)
    {
        $products = [];

        $db = Db::getConnection();

        $idString = implode(',', $idsArray);

        $sql = "SELECT * FROM product WHERE status='1' AND id IN ($idString)";

        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;

        while ($row = $result->fetch()) {

            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];

            $i++;
        }

        return $products;
    }*/

   /* public static function getRecommendedProducts()
    {
        $db = Db::getConnection();

        $productsList = array();

        $result = $db->query('SELECT id, name, price, is_new FROM product '
            . 'WHERE status = "1" AND is_recommended = "1"'
            . 'ORDER BY id DESC ');

        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $productsList;
    }*/

    public static function getArticlesList()
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT id, name, is_new, description FROM article ORDER BY id ASC');
        $articlesList = [];
        $i = 0;

        while ($row = $result->fetch()) {
            $articlesList[$i]['id'] = $row['id'];
            $articlesList[$i]['name'] = $row['name'];
            $articlesList[$i]['is_new'] = $row['is_new'];
            $articlesList[$i]['description'] = $row['description'];
            $i++;
        }
        return $articlesList;
    }

    public static function deleteArticleById($id)
    {
        $db = Db::getConnection();

        $sql = "DELETE FROM article WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    public static function createArticle($options)
    {
        $db  = Db::getConnection();
        $sql = 'INSERT INTO article '
            . '(name, category_id, analitic,'
            . 'description, is_new)'
            . 'VALUES (:name, :category_id, :analitic, :description, :is_new)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':analitic', $options['analitic'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);

        if ($result->execute()) {
            Session::setFlash('OK');
            return $db->lastInsertId();
        }

        return 0;
    }

    public static function updateArticleById($id, $options)
    {
        $db  = Db::getConnection();
        $sql = "UPDATE article
            SET 
                name = :name, 
                category_id = :category_id, 
                description = :description, 
                analitic = :analitic, 
                is_new = :is_new 
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':analitic', $options['analitic'], PDO::PARAM_INT);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);

        if ($result->execute()) {
            Session::setFlash('OK');
            return $db->lastInsertId();
        }
        Session::setFlashError("Что-то пошло не так");
        return 0;
    }

    public static function getImage($id)
    {
        $noImage = 'no-image.jpg';

        $path = '/webroot/upload/images/article/';
        $pathToProductImage = $path . $id . '.jpg';
        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            return $pathToProductImage;
        }
        // Возвращаем путь изображения-пустышки
        return $path . $noImage;
    }
}