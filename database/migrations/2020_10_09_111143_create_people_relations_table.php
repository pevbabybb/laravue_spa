<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people_relations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user1');
            $table->unsignedInteger('user2');
            $table->foreign('user1')->references('id')->on('tasks');
            $table->foreign('user2')->references('id')->on('tasks');
            $table->dateTime('special_day');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people_relations');
    }
}
