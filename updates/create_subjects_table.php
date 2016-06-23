<?php namespace Bedard\Contact\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateSubjectsTable extends Migration
{

    public function up()
    {
        Schema::create('bedard_contact_subjects', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('index')->unsigned();
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bedard_contact_subjects');
    }

}
