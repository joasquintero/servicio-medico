<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->date('date');
            $table->time('hour');
            $table->integer('patient_id')->unsigned();
            $table->integer('doctor_id')->unsigned()->nullable();
            $table->boolean('to_consultation')->default(false);
            $table->integer('id_creator')->nullable();
            $table->boolean('available')->default(true);
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // $table->dropForeign('meetings_patient_id_foreign');
        // $table->dropForeign('meetings_doctor_id_foreign');
        Schema::dropIfExists('meetings');
    }
}
