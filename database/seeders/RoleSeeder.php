<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->role();
    }

    public function role()
    {
        DB::table('roles')->insert([

            [
                'id' => 1,
                'name' => 'admin',
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'id' => 2,
                'name' => 'visitor',
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            ],
        ]);
    }
}
