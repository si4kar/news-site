<?php

class Category
{
    const SHOW_BY_DEFAULT = 6;

    public static function getCategoriesList()
    {
        $db = Db::getConnection();
        $categoryList = [];

        $result =   $db->query('SELECT id, name from category');

        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }
        var_dump($categoryList);
        return $categoryList;
    }

    /**
     * @param $categoryList
     * @param $parent_id
     * @return null|string
     */
    public static function createTree($categoryList, $parent_id)
    {
        if(is_array($categoryList) and  isset($categoryList[$parent_id])) {
            $tree = '<ul>';
            foreach ($categoryList[$parent_id] as $category) {
                $tree .= "<li style='list-style-type: none; '><a style='color: black;' href='#" . $category['id'] . "'>" . $category['name'] . "</a>";
                $tree .= Category::createTree($categoryList, $category['id']);
                $tree .= '</li>';
            }
            $tree .= '</ul>';
        }
        else return null;

        return $tree;

    }


    /*public static function createTreeForNav()
    {
        $db = Db::getConnection();
        $categoriesList = [];

        $result = $db->query('SELECT id, parent_id, name from category '
        . 'WHERE parent_id ="0"'
        . 'ORDER BY sort_order ASC');
        $i =0;

        while ($row = $result->fetch()) {
            $categoriesList[$i]['id'] = $row['id'];
            $categoriesList[$i]['parent_id'] = $row['parent_id'];
            $categoriesList[$i]['name'] = $row['name'];
            $i++;
        }

        return $categoriesList;
    }*/

    public static function createTreeForNav()
    {
        $db = Db::getConnection();
        $categoriesList = [];

        $result = $db->query('SELECT id, parent_id, name from category ORDER BY sort_order ASC');

        while( $item = $result->fetch()){
            $item['subitems'] = array();
            $categoriesList[$item['id'] ] = $item;
        }
        // строим само дерево
        $tree = array();
        foreach( $categoriesList as $id=>&$item )
            if( array_key_exists( $item['parent_id'], $categoriesList )  )  // если есть родительская вершина в дереве
                $categoriesList[$item['parent_id'] ]['subitems'][ $id ] =& $item;
            else // иначе - это вершина верхнего уровня
                $tree[ $id ] =& $item;
        // дерево построенно, возвращаем его из ф-ии

        return $tree;
    }

    public static function showCategoryInTree($id)
    {
        $tree = Category::createTreeForNav();
        $array = [];

        if(array_key_exists($id,$tree)) {
            $array[] = $tree[$id]['subitems'];
        }

        echo "<pre>";
        print_r($array);

    }


    public static function getCategoriesListAdmin()
    {
        $db = Db::getConnection();
        $categoryList = [];

        $result =   $db->query('SELECT id, name, sort_order, status from category ORDER BY sort_order ASC');

        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['sort_order'] = $row['sort_order'];
            $categoryList[$i]['status'] = $row['status'];
            $i++;
        }
        return $categoryList;
    }

    public static function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'Отображается';
                break;
            case '0':
                return 'Скрыта';
                break;
        }
    }

    public static function createCategory($options)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO category '
            . '(name, sort_order, status)'
            . 'VALUES '
            . '(:name, :sort_order, :status)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':sort_order', $options['sort_order'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

        if ($result->execute()) {
            Session::setFlash('OK');
            return $db->lastInsertId();
        }
        return 0;
    }

    public static function deleteCategoryById($id)
    {
        $db = Db::getConnection();

        $sql = "DELETE FROM category WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    public static function updateCategoryById($id, $options)
    {
        $db  = Db::getConnection();
        $sql = "UPDATE category
            SET 
                name = :name, 
                sort_order = :sort_order, 
                status = :status
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':sort_order', $options['sort_order'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

        if ($result->execute()) {
            Session::setFlash("OK");
            return $db->lastInsertId();
        }
        Session::setFlashError("Что-то пошло не так");
        return 0;
    }

    public static function getCategoryById($id)
    {
        $id = intval($id);

        if($id) {
            $db = Db::getConnection();

            $result = $db->query("SELECT * FROM category WHERE id=" . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();
        }
        return false;
    }

}