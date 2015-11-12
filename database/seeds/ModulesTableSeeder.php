<?php

use Illuminate\Database\Seeder;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insert([
            'id' => 1,
            'name' => "MODULO I",
            'order' => 1,
            'plan' => 1,
        ]);

        DB::table('modules')->insert([
            'id' => 2,
            'name' => "MODULO II",
            'order' => 2,
            'plan' => 1,
        ]);

        DB::table('modules')->insert([
            'id' => 3,
            'name' => "MODULO III",
            'order' => 3,
            'plan' => 1,
        ]);

        DB::table('modules')->insert([
            'id' => 4,
            'name' => "MODULO IV",
            'order' => 4,
            'plan' => 1,
        ]);

        DB::table('modules')->insert([
            'id' => 5,
            'name' => "MODULO V",
            'order' => 5,
            'plan' => 1,
        ]);

        DB::table('modules')->insert([
            'id' => 6,
            'name' => "MODULO VI",
            'order' => 6,
            'plan' => 1,
        ]);


    }
}
