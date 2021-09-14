<?php
// cấu hình menu - sidebar view admin
return [
    ['href' => 'admin.site.index', 'font' => 'fas fa-fw fa-tachometer-alt', 'name' => 'Dashboard'],
    [
        'href' => '#',
        'font' => 'fas fa-tag',
        'name' => 'Catalog',
        'sub-menu' => [
            [
                'href' => 'admin.product.index',
                'name' => 'Products'
            ],
            [
                'href' => 'admin.category.index',
                'name' => 'Categories'
            ],
        ]
    ],
    [
        'href' => '#',
        'font' => 'fas fa-desktop',
        'name' => 'Design',
        'sub-menu' => [
            [
                'href' => 'admin.banner.index',
                'name' => 'Banner'
            ],
        ]
    ],
    [
        'href' => '#',
        'font' => 'fas fa-shopping-cart',
        'name' => 'Sales',
        'sub-menu' => [
            [
                'href' => 'admin.site.index',
                'name' => 'Orders'
            ],
        ]
    ],
    [
        'href' => '#',
        'font' => 'fas fa-user',
        'name' => 'Customers',
        'sub-menu' => [
            [
                'href' => 'admin.customer.index',
                'name' => 'Customers'
            ],
        ]
    ],
    [
        'href' => '#',
        'font' => 'fas fa-users-cog',
        'name' => 'Users',
        'sub-menu' => [
            [
                'href' => 'admin.user.index',
                'name' => 'Users'
            ],
        ]
    ],
];
