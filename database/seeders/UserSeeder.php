<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();

        $data = [[
            'nip' => 1234,
            'name' => 'DONI',
            'position' => 'DIREKTUR',
            'password' => bcrypt('123456'),
        ], [
            'nip' => 1235,
            'name' => 'DONO',
            'position' => 'FINANCE',
            'password' => bcrypt('123456'),
        ], [
            'nip' => 1236,
            'name' => 'DONA',
            'position' => 'STAFF',
            'password' => bcrypt('123456'),
        ]];

        foreach ($data as $key => $value) {
            User::create($value);
        }
    }
}
