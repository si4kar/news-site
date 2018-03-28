<?php


class CategoryController
{
    public function actionIndex($page = 1)
    {

        $categories = Category::getCategoriesList();
        $categories = Category::createTree($categories, 0);

      //  $latestProducts = Article::getLatestProducts();
        $productsList = Article::getProductsList();
        $total = Article::getTotalProducts();
        $pagination = new Pagination($total, $page, Category::SHOW_BY_DEFAULT, 'page-');

        require_once(ROOT.'/views/catalog/index.php');
        return true;
    }

    public function actionCategory($categoryId, $categoryId2 = 0, $page = 1)
    {
        $categories = [];
        $categories = Category::getCategoriesList();

        $categoryProducts = [];
        $categoryProducts = Article::getProductsListByCategory($categoryId, $page);

        $total = Article::getTotalProductsInCategory($categoryId);
        $pagination = new Pagination($total, $page, Article::SHOW_BY_DEFAULT, 'page-');

        require_once(ROOT.'/views/catalog/category.php');
        return true;
    }
}