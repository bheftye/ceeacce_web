<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->integer('id_subject');
            $table->integer('id_student');
            $table->primary(['id_subject','id_student']);
        });

        Schema::table('grades', function (Blueprint $table) {

            $table->string('grade');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_subject')->references('id')->on('subjects')->onDelete('restrict');
            $table->foreign('id_student')->references('id')->on('students')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('grades');
    }
}
