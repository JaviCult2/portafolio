<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->user();
    }

    public function user()
    {
        DB::table('users')->insert([

            [
                'name' => 'Javier',
                'last_name' => 'Sánchez',
                'phone' => '7226507543',
                'email' => 'javi@gmail.com',
                'user' => 'Javi',
                'password' => '123',
                'fk_id_role' => 1,
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Andrea',
                'last_name' => 'Flores',
                'phone' => '7221919313',
                'email' => 'andy@gmail.com',
                'user' => 'Andy',
                'password' => '123',
                'fk_id_role' => 2,
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            ],
        ]);
    }
}
