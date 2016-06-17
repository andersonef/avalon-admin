<?php
return [
    'commands'      => [
        'up'        => [
            'description' => 'Install the mini-CMS Avalon Admin on your laravel 5.2 project. After install you will be able to access yourdomain.com/avalon-admin and put some content on your site. For more information access http://github.com/andersonef/avalon-admin',

            'askUserName'               => 'Super Admin Name:',
            'askUserEmail'              => 'Super Admin Email:',
            'askUserPassword'           => 'Super Admin Password:',

            'preparingDatabase'         => 'Installing database...',
            'databaseOk'                => 'Database Installed!',

            'preparingFiles'            => 'Copying asset files to your public directory...',
            'filesOk'                   => 'Asset files successfully copied to :path'
        ],
        'down'      => [
            'description'               => 'Uninstall the mini-CMS Avalon Admin on your laravel 5.2 project. It will remove all database tables and there is no way to go back!',
            'warning'                   => 'WARNING: This will remove all tables and asset files from Avalon Admin Panel. There is no way to get it back!',
            'confirm'                   => 'Do you wish to continue?',

            'preparingDatabase'         => 'Preparing to remove database tables.',
            'databaseOk'                => 'Tables successfully removed!',

            'preparingFiles'            => 'Removing asset files...',
            'filesOk'                   => 'Asset files successfully removed!',
        ]
    ],


    'services'      => [
        'core'          => [
            'user'          => [
                'authError'             => 'Email and password does not match!',
                'invalidCredentials'    => 'Invalid credentials data.',
            ]
        ]
    ]
];