<?php
return [
    'dashboard' => [
        'title'=> 'Dashboard',
        'route.active'=> 'dashboard.',
        'icon'=> 'fa fa-shower',
        'route'=>'/dashboard',
    ],
    'categories' => [
        'route.active'=> 'dashboard.categories.*',
        'title'=> 'Categories',
        'icon'=> 'for fa-circle nav-icon',
        'route'=>'/dashboard/categories',
        'badge'=>[
            'class'=> 'warning',
            'label'=>'New'
        ],
    ],




    'orders' => [
        'title'=> 'Orders',
        'route.active'=> 'dashboard.orders.',
        'icon'=> 'fa fa-shopping-basket',
        'route'=>'/dashboard/orders',
    ],

    'profiles' => [
        'title'=> 'Update Profile',
        'route.active' => 'profile.',
        'icon'=> 'fa fa-user',
        'route'=>'/profile',
    ],

    'Change Password' => [
        'title'=> 'Change Password',
        'route.active' => 'change-password.',
        'icon'=> 'fa fa-key',
        'route'=>'/change-password',
    ],






    'products' => [
        'title'=> ' Product',
        'route.active'=> 'dashboard.products.*',
        'icon'=> 'fa fa-podcast',
        'route'=>'/dashboard/products',
        'badge'=>[
            'class'=> 'info',
            'label'=>'main'
        ],
    ],
];
