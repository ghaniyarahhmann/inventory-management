<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Product permissions
        Permission::firstOrCreate(['name' => 'view_products']);
        Permission::firstOrCreate(['name' => 'create_products']);
        Permission::firstOrCreate(['name' => 'edit_products']);
        Permission::firstOrCreate(['name' => 'delete_products']);

        // Purchase permissions
        Permission::firstOrCreate(['name' => 'view_purchases']);
        Permission::firstOrCreate(['name' => 'create_purchases']);
        Permission::firstOrCreate(['name' => 'edit_purchases']);
        Permission::firstOrCreate(['name' => 'delete_purchases']);

        // Sales permissions
        Permission::firstOrCreate(['name' => 'view_sales']);
        Permission::firstOrCreate(['name' => 'create_sales']);
        Permission::firstOrCreate(['name' => 'edit_sales']);
        Permission::firstOrCreate(['name' => 'delete_sales']);
    }
}