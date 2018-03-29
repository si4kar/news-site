<?php


class CategoryController
{
    public function actionIndex($page = 1)
    {

        $categories = Category::getCategoriesList();

        $articleList = Article::getArticleListPagination($page);
        $total = Article::getTotalArticles();
        $pagination = new Pagination($total, $page, Category::SHOW_BY_DEFAULT, 'page-');

        require_once(ROOT.'/views/catalog/index.php');
        return true;
    }

    public function actionCategory($categoryId, $page = 1)
    {
        $categories = Category::getCategoriesList();
        $category = Category::getCategoryById($categoryId);

        $articleList = Article::getArticleListByCategory($categoryId, $page);

        $total = Article::getTotalArticlesInCategory($categoryId);
        $pagination = new Pagination($total, $page, Article::SHOW_BY_DEFAULT, 'page-');

        require_once(ROOT.'/views/catalog/category.php');
        return true;
    }
}