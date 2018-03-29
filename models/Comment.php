<?php

class Comment
{
    public static function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'Комментарий на одобрении';
                break;
            case '0':
                return 'Комментарий одобрен';
                break;
        }
    }

    public static function getCommentList()
    {
        $db = Db::getConnection();

        $result = $db->query('
                  SELECT 
                    id, date, article_id, description, user_id, validation 
                    FROM comment 
                    ORDER BY validation DESC');
        $commentsList = [];
        $i = 0;
        while ($row = $result->fetch()) {
            $commentsList[$i]['id'] = $row['id'];
            $commentsList[$i]['date'] = $row['date'];
            $commentsList[$i]['article_id'] = $row['article_id'];
            $commentsList[$i]['description'] = $row['description'];
            $commentsList[$i]['user_id'] = $row['user_id'];
            $commentsList[$i]['validation'] = $row['validation'];
            $commentsList[$i]['user_name'] = Comment::getUserById($row['user_id']);
            $commentsList[$i]['article'] = Comment::getArticleById($row['article_id']);
            $commentsList[$i]['category'] = Comment::getCategoryByArticleId($row['article_id']);
            $i++;
        }
        return $commentsList;

    }

    public static function getCommentById($id)
    {
        $id = intval($id);

        if($id) {
            $db = Db::getConnection();

            $result = $db->query("SELECT * FROM comment WHERE id=" . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();
        }
        return false;
    }

    public static function getUserById($id)
    {
        $id = intval($id);

        if($id) {
            $db = Db::getConnection();

            $result = $db->query("SELECT name FROM user WHERE id=" . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            $result = $result->fetch();
            return $result['name'];

        }
    }

    public static function getArticleById($id)
    {
        $id = intval($id);

        if($id) {
            $db = Db::getConnection();

            $result = $db->query("SELECT name FROM article WHERE id=" . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            $result = $result->fetch();
            return $result['name'];

        }
    }

    public static function getCategoryByArticleId($id)
    {
        $id = intval($id);

        if($id) {
            $db = Db::getConnection();

            $result = $db->query("SELECT category_id FROM article WHERE id=" . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            $result = $result->fetch();

            $result2 = $db->query("SELECT name FROM category WHERE id=" . $result['category_id']);
            $result2->setFetchMode(PDO::FETCH_ASSOC);

            $result2 = $result2->fetch();
            return $result2['name'];

        }
    }

    public static function getUserComments($id, $page =1)
    {
        $id = intval($id);
        $page = intval($page);
        $offset = ($page-1) * Article::SHOW_BY_DEFAULT;
        if ($id) {
            $db = Db::getConnection();

            $result = $db->query("SELECT * FROM comment WHERE user_id= '$id' "
                . "LIMIT ".Article::SHOW_BY_DEFAULT
                . ' OFFSET '. $offset);
            $commentsList = [];
            $i = 0;
            while ($row = $result->fetch()) {
                $commentsList[$i]['id'] = $row['id'];
                $commentsList[$i]['date'] = $row['date'];
                $commentsList[$i]['article_id'] = $row['article_id'];
                $commentsList[$i]['description'] = $row['description'];
                $commentsList[$i]['user_id'] = $row['user_id'];
                $commentsList[$i]['validation'] = $row['validation'];
                $commentsList[$i]['user_name'] = Comment::getUserById($row['user_id']);
                $commentsList[$i]['article'] = Comment::getArticleById($row['article_id']);
                $commentsList[$i]['category'] = Comment::getCategoryByArticleId($row['article_id']);
                $i++;
            }
            return $commentsList;
        }


    }

    public static function deleteCommentById($id)
    {
        $db = Db::getConnection();

        $sql = "DELETE FROM comment WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    public static function updateCommentById($id, $options)
    {
        $db  = Db::getConnection();
        $sql = "UPDATE comment SET description = :description, validation = :validation WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':validation', $options['validation'], PDO::PARAM_INT);

        if ($result->execute()) {
            Session::setFlash('OK');
            return $db->lastInsertId();
        }
        Session::setFlashError("Что-то пошло не так");
        return 0;
    }

    public static function getArticleComments($id)
    {
        $id = intval($id);
        if ($id) {
            $db = Db::getConnection();

            $result = $db->query("SELECT * FROM comment WHERE article_id=" . $id);
            $commentsList = [];
            $i = 0;
            while ($row = $result->fetch()) {
                $commentsList[$i]['id'] = $row['id'];
                $commentsList[$i]['date'] = $row['date'];
                $commentsList[$i]['article_id'] = $row['article_id'];
                $commentsList[$i]['description'] = $row['description'];
                $commentsList[$i]['user_id'] = $row['user_id'];
                $commentsList[$i]['validation'] = $row['validation'];
                $commentsList[$i]['user_name'] = Comment::getUserById($row['user_id']);
                $commentsList[$i]['article'] = Comment::getArticleById($row['article_id']);
                $commentsList[$i]['category'] = Comment::getCategoryByArticleId($row['article_id']);
                $i++;
            }
            return $commentsList;
        }
    }

    public static function createComment($options)
    {
        $db  = Db::getConnection();
        $sql = 'INSERT INTO comment '
            . '(article_id, description, user_id)'
            . 'VALUES (:article_id, :description, :user_id)';

        $result = $db->prepare($sql);
        $result->bindParam(':article_id', $options['article_id'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':user_id', $options['user_id'], PDO::PARAM_INT);

        if ($result->execute()) {
            Session::setFlash('OK');
            return $db->lastInsertId();
        }

        return 0;
    }

    public static function getTotalCommentsById($id)
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM comment '
            . 'WHERE user_id="'.$id.'"');


        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }

    public static function getTopCommentators()
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT user_id, count(user_id) AS count FROM comment 
                                        GROUP BY user_id ORDER BY user_id ASC LIMIT 5');
        $commentsList = [];
        $i = 0;
        while ($row = $result->fetch()) {
            $commentsList[$i]['user_id'] = $row['user_id'];
            $commentsList[$i]['count'] = $row['count'];
            $commentsList[$i]['user_name'] = self::getUserById($row['user_id']);
            $i++;
        }

        return $commentsList;
    }


}