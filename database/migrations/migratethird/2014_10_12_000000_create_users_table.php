<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('role')->default(2);
            $table->string('thumbnail')->nullable();
            $table->string('gender');
            $table->integer('status')->default(0);
            $table->unsignedBigInteger('campus_id')->nullable();
            $table->unsignedBigInteger('faculty_id')->nullable();
            $table->foreign('campus_id')->references('id')->on('campuses')->nullable();
            $table->foreign('faculty_id')->references('id')->on('faculties')->nullable();
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
        Schema::dropIfExists('users');
    }
}
