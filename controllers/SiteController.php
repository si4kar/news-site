<?php

class SiteController
{
    public function actionIndex()
    {
        $categories = Category::getCategoriesList();
        $topCommentators = Comment::getTopCommentators();
        $topArticles = Comment::getTopArticles();
        $lastArticles =Article::getLastArticles();

        $advertisingLeft = Advertising::getAdvertisingList(1);
        $advertisingRight = Advertising::getAdvertisingList(0);


        require_once(ROOT.'/views/site/index.php');
        return true;
    }

}