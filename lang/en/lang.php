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
        'email' => 'Email Address',
        'from' => 'From',
        'model' => 'Message',
        'read' => 'Read :date',
        'sent_at' => 'Date Sent',
        'status' => 'Status',
        'unread' => 'Not read',
    ],

    //
    // Subjects
    //
    'subjects' => [
        'controller' => 'Subjects',
        'model' => 'Subject',
        'order' => 'Order',
        'reorder' => [
            'list_header_button' => 'Re-order subjects',
            'popup_header' => 'Re-order subjects',
            'empty_message' => 'There are no subjects to reorder.',
            'success_message' => 'Subjects successfully reordered!',
        ],
    ],
];
