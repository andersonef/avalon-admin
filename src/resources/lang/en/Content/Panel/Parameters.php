<?php
return [
    'name'      => 'Website Parameters',
    'btnNew'    => '+ Parameter',
    'index'     => [
        'title'     => '.:: Parameter Management | '.config('avalon-admin.appName').' ::.',
        'lblUsage'  => '<b>Usage: </b>{!! Avalon\Parameter::find(\':id\') !!}',
        'info'      => 'You can use parameters as small text snippets to make your website more customizable and let your customer alter basic info like address, phone number, email address and much more!',
        'btnAll'    => 'All Parameters',
        'lblDescription' => 'Description: '
    ],
    'create'    => [
        'name'          => 'New Parameter',
        'title'         => '.:: New Parameter | '.config('avalon-admin.appName').' ::.',
        'lblName'       => 'Parameter Name',
        'lblDescription'    => 'Parameter Description',
        'lblContent'    => 'Parameter Value',
        'lblCategory'   => 'Choose a category',
    ],


];