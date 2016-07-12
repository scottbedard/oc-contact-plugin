<?php namespace Bedard\Contact\Tests;

use Bedard\Contact\Models\Message;
use Carbon\Carbon;
use Exception;
use PluginTestCase;

class MessageTest extends PluginTestCase
{

    public function test_marking_a_message_as_read()
    {
        $foo = Message::create([
            'name' => 'John Doe',
            'email' => 'john@foo.com',
            'body' => 'Hello world',
        ]);

        Message::read($foo->id);
        $bar = Message::find($foo->id);
        $this->assertNotNull($bar->read_at);
    }

    public function test_getting_mail_variables()
    {
        $foo = Message::create([
            'name' => 'John Doe',
            'email' => 'john@foo.com',
            'body' => 'Hello world',
            'subject_text' => 'Foo',
        ]);

        $vars = $foo->getMailVars();
        $this->assertEquals('Foo', $vars['subject']);
        $this->assertEquals('Hello world', $vars['body']);
    }

    public function test_read_at_column_value()
    {
        $foo = Message::create([
            'name' => 'John Doe',
            'email' => 'john@foo.com',
            'body' => 'Hello world',
            'subject_text' => 'Foo',
        ]);


        $this->assertEquals("<i class='icon-minus'></i> <span>bedard.contact::lang.messages.unread</span>", $foo->readAtListColumn);
        $foo->read_at = Carbon::now()->subDays(1);
        $this->assertEquals("<i class='icon-check'></i> <span>bedard.contact::lang.messages.read_at_date</span>", $foo->readAtListColumn);
    }
}
