<?php
return [
    'path' => base_path() . '/app/Modules',
    'base_namespace' => 'App\Modules',
    'groupWithoutPrefix' => 'Pub',

    'groupMidleware' => [
        'Admin' => [
            'web' => ['auth'],
            'api' => ['auth:api'],
        ]
    ],

    'modules' => [
        'Admin' => [
            'Orders',
            'Product',
        //    'CategoryProduct',
            'Larder',
            'News',
            'Pages',
            'Role',
            'Menu',
            'Dashboard',
            'User'
        ],

        'Pub' => [
            'Auth',
            'Home',
            'Categories',
            'Products',
            'Orders',
            'Pages',
            'NovaPoshta',
            'UkrPoshta',
        ],
    ]
];
