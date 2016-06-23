<?php namespace Bedard\Contact\Models;

use Model;
use Queue;

/**
 * Subject Model
 */
class Subject extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'bedard_contact_subjects';

    /**
     * @var array   Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array   Fillable fields
     */
    protected $fillable = [
        'name'
    ];

    /**
     * @var array Relations
     */
    public $hasMany = [
        'messages' => 'Bedard\Contact\Models\Message',
    ];

    /*
     * @var array   Validation rules
     */
    public $rules = [
        'name' => 'required',
    ];

    /**
     * Set the subject's index before creating
     *
     * @return void
     */
    public function beforeCreate()
    {
        $this->index = self::count() + 1;
    }

    /**
     * Sort the subject query by index
     *
     * @param  \October\Rain\Database\Builder   query
     * @return \October\Rain\Database\Builder
     */
    public function scopeOrdered($query)
    {
        $query->orderBy('index', 'asc');
    }

    /**
     * Reindex the subject models
     *
     * @return void
     */
    public static function reindex()
    {
        $i = 1;
        $subjects = self::ordered()->get();
        foreach ($subjects as $subject) {
            $subject->index = $i;
            $subject->save();
            $i++;
        }
    }

    /**
     * Change the subject index order
     *
     * @param  array    $ids    Ordered array of subject IDs
     * @return void
     */
    public static function reorder($ids)
    {
        $i = 1;
        $subjects = self::ordered()->get();
        foreach ($ids as $id) {
            $subject = $subjects->find($id);
            $subject->index = $i;
            $subject->save();
            $i++;
        }
    }
}
