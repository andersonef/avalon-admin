<?php
return [
    'Role'          => [
        'superadmin'    => [
            'name'          => 'Super Administrator',
            'description'   => 'Can do anything! (ideal for the developer)'
        ],
        'admin'         => [
            'name'          => 'Admin',
            'description'   => 'Can do anything, except alter developer parameters and something which can break the app. (ideal for the product owner)'
        ],
        'editor'        => [
            'name'          => 'Editor',
            'description'   => 'Can create and edit things created by himself or the other users'
        ],
        'author'        => [
            'name'          => 'Author',
            'description'   => 'Can create and edit his own things'
        ],
        'readonly'      => [
            'name'          => 'Visitor',
            'description'   => 'Can only see things other users have been created!'
        ]
    ],
    'ContentType'   => [
        'page'          => [
            'name'          => 'Page',
            'description'   => 'Page containing html text, a title and a banner image'
        ],
        'gallery'       => [
            'name'          => 'Photo Gallery',
            'description'   => 'A gallery of photos with a name, description and some photos which have some title and description too',
        ]
    ]
];