<?php

return [

    //
    // Plugin
    //
    'plugin' => [
        'name' => 'Contact',
        'description' => 'A simple contact plugin.',
    ],

    //
    // Permissions
    //
    'permissions' => [
        'messages' => 'Read & manage messages',
        'subjects' => 'Manage subjects',
    ],

    //
    // Messages
    //
    'messages' => [
        'controller' => 'Messages',
        'model' => 'Message',
    ],

    //
    // Subjects
    //
    'subjects' => [
        'controller' => 'Subjects',
        'index' => 'Index',
        'model' => 'Subject',
        'reorder' => [
            'list_header_button' => 'Re-order subjects',
            'popup_header' => 'Re-order subjects',
            'empty_message' => 'There are no subjects to reorder.',
            'success_message' => 'Subjects successfully reordered!',
        ],
    ],
];
