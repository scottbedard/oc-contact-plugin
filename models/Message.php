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
    use \Bedard\Contact\Traits\Subqueryable,
        \October\Rain\Database\Traits\Validation;

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
        'message',
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
        'message' => 'required',
    ];

    public function afterCreate()
    {
        // @todo... grab mail template and send it
        // Mail::send('acme.blog::mail.message', $vars, function($message) {
        //     $message->to(Settings::get('send_email'), Settings::get('send_name'));
        //     $message->subject($this->subjectText);
        // });
    }

    public function getReadAtListColumnAttribute()
    {
        $icon = $this->read_at === null
            ? 'icon-minus'
            : 'icon-check';

        $string = $this->read_at === null
            ? Lang::get('bedard.contact::lang.messages.unread')
            : Lang::get('bedard.contact::lang.messages.read', ['date' => $this->read_at->diffForHumans() ]);

        return "<i class='{$icon}'></i> <span>{$string}</span>";
    }
}
