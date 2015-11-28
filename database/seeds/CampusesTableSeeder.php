<?php

use Illuminate\Database\Seeder;

class CampusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campuses')->insert([
            'id' => 1,
            'name' => "CEEAC",
            'address' => 'Calle 60 # 313 por 29 y 31 Col. Alcala Martin C.P. 97050',
            'num_agreement' => '',
            'date_text' => ''
        ]);

        DB::table('campuses')->insert([
            'id' => 2,
            'name' => "INSTITUTO CEEAC",
            'address' => 'Calle 18 # 202-A por 21 y 23 Col. García Gineres. C.P. 97070',
            'num_agreement' => '',
            'date_text' => ''
        ]);
    }
}
