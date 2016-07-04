<?php namespace Bedard\Contact\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Bedard\Contact\Models\Message;
use Carbon\Carbon;
use Flash;
use Lang;

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

    /**
     * Mark the selected messages as read
     *
     * @return void|array
     */
    public function index_onMarkAsRead()
    {
        $checkedIds = post('checked');
        if (!$checkedIds || !is_array($checkedIds) || count($checkedIds) === 0) {
            return;
        }

        $now = Carbon::now();
        foreach ($checkedIds as $id) {
            $message = Message::find($id);
            if ($message->read_at === null) {
                $message->read_at = $now;
                $message->save();
            }
        }

        Flash::success(Lang::get('bedard.contact::lang.messages.mark_as_read_success'));
        return $this->listRefresh();
    }
}
