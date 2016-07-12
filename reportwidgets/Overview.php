<?php namespace Bedard\Contact\ReportWidgets;

use Backend\Classes\ReportWidgetBase;
use Bedard\Contact\Models\Message;
use Exception;
use Lang;

class Overview extends ReportWidgetBase
{

    /**
     * Define widget properties
     *
     * @return array
     */
    public function defineProperties()
    {
        return [
            'title' => [
                'title'             => 'backend::lang.dashboard.widget_title_label',
                'default'           => Lang::get('bedard.contact::lang.overview.default_title'),
                'type'              => 'string',
                'validationPattern' => '^.+$',
                'validationMessage' => 'backend::lang.dashboard.widget_title_error',
            ],
        ];
    }

    /**
     * Load widget data
     *
     * @return void
     */
    protected function loadData()
    {
        $this->vars['messages'] = Message::unread()->newestFirst()->get();
    }

    /**
     * Render the widget
     *
     * @return string
     */
    public function render()
    {
        try {
            $this->loadData();
        }

        catch (Exception $e) {
            $this->vars['error'] = $e->getMessage();
        }

        return $this->makePartial('widget');
    }
}
