<?php

class ArticleController
{
    public function actionView($productId)
    {
        $categories = [];
        $categories = Category::getCategoriesList();

        $product = Article::getProductById($productId);


        require_once (ROOT.'/views/product/view.php');
        return true;
    }
}