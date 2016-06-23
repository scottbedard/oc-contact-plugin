<?php namespace Bedard\Contact\Widgets;

use Lang;
use Flash;
use Exception;
use AjaxException;
use Backend\Classes\WidgetBase;
use Bedard\Contact\Models\Subject;

class Treesort extends WidgetBase
{
    /**
     * @var string  Default alias
     */
    protected $defaultAlias = 'treesort';

    /**
     * Returns information about this widget
     *
     * @return array
     */
    public function widgetDetails()
    {
        return [
            'name'          => 'Treesort',
            'description'   => 'Controller list sorting.'
        ];
    }

    /**
     * Inject CSS and JS assets
     *
     * @return void
     */
    public function loadAssets()
    {
        $this->addJs('compiled/treesort.min.js');
        $this->addCss('compiled/treesort.min.css');
    }

    /**
     * Display the popup
     *
     * @return mixed
     */
    public function onShowPopup()
    {
        $subjects = Subject::ordered()->get();

        return $this->makePartial('popup', [
            'subjects' => $subjects,
        ]);
    }

    /**
     * Update the category tree
     *
     * @throws \AjaxException
     * @return array
     */
    public function onUpdateTree()
    {
        $subjects = input('subjects');
        Subject::reorder($subjects);
        Flash::success(Lang::get('bedard.contact::lang.subjects.reorder.success_message'));
        return $this->controller->listRefresh();
    }
}
