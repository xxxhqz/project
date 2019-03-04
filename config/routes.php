<?php
return [
    //'' => 'site/index',
    'login' => 'site/login',
    'site/contact' => 'site/contact',
    // 'about' => 'site/about',

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

     'admin' => 'admin/dashboard',
    // 'admin/list' => 'admin/list',
    // 'admin/create' => 'admin/create',
    // 'admin/view' => 'admin/view',
    // 'admin/update' => 'admin/update',
    // 'admin/delete' => 'admin/delete',

    // //ticket - contact
    'admin/ticket_list' => 'admin/ticket-list',
    // 'admin/ticket_create' => 'admin/ticket-create',
    // 'admin/ticket_view' => 'admin/ticket-view',
    // 'admin/ticket_update' => 'admin/ticket-update',
    // 'admin/ticket_delete' => 'admin/ticket-delete',

    // member
    'admin/member_list' => 'admin/member-list',
    'admin/member_create' => 'admin/member-create',
    'admin/member_view' => 'admin/member-view',
    'admin/member_update' => 'admin/member-update',
    'admin/member_delete' => 'admin/member-delete',

    '' => 'page/index',
    'about' => 'page/about',
    'contact' => 'page/contact',
    'register' => 'page/register'
];