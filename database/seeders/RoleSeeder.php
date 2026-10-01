<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'Admin']);

        Role::firstOrCreate(['name' => 'Purchase User']);
        Role::firstOrCreate(['name' => 'Purchase Officer']);
        Role::firstOrCreate(['name' => 'Purchase Head']);

        Role::firstOrCreate(['name' => 'Sales User']);
        Role::firstOrCreate(['name' => 'Sales Officer']);
        Role::firstOrCreate(['name' => 'Sales Head']);
    }
}