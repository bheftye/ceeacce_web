<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('modules');
    }
}
