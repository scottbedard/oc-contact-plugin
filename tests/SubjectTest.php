<?php namespace Bedard\Contact\Tests;

use Exception;
use PluginTestCase;
use Bedard\Contact\Models\Subject;

class MessageTest extends PluginTestCase
{
    public function test_subjects_increment_their_index_when_created()
    {
        $foo = Subject::create(['name' => 'foo']);
        $bar = Subject::create(['name' => 'bar']);
        $this->assertEquals(1, $foo->index);
        $this->assertEquals(2, $bar->index);
    }

    public function test_subjects_can_reindex_themselves()
    {
        $foo = Subject::create([ 'name' => 'foo' ]);
        $bar = Subject::create([ 'name' => 'bar' ]);
        $foo->index = 4;
        $bar->index = 11;
        $foo->save();
        $bar->save();

        Subject::reindex();

        $this->assertEquals(1, $foo->fresh()->index);
        $this->assertEquals(2, $bar->fresh()->index);
    }

    public function test_subjects_can_be_reordered()
    {
        $foo = Subject::create([ 'name' => 'foo' ]);
        $bar = Subject::create([ 'name' => 'bar' ]);
        $baz = Subject::create([ 'name' => 'baz' ]);

        Subject::reorder([ $baz->id, $foo->id, $bar->id ]);

        $this->assertEquals(1, $baz->fresh()->index);
        $this->assertEquals(2, $foo->fresh()->index);
        $this->assertEquals(3, $bar->fresh()->index);
    }
}
