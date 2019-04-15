<?php

namespace Cleanse\WorldCup\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AddTeamPlayersTables extends Migration
{
    public function up()
    {
        Schema::create('cleanse_cup_teams', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('region');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('cleanse_cup_players', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('team_id');
            $table->string('name');
            $table->string('server');
            $table->integer('rank');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cleanse_cup_players');
        Schema::dropIfExists('cleanse_cup_teams');
    }
}
