<?php

return [
    'url'              => [
        'prefix_admin'    => 'admin123',
        'prefix_news'     => 'news69',
        'prefix_default'  => '',
    ],
    'format'           => [
        'long_time'    => 'H:m:s d/m/Y',
        'short_time'   => 'd/m/Y',
    ],
    'template'         => [
        'form_input' => [
            'class' => 'form-control col-md-6 col-xs-12'
        ],
        'form_input_readonly' => [
            'class' => 'form-control col-md-6 col-xs-12' ,
            'readonly'=>'readonly',
        ],
        'form_input_tagify' => [
            'class' => 'form-control col-md-6 col-xs-12 tag_name'
        ],
        'form_label' => [
            'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
        ],
        'form_label_edit' => [
            'class' => 'control-label col-md-4 col-sm-3 col-xs-12'
        ],

        'form_ckeditor' => [
            'class' => 'form-control col-md-6 col-xs-12 ckeditor'
        ],
        'form_textarea_readonly' => [
            'class' => 'form-control col-md-6 col-xs-12',
            'readonly'=>'readonly',
        ],
        'status'       => [
            'all'      => ['name' => 'Tất cả', 'class' => 'btn-success'],
            'active'   => ['name' => 'Kích hoạt', 'class'      => 'btn-success'],
            'unread'   => ['name' => 'Chưa đọc', 'class'      => 'btn-success'],  
            'inactive' => ['name' => 'Chưa kích hoạt', 'class' => 'btn-info'],
            'block'    => ['name' => 'Bị khóa', 'class' => 'btn-danger'],
            'replied'  => ['name' => 'Đã phản hồi', 'class' => 'btn-danger'],
            'default'  => ['name' => 'Chưa xác định', 'class' => 'btn-success'],
            'pending'          => ['name' => 'Chờ xác nhận',       'class'      => 'btn-danger'],
            'shipping'         => ['name' => 'Đang giao hàng',       'class'      => 'btn-info'],
            'delivered'        => ['name' => 'Đã giao hàng',       'class'      => 'btn-success'],
            'received payment' => ['name' => 'Đã thanh toán',  'class'      => 'btn-primary'],
            'return'           => ['name' => 'Đã chuyển hoàn', 'class'      => 'btn-light'],
        ],
        'is_home'       => [
            'yes'      =>  ['name' => 'Hiển thị', 'class' => 'btn-primary'],
            'no'        => ['name' => 'Không hiển thị', 'class' => 'btn-warning']
        ],
        'display'       => [
            'list'      => ['name' => 'Danh sách'],
            'grid'      => ['name' => 'Lưới'],
        ],
        'type' => [
            'featured'   => ['name' => 'Nổi bật'],
            'normal'     => ['name' => 'Bình thường'],
        ],
        'type_menu' => [
            'link'                 => ['name' => 'link'],
            'categories'           => ['name' => 'Danh mục bài viết'],
            'category_product'     => ['name' => 'Danh mục sản phẩm'],
        ],
        'type_open' => [
            '_self'             => ['name' => 'Liên kết nội bộ'],
            '_blank'             => ['name' => 'Liên kết ngoài'],


        ],
        'rss_source' => [
            'vnexpress'   => ['name' => 'VNExpress'],
            'tuoitre'     => ['name' => 'Tuổi Trẻ'],
        ],
        'level'       => [
            'admin'      => ['name' => 'Quản trị hệ thống'],
            'member'      => ['name' => 'Người dùng bình thường'],
        ],
        'search'       => [
            'all'           => ['name' => 'Search by All'],
            'id'            => ['name' => 'Search by ID'],
            'name'          => ['name' => 'Search by Name'],
            'username'      => ['name' => 'Search by Username'],
            'fullname'      => ['name' => 'Search by Fullname'],
            'email'         => ['name' => 'Search by Email'],
            'description'   => ['name' => 'Search by Description'],
            'link'          => ['name' => 'Search by Link'],
            'content'       => ['name' => 'Search by Content'],

        ],
        'button' => [
            'edit'      => ['class' => 'btn-success', 'title' => 'Edit', 'icon' => 'fa-pencil', 'route-name' => '/form'],
            'delete'    => ['class' => 'btn-danger btn-delete', 'title' => 'Delete', 'icon' => 'fa-trash', 'route-name' => '/delete'],
            'info'      => ['class' => 'btn-info', 'title' => 'View', 'icon' => 'fa-pencil', 'route-name' => '/delete'],
        ]

    ],
    'config' => [
        'search' => [
            'default'   => ['all', 'id', 'fullname'],
            'banner'    => ['all', 'id', 'name', 'description', 'link'],
            'product'    => ['all', 'id', 'name', 'description', 'link'],
            'category'  => ['all', 'name'],
            'menu'      => ['all', 'name'],
            'article'   => ['all', 'name', 'content'],
            'rss'       => ['all', 'name', 'link'],
            'user'      => ['all', 'username', 'email', 'fullname'],
        ],
        'button' => [
            'default'   => ['edit', 'delete'],
            'message'   => ['edit', 'delete'],
            'order'    => ['edit', 'delete'],
            'banner'    => ['edit', 'delete'],
            'articleCategory'  => ['edit', 'delete'],
            'productCategory'  => ['edit', 'delete'],
            'product'  => ['edit', 'delete'],
            'attribute'  => ['edit', 'delete'],
            'attributeProduct'  => ['edit', 'delete'],
            'menu'      => ['edit', 'delete'],
            'article'   => ['edit', 'delete'],
            'rss'   => ['edit', 'delete'],
            'user'      => ['edit'],
        ],
        'area'          =>  [
            ''                        =>  '-- Option --',
            'stock_location=VN039'    =>  'TP.HCM',
            'stock_location=VN034'    =>  'Hà Nội',
            'stock_location=VN037'    =>  'Hải Phòng',
            'stock_location=VN025'    =>  'Đà Nẵng',
            'stock_location=VN023'    =>  'Cần Thơ',
        ],
        'service'          =>  [
            ''                                  =>  '-- Option --',
            'support_p2h_delivery=1'            =>         'TikiNow',
            'freeship_campaign=freeship_plus'   =>  'FreeShip+',
            'support_installment=1'             =>  'Trả góp 0%',
        ],
    ]

];
