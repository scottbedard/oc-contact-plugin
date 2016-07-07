<?php namespace Bedard\Contact\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateMessagesTable extends Migration
{

    public function up()
    {
        Schema::create('bedard_contact_messages', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->integer('subject_id')->unsigned()->nullable();
            $table->string('subject_text');
            $table->text('body');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bedard_contact_messages');
    }

}
