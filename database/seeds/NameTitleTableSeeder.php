<?php

use Illuminate\Database\Seeder;

class NameTitleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('name_titles')->insert([
            [
                'name_title' => 'Mrs.',
            ],
            [
                'name_title' => 'Mr.',
            ],
            [
                'name_title' => 'Miss',
            ],
            [
                'name_title' => 'Professor',
            ],
            [
                'name_title' => 'Assistant Professor',
            ],
            [
                'name_title' => 'Associate Professor',
            ],
            [
                'name_title' => 'Emeritus Professor',
            ],


        ]);
    }
}
