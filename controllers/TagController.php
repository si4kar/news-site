<?php

class TagController
{
    public function actionIndex($id)
    {
        $categories = Category::getCategoriesList();
        $tagName = Tag::getTagById($id);
        $articleIdsList = Tag::getArticleListByTagId($id);
        $articleList = Article::getArticlesByIds($articleIdsList);

        require_once(ROOT . '/views/tag/index.php');
        return true;

    }
}