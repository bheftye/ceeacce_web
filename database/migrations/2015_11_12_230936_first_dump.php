<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FirstDump extends Migration
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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->rememberToken();
            $table->timestamps();

            $table->softDeletes();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
            $table->softDeletes();
        });

        Schema::create('campuses', function (Blueprint $table) {
            $table->increments('id');
        });

        Schema::table('campuses', function (Blueprint $table) {
            $table->string('name');
            $table->string('address');
            $table->string('num_agreement');
            $table->string('date_text');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
        });

        Schema::table('plans', function (Blueprint $table) {
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
        });

        Schema::table('modules', function (Blueprint $table) {
            $table->string('name');
            $table->integer('order');
            $table->integer('plan')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('plan')->references('id')->on('plans')->onDelete('restrict');
        });

        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
        });

        Schema::table('subjects', function (Blueprint $table) {
            $table->string('clv')->unique();
            $table->string('name');
            $table->integer('module')->unsigned();
            $table->double('credits');
            $table->integer('length');
            $table->integer('order');
            $table->timestamps();
            $table->softDeletes();
            $table->index('module');
            $table->foreign('module')->references('id')->on('modules')->onDelete('restrict');
        });

        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->string('clv')->unique();
            $table->string('name');
            $table->string('last_name_p');
            $table->string('last_name_m');
            $table->string('curp');
            $table->string('email')->unique();
            $table->date('birthday');
            $table->string('year');
            $table->string('period');
            $table->string('course');
            $table->string('grade');
            $table->string('shift');
            $table->string('group');
            $table->integer('campus')->unsigned();
            $table->integer('plan')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('students', function (Blueprint $table) {
            $table->foreign('campus')->references('id')->on('campuses')->onDelete('restrict');
            $table->foreign('plan')->references('id')->on('plans')->onDelete('restrict');
        });

        Schema::create('grades', function (Blueprint $table) {
            $table->integer('id_subject')->unsigned();
            $table->integer('id_student')->unsigned();
            $table->primary(['id_subject','id_student']);
        });

        Schema::table('grades', function ($table) {

            $table->string('grade');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_subject')->references('id')->on('subjects')->onDelete('restrict');
            $table->foreign('id_student')->references('id')->on('students')->onDelete('restrict');

        });

        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('document_name');
            $table->string('extension');
            $table->timestamps();
            $table->softDeletes();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
