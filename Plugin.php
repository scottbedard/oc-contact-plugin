<?php namespace Bedard\Contact;

use Lang;
use Backend;
use System\Classes\PluginBase;

/**
 * Contact Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'          => 'bedard.contact::lang.plugin.name',
            'description'   => 'bedard.contact::lang.plugin.description',
            'author'        => 'Scott Bedard',
            'icon'          => 'icon-envelope-o'
        ];
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'bedard.contact.messages' => [
                'tab'   => 'bedard.contact::lang.plugin.name',
                'label' => 'bedard.contact::lang.permissions.messages'
            ],
            'bedard.contact.subjects' => [
                'tab'   => 'bedard.contact::lang.plugin.name',
                'label' => 'bedard.contact::lang.permissions.subjects',
            ],
            'bedard.contact.settings' => [
                'tab'   => 'bedard.contact::lang.plugin.name',
                'label' => 'bedard.contact::lang.permissions.settings',
            ],
        ];
    }

    /**
     * Register mail templates
     *
     * @return array
     */
    public function registerMailTemplates()
    {
        return [
            'bedard.contact::mail.message' => 'Send a message',
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'contact' => [
                'label'         => 'Contact',
                'url'           => Backend::url('bedard/contact/messages'),
                'icon'          => 'icon-envelope-o',
                'permissions'   => ['bedard.contact.*'],
                'order'         => 600,
                'sideMenu' => [
                    'messages' => [
                        'label'         => 'bedard.contact::lang.messages.controller',
                        'icon'          => 'icon-envelope-o',
                        'url'           => Backend::url('bedard/contact/messages'),
                        'permissions'   => ['bedard.contact.messages'],
                    ],
                    'subjects' => [
                        'label'         => 'bedard.contact::lang.subjects.controller',
                        'icon'          => 'icon-folder-o',
                        'url'           => Backend::url('bedard/contact/subjects'),
                        'permissions'   => ['bedard.contact.subjects'],
                    ],
                    'settings' => [
                        'label'         => 'bedard.contact::lang.settings.controller',
                        'icon'          => 'icon-cog',
                        'url'           => Backend::url('system/settings/update/bedard/contact/settings'),
                        'permissions'   => ['bedard.contact.settings'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Register report widgets
     *
     * @return array
     */
    public function registerReportWidgets()
    {
        return [
            'Bedard\Contact\ReportWidgets\Overview' => [
                'label'     => 'bedard.contact::lang.overview.label',
                'context'   => 'dashboard'
            ],
        ];
    }

    /**
     * Register settings pages
     *
     * @return  array
     */
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'         => 'bedard.contact::lang.settings.controller',
                'description'   => 'bedard.contact::lang.settings.description',
                'category'      => 'bedard.contact::lang.plugin.name',
                'class'         => 'Bedard\Contact\Models\Settings',
                'permissions'   => ['bedard.contact.settings'],
                'icon'          => 'icon-cog',
                'order'         => 100,
            ],
        ];
    }
}
