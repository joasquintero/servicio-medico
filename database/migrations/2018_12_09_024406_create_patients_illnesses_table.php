<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsIllnessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnosis', function (Blueprint $table) {
            $table->unsignedInteger('consultation_id');
            $table->unsignedInteger('illness_id');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('consultation_id')->references('id')->on('consultations')->onDelete('cascade');
            $table->foreign('illness_id')->references('id')->on('illnesses')->onDelete('cascade');
            $table->primary(['consultation_id','illness_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // $table->dropForeign('consultation_illnesses_consultation_id_foreign');
        // $table->dropForeign('consultation_illnesses_illness_id_foreign');
        Schema::dropIfExists('diagnosis');
    }
}
