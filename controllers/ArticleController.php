<?php

class ArticleController
{
    public function actionView($articleId, $page=1)
    {
        $categories = [];
        $categories = Category::getCategoriesList();
        $comments = Comment::getArticleComments($articleId, $page);
        $total = Comment::getTotalCommentInArticle($articleId);
        $pagination = new Pagination($total, $page, Article::SHOW_BY_DEFAULT, 'page-');
        $tagsId = Tag::getTagsIdByArticleId($articleId);
        $tags = Tag::getTagsByIds($tagsId);
        $article = Article::getArticleById($articleId);

        $categoryName = Category::getCategoryById($article['category_id']);




        if (isset($_POST['submit']) && $_POST['description'] ) {
            $options['description'] = $_POST['description'];
            $options['article_id'] = $_POST['article_id'];
            $options['user_id'] = $_POST['user_id'];
            $options['validation'] = $_POST['validation'];

            $error = false;
            if (empty($options['description'])) {
                $error = true;
                Session::setFlashError("Заполните поля");
            }
            if ($error == false) {
                Comment::createComment($options);

                Router::redirect('/article/' . $articleId);
            }
        }

        if (isset($_POST['down']) || isset($_POST['up'])) {
            $option['id'] = $_POST['comment_id'];
            $option['rating'] = $_POST['rating'];
            if (isset($_POST['down'])) Comment::changeRaiting($option, 'down');
            if (isset($_POST['up'])) Comment::changeRaiting($option, 'up');

            Router::redirect('/article/' . $articleId);
        }


        require_once(ROOT . '/views/article/view.php');
        return true;
    }


}