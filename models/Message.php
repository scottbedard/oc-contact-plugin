<?php namespace Bedard\Contact\Models;

use Model;

/**
 * Message Model
 */
class Message extends Model
{

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
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'subject' => 'Bedard\Contact\Models\Subject',
    ];
}
