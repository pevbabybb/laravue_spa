<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('image');
            $table->boolean('is_death')->nullable();
            $table->boolean('is_display')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('date_of_death')->nullable();
            $table->boolean('enable_birth_event')->default('0');
            $table->boolean('enable_death_event')->default('0');
            $table->date('death_day')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *a
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
