<?php
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

date_default_timezone_set('Asia/Ho_Chi_Minh');
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

function uploadFiles($files, $folder = 'videos/')
{
    if (is_array($files)) {
        foreach ($files as $file) {
            $filename = str_slug($file->getClientOriginalName()) . time() . '.' . $file->getClientOriginalExtension();
            $s3 = \Storage::disk('s3');
            $filePath = '/uploads/' . $folder . $filename;
            $stream = fopen($file->getRealPath(), 'r+');
            $s3->put($filePath, $stream);
            $data_file[] =
            [
                'link'  => $filename,
                'title' => $file->getClientOriginalName(),
                'size'  => $file->getClientSize()
            ];
        }
        return $data_file;
    } else {
        $file = $files;
        $filename = str_slug($file->getClientOriginalName()) . time() . '.' . $file->getClientOriginalExtension();
        $s3 = \Storage::disk('s3');
        $filePath = '/uploads/' . $folder . $filename;
        $stream = fopen($file->getRealPath(), 'r+');
        $s3->put($filePath, $stream);
        $data_file =
            [
                'link'  => $filename,
                'title' => $file->getClientOriginalName(),
                'size'  => $file->getClientSize()
            ];

        return $data_file;
    }
}
