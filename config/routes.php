<?php

Config::set('routes', array(

    'article/([0-9])+/page-([0-9]+)' => 'article/view/$1/$2',
    'article/([0-9]+)' => 'article/view/$1',
    'catalog/page-([0-9]+)' => 'catalog/index/$1',


    'category/([0-9]+)/page-([0-9]+)' => 'category/category/$1/$2',
    'category/([0-9]+)' => 'category/category/$1',
    'category/([0-9]+)/([0-9]+)' => 'category/category/$1/$2',
    'category/analytic/page-([0-9]+)' => 'category/analytic/$1',
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

    'admin/tag/create' => 'adminTag/create',
    'admin/tag/update/([0-9]+)' => 'adminTag/update/$1',
    'admin/tag/delete/([0-9]+)' => 'adminTag/delete/$1',
    'admin/tag' => 'adminTag/index',

    'admin/comment/create' => 'adminComment/create',
    'admin/comment/update/([0-9]+)' => 'adminComment/update/$1',
    'admin/comment/delete/([A-Za-z]+)/([0-9]+)' => 'adminComment/delete/$1/$2',
    'admin/comment/check/([0-9]+)' => 'adminComment/check/$1',
    'admin/comment/view/([0-9]+)' => 'adminComment/view/$1',
    'admin/comment' => 'adminComment/index',

    'admin/advertising/create' => 'adminAdvertising/create',
    'admin/advertising/update/([0-9]+)' => 'adminAdvertising/update/$1',
    'admin/advertising/delete/([0-9]+)' => 'adminAdvertising/delete/$1',
    'admin/advertising' => 'adminAdvertising/index',

    'admin/accept' => 'adminComment/accept',
    'admin/background' => 'admin/background',

    'tag/([0-9]+)' => 'tag/index/$1',
    'autocomplite' => 'autocomplite/index',
    'admin' => 'admin/index',

    'category/page-([0-9]+)' => 'category/index/$1',
    'category' => 'category/index',


    'cabinet/background' => 'cabinet/background',
    'cabinet' => 'cabinet/index',



    'contact' => 'site/contact',
    '' => 'site/index',
));


Config::set('db.host', 'localhost');
Config::set('db.user', 'root');
Config::set('db.password', '');
Config::set('db.db_name', 'newssite');

