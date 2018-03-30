<?php


class Article
{
    const SHOW_BY_DEFAULT = 5;

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

            $obj = $result->fetch();
            Article::setVisitors($obj['id'],$obj['visitors']);
            return $obj;

        }
    }

    public static function setVisitors($id, $visitors)
    {
        $visitors = $visitors+1;
        $db  = Db::getConnection();
        $sql = "UPDATE article
            SET 
                visitors = :visitors
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':visitors', $visitors, PDO::PARAM_INT);
        $result->execute();
        return $db->lastInsertId();

    }

    public static function currentVisitors()
    {
        $rand = rand(1, 15);
        echo $rand;
    }

    public static function getTotalArticlesInCategory($categoryId)
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM article '
                                        . 'WHERE category_id="'.$categoryId.'"');


        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }

    public static function getTotalArticles()
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM article');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }

/*    public static function getProductsByIds($idsArray)
    {
        $products = [];

        $db = Db::getConnection();

        $idString = implode(',', $idsArray);

        $sql = "SELECT * FROM article WHERE status='1' AND id IN ($idString)";

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

    public static function getArticleListPagination($page)
    {
        $page = intval($page);
        $offset = ($page-1) * self::SHOW_BY_DEFAULT;
        $db = Db::getConnection();

        $articles = [];

        $result = $db->query("SELECT id, name FROM article "
            . "ORDER BY id ASC "
            . "LIMIT ".self::SHOW_BY_DEFAULT
            . ' OFFSET '. $offset);

        $i =0;

        while ($row = $result->fetch()) {
            $articles[$i]['id'] = $row['id'];
            $articles[$i]['name'] = $row['name'];
            $i++;
        }
        return $articles;
    }

    public static function getArticlesListByCategory($categoryId = false, $page = 1)
    {
        if($categoryId) {

            $page = intval($page);
            $offset = ($page-1) * self::SHOW_BY_DEFAULT;
            $db = Db::getConnection();

            $articles = [];

            $result = $db->query("SELECT id, name FROM article "
                . "WHERE category_id = '$categoryId' "
                . "ORDER BY id ASC "
                . "LIMIT ".self::SHOW_BY_DEFAULT
                . ' OFFSET '. $offset);

            $i =0;

            while ($row = $result->fetch()) {
                $articles[$i]['id'] = $row['id'];
                $articles[$i]['name'] = $row['name'];
                $i++;
            }
            return $articles;
        }
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
            . '(name, category_id, analytic,'
            . 'description, is_new)'
            . 'VALUES (:name, :category_id, :analytic, :description, :is_new)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':analytic', $options['analytic'], PDO::PARAM_INT);
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
                analytic = :analytic, 
                is_new = :is_new
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':analytic', $options['analytic'], PDO::PARAM_INT);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);

        if ($result->execute()) {
            Session::setFlash('OK');
            return true;
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
        return $path . $noImage;
    }

    public static function getAnalyticList($page)
    {
        $page = intval($page);
        $offset = ($page-1) * self::SHOW_BY_DEFAULT;
        $db = Db::getConnection();

        $result = $db->query("SELECT * FROM article WHERE analytic = 1 "
            . "LIMIT ".self::SHOW_BY_DEFAULT
            . ' OFFSET '. $offset);
        $articlesList = [];
        $i =0;

        while ($row = $result->fetch()) {
            $articlesList[$i]['id'] = $row['id'];
            $articlesList[$i]['name'] = $row['name'];
            $articlesList[$i]['is_new'] = $row['is_new'];
            $articlesList[$i]['description'] = $row['description'];
            $articlesList[$i]['visitors'] = $row['visitors'];
            $i++;
        }
        return $articlesList;
    }

    public static function getTotalAnaliticArticlesInCategory()
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM article '
            . 'WHERE analytic = "1"');

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }

    public static function splitText($text)
    {
        $items =  preg_split("/[.?!] /", $text);

        if (key_exists(5, $items))
        {
            $items = array_slice($items, 5);
        }
        $text = implode(",", $items);

        echo $text;
        die;

    }
}