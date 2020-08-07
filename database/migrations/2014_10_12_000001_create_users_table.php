<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('names');
            $table->string('family_names');
            $table->string('gender')->nullable();
            $table->string('major')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->boolean('worker')->default(false);
            $table->string('mention')->nullable();
            $table->string('birthplace')->nullable();
            $table->string('workdays')->nullable();
            $table->date('birthdate')->nullable();
            $table->time('entry_time')->nullable();
            $table->time('exit_time')->nullable();
            $table->integer('age')->nullable();
            $table->string('id_number', 12)->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->boolean('available')->default(false);
            $table->integer('id_creator')->nullable();
            $table->rememberToken();
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
        // $table->dropForeign('users_rol_id_foreign');
        Schema::dropIfExists('users');
    }
}
