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
        DB::table('users')->insert([
            'username' => 'admin+1',
            'email' => 'admin+1@gmail.com',
            'password' => password_hash('123123123', PASSWORD_DEFAULT),
            'role' => '2'
        ]);
    }
}