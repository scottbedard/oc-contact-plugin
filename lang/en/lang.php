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
        'mark_as_read' => 'Mark as read',
        'mark_as_read_success' => 'Messages successfully marked as read.',
        'model' => 'Message',
        'read' => 'Read :date',
        'sent_at' => 'Date Sent',
        'status' => 'Status',
        'unread' => 'Not read',
    ],

    //
    // Settings
    //
    'settings' => [
        'controller' => 'Settings',
        'description' => 'Manage contact settings',
        'send_email' => 'Send to email address',
        'send_name' => 'Sender name',
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
