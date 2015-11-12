<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('subjects');
    }
}
