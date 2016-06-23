<?php namespace Bedard\Contact\Api;

use Bedard\Contact\Models\Subject;
use Illuminate\Routing\Controller;

class Subjects extends Controller
{

    /**
     * Fetch and return all subjects
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Subject::ordered()->get(['id', 'name']);
    }
}
