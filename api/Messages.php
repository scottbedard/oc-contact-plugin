<?php namespace Bedard\Contact\Api;

use Bedard\Contact\Models\Message;
use Bedard\Contact\Models\Subject;
use Illuminate\Routing\Controller;

class Messages extends Controller
{

    /**
     * Store a new message
     *
     * @return \Bedard\Contact\Models\Message
     */
    public function store()
    {
        $data = input();
        $message = new Message($data);

        if (array_key_exists('subject_id', $data)) {
            $subject = Subject::find($data['subject_id']);
            if ($subject) {
                $message->subject_id = $subject->id;
                $message->subject_text = $subject->name;
            }
        }

        $message->save();
        return $message;
    }
}
