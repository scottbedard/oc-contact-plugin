<?php namespace Bedard\Contact\Controllers;

use Lang;
use Flash;
use BackendMenu;
use Backend\Classes\Controller;
use Bedard\Contact\Models\Subject;
use Bedard\Contact\Widgets\Treesort;

/**
 * Subjects Back-end Controller
 */
class Subjects extends Controller
{
    public $requiredPermissions = ['bedard.contact.subjects'];

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

        $treesort = new Treesort($this);
        $treesort->bindToController();

        BackendMenu::setContext('Bedard.Contact', 'contact', 'subjects');
    }

    /**
     * After deleting subjects, make sure to reindex them
     *
     * @return void
     */
    public function afterListDelete()
    {
        Subject::reindex();
        Flash::success(Lang::get('backend::lang.list.delete_selected_success'));
        $this->listRefresh();
    }
}
