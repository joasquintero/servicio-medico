<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('origin')->nullable();
            $table->string('reference')->nullable();
            $table->text('motives');
            $table->text('cih');
            $table->text('phisic_test');
            $table->unsignedInteger('patient_id');
            $table->unsignedInteger('doctor_id');
            $table->unsignedInteger('meeting_id')->nullable();
            $table->date('date');
            $table->boolean('available')->default(true);
            $table->integer('id_creator')->nullable();
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('meeting_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // $table->dropForeign('consultations_patient_id_foreign');
        // $table->dropForeign('consultations_doctor_id_foreign');
        // $table->dropForeign('consultations_meeting_id_foreign');
        Schema::dropIfExists('consultations');
    }
}
