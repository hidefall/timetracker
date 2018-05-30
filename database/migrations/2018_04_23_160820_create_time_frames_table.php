<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeFramesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_frames', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('task_id')->nullable();
            $table->string('description')->nullable();
            $table->string('timer_started');
            $table->string('timer_finished')->nullable();
            $table->tinyInteger('billable')->default(0);
            $table->double('price_per_hour')->nullable();
            $table->timestamps();
        });

        Schema::create('tag_time_frame', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('time_frame_id');
            $table->integer('tag_id');
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
        Schema::dropIfExists('time_frames');
    }
}
