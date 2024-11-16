<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataUserCreate = [
            'admin' => [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ],
            'perlengkapan' => [
                'name' => 'perlengkapan',
                'email' => 'perlengkapan@gmail.com',
                'password' => Hash::make('perlengkapan'),
                'email_verified_at' => now(),
            ],
            'costumer' => [
                'name' => 'costumer',
                'email' => 'costumer@gmail.com',
                'password' => Hash::make('costumer'),
                'email_verified_at' => now(),
            ]
        ];

        foreach ($dataUserCreate as $key => $value) {
            $createUser = User::create($value);

            if ($key === 'admin') {
                $createUser->assignRole(Role::where('name', 'Administrator')->first());
            }

            if ($key === 'costumer') {
                $createUser->assignRole(Role::where('name', 'Costumer')->first());
            }
            if ($key === 'perlengkapan') {
                $createUser->assignRole(Role::where('name', 'Perlengkapan')->first());
            }
        }
    }
}
