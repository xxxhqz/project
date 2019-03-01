<?php
return [
    '' => 'site/index',
    'login' => 'site/login',
    'contact' => 'site/contact',
    'about' => 'site/about',

    //this is using SQL -phpmyadmin
    'country' => 'country/index', //list of country

    'users' => 'users/index',

    'posts' => 'posts/index',
    'posts/view/<id:\d+>' => 'posts/view',
    'posts/create' => 'posts/create',
    'posts/update/<id:\d+>' => 'posts/update',
    'posts/delete/<id:\d+>' => 'posts/delete',

    //mongodb
    'member' => 'member/dashboard',
    'member/list' => 'member/list',
    'member/create' => 'member/create',
    'member/view' => 'member/view',
    'member/update' => 'member/update',
    'member/delete' => 'member/delete',
    'member/test-db' => 'member/test-db'

];