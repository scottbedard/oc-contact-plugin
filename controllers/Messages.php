<?php namespace Bedard\Contact\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Messages Back-end Controller
 */
class Messages extends Controller
{
    public $requiredPermissions = ['bedard.contact.messages'];

    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Owl.Behaviors.ListDelete.Behavior',
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Bedard.Contact', 'contact', 'messages');
    }
}
