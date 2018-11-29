<?php
use Carbon\Carbon;

// định nghĩa menu khách hàng ở đây
function define_admin_menu()
{
    $menu = [
        'data' => [
            [
                'title' => 'Dashboard',
                'route' => 'admin',
                'icon' => 'mdi-view-dashboard',
                'permission' => ''
            ],
            [
                'title' => 'Quản lý',
                'route' => 'admin',
                'icon' => 'mdi-view-dashboard',
                'permission' => ' ',
                'submenu' => [
                    [
                        'title' => 'danh sách người dùng',
                        'route' => 'admin.manager_user.index',
                        'icon' => 'mdi mdi-book-open',
                        'permission' => '',
                    ],
                    [
                        'title' => 'Danh sách khóa học',
                        'route' => 'admin.course',
                        'icon' => 'mdi mdi-book-open',
                        'permission' => '',
                    ],
                    [
                        'title' => 'Danh mục khóa học',
                        'route' => 'admin.category',
                        'icon' => 'mdi mdi-book-open',
                        'permission' => '',
                    ]
                ]
            ],
            // [
            //     'title' => 'Thiết lập',
            //     'route' => 'admin',
            //     'icon' => 'mdi-view-dashboard',
            //     'permission' => ''
            // ]
        ]
    ];
    return $menu;
}


function convertDate($value)
{
    return \Carbon\Carbon::parse($value)->format('d/m/Y');
}

function foo_status()
{
    return [
        1 => 'kích hoạt',
        2 => 'không kích hoạt'
    ];
}


function foo_show_pg()
{
    return [5, 10, 15, 20];
}


function checkActive($value)
{
    if ($value == 1) {
        return '<span class="status text-success">•</span> Kích hoạt';
    }
    return '<span class="status text-danger">•</span> Không kích hoạt';
}
