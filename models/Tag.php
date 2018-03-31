<?php

class Tag
{
    public static function getTagsList()
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT id, name FROM tags ORDER BY id ASC');
        $tagsList = [];
        $i = 0;

        while ($row = $result->fetch()) {
            $tagsList[$i]['id'] = $row['id'];
            $tagsList[$i]['name'] = $row['name'];
            $i++;
        }
        return $tagsList;
    }

    public static function getTagsListForAutocomplite()
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT id, name FROM tags ORDER BY id ASC');
        $tagsList = [];
        $i = 0;

        while ($row = $result->fetch()) {
            $tagsList[$i]['id'] = $row['id'];
            $tagsList[$i]['name'] = $row['name'];
            $i++;
        }
        echo json_encode($tagsList);
    }

    public static function createTag($options)
    {

        $db  = Db::getConnection();
        $sql = 'INSERT INTO tags (name) VALUES (:name)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);

        if ($result->execute()) {
            Session::setFlash('OK');
            return $db->lastInsertId();
        }

        return 0;
    }

    public static function getTagById($id)
    {
        $id = intval($id);

        if($id) {
            $db = Db::getConnection();

            $result = $db->query("SELECT * FROM tags WHERE id=" . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            $obj = $result->fetch();
            return $obj;

        }
    }

    public static function getTagsIdByArticleId($articleId)
    {
        $articleId= intval($articleId);

        if($articleId) {
            $db = Db::getConnection();
            $tags = [];
            $result = $db->query("SELECT tag_id FROM articleToTags WHERE article_id=" . $articleId);
            $i = 0;
            while ($row = $result->fetch()) {
                $tags[$i] = $row['tag_id'];
                $i++;
            }

            return $tags;
        }
    }

    public static function updateTagById($id, $options)
    {
        $db  = Db::getConnection();
        $sql = "UPDATE tags
            SET 
                name = :name 
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);

        if ($result->execute()) {
            Session::setFlash('OK');
            return true;
        }
        Session::setFlashError("Что-то пошло не так");
        return 0;
    }

    public static function deleteTagById($id)
    {
        $db = Db::getConnection();

        $sql = "DELETE FROM tags WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    public static function addTagsToArticle($id, $tagsArr)
    {
        foreach ($tagsArr as $tag) {

            $db = Db::getConnection();
            $sql = 'INSERT INTO articleToTags (article_id, tag_id) VALUES (:article_id, :tag_id)';

            $result = $db->prepare($sql);
            $result->bindParam(':article_id', $id, PDO::PARAM_INT);
            $result->bindParam(':tag_id', $tag, PDO::PARAM_INT);

            $result->execute();
        }
        return true;
    }

    public static function updateTagsToArticle($id, $tagsArr)
    {
        $db = Db::getConnection();

        $sql = "DELETE FROM articleToTags WHERE article_id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        $result->execute();
        foreach ($tagsArr as $tag) {

            $sql = 'INSERT INTO articleToTags (article_id, tag_id) VALUES (:article_id, :tag_id)';

            $result = $db->prepare($sql);
            $result->bindParam(':article_id', $id, PDO::PARAM_INT);
            $result->bindParam(':tag_id', $tag, PDO::PARAM_INT);

            $result->execute();
        }
        return true;
    }

    public static function getTagsByIds($tagsId)
    {
        $tags = [];

        $db = Db::getConnection();

        foreach ($tagsId as $tagId)
        {
            $i = 0;
            $result = $db->query("SELECT name FROM tags WHERE id = '$tagId'");

            while ($row = $result->fetch()) {
                $tags[$tagId] = $row['name'];
            }
            $i++;

        }

        return $tags;
    }

    public static function getArticleListByTagId($id)
    {
        $articlesId = [];

        $db = Db::getConnection();

            $i = 0;
            $result = $db->query("SELECT article_id FROM articleToTags WHERE tag_id = '$id'");

            while ($row = $result->fetch()) {
                $articlesId[$i] = $row['article_id'];
                $i++;
            }

        return $articlesId;
    }

}