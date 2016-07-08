<?php namespace Bedard\Contact\Models;

use Lang;
use Mail;
use Model;
use Bedard\Contact\Models\Settings;

/**
 * Message Model
 */
class Message extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'bedard_contact_messages';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'name',
        'email',
        'body',
        'subject_id',
        'subject_text',
    ];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'subject' => 'Bedard\Contact\Models\Subject',
    ];

    /**
     * @var array Date attributes
     */
    protected $dates = [
        'read_at',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'body' => 'required',
    ];

    protected function getMailVars()
    {
        return [
            'subject' => $this->subjectText,
            'body' => $this->body,
        ];
    }

    public function getReadAtListColumnAttribute()
    {
        $icon = 'icon-minus';
        $read = Lang::get('bedard.contact::lang.messages.unread');

        if ($this->read_at !== null) {
            $icon = 'icon-check';
            $read = Lang::get('bedard.contact::lang.messages.read', ['date' => $this->read_at->diffForHumans() ]);
        }

        return "<i class='{ $icon }'></i> <span>{ $read }</span>";
    }

    /**
     * Send the message
     *
     * @return void
     */
    public function send()
    {
        $vars = $this->getMailVars();
        Mail::send('bedard.contact::mail.message', $vars, function($message) {
            // @todo: Allow subjects to have unique recipients
            $message->to(Settings::get('send_email'), Settings::get('send_name'));
            $message->subject($this->subjectText);
        });
    }
}
