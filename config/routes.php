<?php

Config::set('routes', array(
    'article/([0-9]+)' => 'article/view/$1',
    'catalog/page-([0-9]+)' => 'catalog/index/$1',


    'category/([0-9]+)/page-([0-9]+)' => 'category/category/$1/$2',
    'category/([0-9]+)' => 'category/category/$1',
    'category/([0-9]+)/([0-9]+)' => 'category/category/$1/$2',
    'category/analytic' => 'category/analytic',


    'user/login' => 'user/login',
    'user/register' => 'user/register',
    'user/exit' => 'user/exit',

    'user/([0-9]+)/page-([0-9]+)' => 'user/commentators/$1/$2',
    'user/([0-9]+)' => 'user/commentators/$1',

    'admin/article/create' => 'adminArticle/create',
    'admin/article/update/([0-9]+)' => 'adminArticle/update/$1',
    'admin/article/delete/([0-9]+)' => 'adminArticle/delete/$1',
    'admin/article' => 'adminArticle/index',

    'admin/category/create' => 'adminCategory/create',
    'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
    'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
    'admin/category' => 'adminCategory/index',

    'admin/comment/create' => 'adminComment/create',
    'admin/comment/update/([0-9]+)' => 'adminComment/update/$1',
    'admin/comment/delete/([0-9]+)' => 'adminComment/delete/$1',
    'admin/comment/view/([0-9]+)' => 'adminComment/view/$1',
    'admin/comment' => 'adminComment/index',

    'admin' => 'admin/index',
    'category/page-([0-9]+)' => 'category/index/$1',
    'category' => 'category/index',
    'cabinet' => 'cabinet/index',



    'contact' => 'site/contact',
    '' => 'site/index',
));


Config::set('db.host', 'localhost');
Config::set('db.user', 'root');
Config::set('db.password', '');
Config::set('db.db_name', 'newssite');

