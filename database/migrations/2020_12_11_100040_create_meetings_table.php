<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->date('meeting_date');
            $table->time('s_time',0);
            $table->time('e_time',0);
            $table->integer('room');
            $table->char('title',100);
            $table->text('host');
            $table->text('join');
            $table->string('vc');
            $table->text('name');
            $table->text('pos');
            $table->text('dept');
            $table->string('state')->nullable();
            $table->string('approve')->default('no');
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
        Schema::dropIfExists('meetings');
    }
}
