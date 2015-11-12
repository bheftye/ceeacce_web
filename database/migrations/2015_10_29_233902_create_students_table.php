<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('students')) {
            Schema::create('students', function (Blueprint $table) {
                $table->increments('id');
            });
        }


        Schema::table('students', function (Blueprint $table) {
            $$table->string('clv')->unique();
            $table->string('name');
            $table->string('last_name_p');
            $table->string('last_name_m');
            $table->string('curp',18);
            $table->string('email')->unique();
            $table->date('birthdate');
            $table->string('year',4);
            $table->string('period',1);
            $table->string('course',1);
            $table->string('grade',1);
            $table->string('shift',1);
            $table->string('group',1);
            $table->integer('campus')->unsigned();
            $table->integer('plan')->unsigned();
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
        Schema::drop('students');
    }
}
