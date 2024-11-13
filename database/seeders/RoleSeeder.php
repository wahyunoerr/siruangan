<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = [
            [
                'name' => 'Administrator'
            ],
            [
                'name' => 'Costumer'
            ]
        ];

        foreach ($role as $r) {
            Role::updateOrCreate($r);
        }
    }
}
