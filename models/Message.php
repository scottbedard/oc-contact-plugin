<?php namespace Bedard\Contact\Models;

use Backend;
use Bedard\Contact\Models\Settings;
use Carbon\Carbon;
use Lang;
use Mail;
use Model;

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

    /**
     * Get a message's backend url
     *
     * @return string
     */
    public function getBackendUrl()
    {
        return Backend::url("bedard/contact/messages/read/{$this->id}");
    }

    public function getMailVars()
    {
        return [
            'subject' => $this->subject_text,
            'body' => $this->body,
        ];
    }

    public function getReadAtListColumnAttribute()
    {
        $icon = 'icon-minus';
        $read = Lang::get('bedard.contact::lang.messages.unread');

        if ($this->read_at !== null) {
            $icon = 'icon-check';
            $read = Lang::get('bedard.contact::lang.messages.read_at_date', ['date' => $this->read_at->diffForHumans() ]);
        }

        return "<i class='$icon'></i> <span>$read</span>";
    }

    /**
     * Update a message's read_at timestamp if it is null
     *
     * @return void
     */
    public function markAsRead()
    {
        if ($this->read_at === null) {
            $this->read_at = Carbon::now();
        }
    }

    /**
     * Fetch a message and mark it as read
     *
     * @param   integer                         $id     The message the find and read
     * @return  \Bedard\Contact\Models\Message
     */
    public static function read($id)
    {
        $message = self::find($id);
        $message->markAsRead();
        $message->save();

        return $message;
    }

    /**
     * Order by newest first
     *
     * @param  \October\Rain\Database\Builder   query
     * @return \October\Rain\Database\Builder
     */
    public function scopeNewestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Select unread messages
     *
     * @param  \October\Rain\Database\Builder   query
     * @return \October\Rain\Database\Builder
     */
    public function scopeUnread($query)
    {
        return $query->where('read_at', null);
    }

    /**
     * Send the message
     *
     * @return void
     */
    public function send()
    {
        // @todo: re-enable mailed
        // $vars = $this->getMailVars();
        // Mail::send('bedard.contact::mail.message', $vars, function($message) {
        //     // @todo: Allow subjects to have unique recipients
        //     $message->to(Settings::get('send_email'), Settings::get('send_name'));
        //     $message->subject($this->subjectText);
        // });
    }
}
