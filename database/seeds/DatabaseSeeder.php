<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(PlanTableSeeder::class);
        $this->call(ModulesTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(CampusesTableSeeder::class);

        Model::reguard();
    }
}
