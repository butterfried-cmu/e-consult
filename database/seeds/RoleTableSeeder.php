<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'role' => 'ADMIN',
            ],
            [
                'role' => 'DOCTOR',
            ],
            [
                'role' => 'NURSE',
            ],
        ]);
    }
}
