<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'uid' => "hL41oe6pEqRbSN8Ywg2bcknCL8g2",
            'name' => 'admin',
        ];
        DB::table('users')->insert($param);
        $param = [
            'uid' => "P5shaidukZSf5NWTTj5ye7iQ7Pq1",
            'name' => 'test',
        ];
        DB::table('users')->insert($param);
    }
}
