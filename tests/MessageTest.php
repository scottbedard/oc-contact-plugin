<?php namespace Bedard\Contact\Tests;

use Exception;
use PluginTestCase;
use Bedard\Contact\Models\Message;

class MessageTest extends PluginTestCase
{
    public function test_messages_can_mark_themselves_as_read()
    {
        $message = Message::create([
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'body' => 'Hello!',
        ]);

        $this->assertNull($message->read_at);
        $message->markAsRead();
        $this->assertNotNull($message->read_at);
    }
}
