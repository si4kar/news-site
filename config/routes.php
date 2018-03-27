<?php

Config::set('routes', array(
    'product/([0-9]+)' => 'product/view/$1',

    'catalog/page-([0-9]+)' => 'catalog/index/$1',
    'category' => 'category/index',

    'category/([0-9]+)/page-([0-9]+)' => 'category/category/$1/$2',
    'category/([0-9]+)' => 'category/category/$1',
    'category/([0-9]+)/([0-9]+)' => 'category/category/$1/$2',

    'cart/add/([0-9]+)' => 'cart/add/$1',
    'cart/delete/([0-9]+)' => 'cart/delete/$1',
    'cart/checkout' => 'cart/checkout',
    'cart' => 'cart/index',

    'user/login' => 'user/login',
    'user/register' => 'user/register',
    'user/exit' => 'user/exit',

    'admin/product/create' => 'adminProduct/create',
    'admin/product/update/([0-9]+)' => 'adminProduct/update/$1',
    'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
    'admin/product' => 'adminProduct/index',

    'admin/category/create' => 'adminCategory/create',
    'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
    'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
    'admin/category' => 'adminCategory/index',

    'admin/order/update/([0-9]+)' => 'adminOrder/update/$1',
    'admin/order/delete/([0-9]+)' => 'adminOrder/delete/$1',
    'admin/order/view/([0-9]+)' => 'adminOrder/view/$1',
    'admin/order' => 'adminOrder/index',

    'admin' => 'admin/index',

    'cabinet' => 'cabinet/index',

    'contact' => 'site/contact',
    '' => 'site/index',
));


Config::set('db.host', 'localhost');
Config::set('db.user', 'admin');
Config::set('db.password', 'bydapesht');
Config::set('db.db_name', 'newssite');

