<?php

return [
    'uploads' => [
        'max_count' => 20,
        'file_size' => 25 * 1024 * 1024, // 25 MBytes
        'file_types' => [
            'zip', 
            'rar', 
            'tar', 
            'gzip', 
            'pdf', 
            'doc', 
            'txt',
            'docx', 
            'bmp', 
            'jpg', 
            'png', 
            'xls', 
            'xlsx', 
            'ppt', 
            'pptx'
        ],
        'image_types' => [
            'bmp', 
            'jpg', 
            'jpeg', 
            'png'
        ],
        'id_verification_types' => [
            'bmp', 
            'jpg', 
            'jpeg', 
            'png', 
            'pdf'
        ]
    ],

];