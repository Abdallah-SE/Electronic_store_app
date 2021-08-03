<?php
return[
    'template'          =>[
        'wrapper_start'      => TEMPLATE_PATH .  'wrapperstart.php',
        'header'             => TEMPLATE_PATH .  'header.php',
        'nav'                => TEMPLATE_PATH .  'nav.php',
        ':view'              => TEMPLATE_PATH .  ':view_action',        
        'wrapper_end'        => TEMPLATE_PATH .  'wrapperend.php'      
    ],
    'header_resources'  =>[
        'css' =>[
            'fawsome'            => CSS. 'fawsome.min.css',
            'googleicons'        => CSS. 'googleicons.css',
            'normalize'          => CSS. 'normalize.css',
            'main'              => CSS . 'main' . $_SESSION['lang'] . '.css',
            'datatables'        => CSS . 'datatables.css'
            ],
        'js'=>[
            'modernizr'          => JS . 'vendor/modernizr-2.8.3.min.js'
        ]
    ],  
    'footer_resources'  =>[
            'jq'            => JS. 'jquery-3.2.1.min.js',
            'helper'            => JS. 'helper.js',
            'datatables'            => JS . 'datatables.js',
            'main'              => JS. 'main.js'
     ]
    
];

