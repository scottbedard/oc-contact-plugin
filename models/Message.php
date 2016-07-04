<?php namespace Bedard\Contact\Models;

use Lang;
use Model;

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

    /**
     *
     *
     * @param  \October\Rain\Database\Builder   $query
     * @return \October\Rain\Database\Builder
     */
    public function scopeSelectIsRead($query)
    {
        $grammar = $query->getQuery()->getGrammar();
        $read_at = $grammar->wrap($this->table . '.read_at');
        return $query->selectSubquery("CASE WHEN ({$read_at} IS NULL) THEN 0 ELSE 1 END", 'is_read');
    }
}
