<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                ['id' => '1',
                'nama' => 'Admin',
                'username' => 'admin',
                'password' => '$2y$12$kCL/6x3/m219sovBkbKRpOlG5RJmOUVBi5mNuGui2MGcWZT2xncay',
                'role' => '0',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
                ]
            ]);
    }
}
