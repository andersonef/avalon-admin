<?php
return [
    'name'      => 'Content Categories',
    'btnNew'    => '+ Category',
    'index'     => [
        'title'     => '.:: Category Management | '.config('avalon-admin.appName').' ::.',
        'lblUsage'  => '<b>Usage: </b>{!! Avalon\Category::find(\':id\') !!}',
        'info'      => 'You can organize all your content into categories. This will make easy to create sessions inside your website. All kind of content can have a category.'
    ],
    'create'    => [
        'name'          => 'New Category',
        'title'         => '.:: New Category | '.config('avalon-admin.appName').' ::.',
        'lblName'       => 'Category Name',
        'lblDescription'    => 'Category Description',
        'lblInternal'       => 'Is this an internal category?',
    ],


];