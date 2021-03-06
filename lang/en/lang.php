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
        'settings' => 'Manage contact settings',
        'subjects' => 'Manage subjects',
    ],

    //
    // Messages
    //
    'messages' => [
        'controller' => 'Messages',
        'email' => 'Email Address',
        'filter_subject' => 'Subjects',
        'filter_unread' => 'Only show unread',
        'from' => 'From',
        'id' => 'ID',
        'mark_as_read' => 'Mark as read',
        'mark_as_read_success' => 'Messages successfully marked as read.',
        'model' => 'Message',
        'read_at_date' => 'Read :date',
        'read_message' => 'Read message',
        'sent_at' => 'Date Sent',
        'sent_timesinse' => 'Sent :timesince',
        'status' => 'Status',
        'unread' => 'Not read',
    ],

    //
    // Overview report widget
    //
    'overview' => [
        'default_title' => 'Unread messages',
        'label' => 'Unread messages',
        'no_unread' => 'There are no unread messages.',
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
