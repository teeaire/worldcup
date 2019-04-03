<?php

namespace Cleanse\WorldCup\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AddRecruitsTables extends Migration
{
    public function up()
    {
        /**
         * WHERE starttime BETWEEN '11:00' AND '13:30'
         * AND endtime >= '16:00'
         */
        Schema::create('cleanse_cup_recruits', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('region');
            $table->json('roles');
            $table->text('availability');
            $table->text('contact_method');
            $table->boolean('recruited')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cleanse_cup_recruits');
    }
}
