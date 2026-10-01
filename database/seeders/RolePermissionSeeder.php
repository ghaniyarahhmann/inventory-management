<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Roles
        $admin = Role::where('name', 'Admin')->first();

        $purchaseUser = Role::where('name', 'Purchase User')->first();
        $purchaseOfficer = Role::where('name', 'Purchase Officer')->first();
        $purchaseHead = Role::where('name', 'Purchase Head')->first();

        $salesUser = Role::where('name', 'Sales User')->first();
        $salesOfficer = Role::where('name', 'Sales Officer')->first();
        $salesHead = Role::where('name', 'Sales Head')->first();

        // Purchase permissions
        $viewPurchases = Permission::where('name', 'view_purchases')->first();
        $createPurchases = Permission::where('name', 'create_purchases')->first();
        $editPurchases = Permission::where('name', 'edit_purchases')->first();
        $deletePurchases = Permission::where('name', 'delete_purchases')->first();

        // Sales permissions
        $viewSales = Permission::where('name', 'view_sales')->first();
        $createSales = Permission::where('name', 'create_sales')->first();
        $editSales = Permission::where('name', 'edit_sales')->first();
        $deleteSales = Permission::where('name', 'delete_sales')->first();

        // Product permissions
        $viewProducts = Permission::where('name', 'view_products')->first();
        $createProducts = Permission::where('name', 'create_products')->first();
        $editProducts = Permission::where('name', 'edit_products')->first();
        $deleteProducts = Permission::where('name', 'delete_products')->first();


        $viewUsers = Permission::where('name', 'view_users')->first();
$viewRoles = Permission::where('name', 'view_roles')->first();
$viewDepartments = Permission::where('name', 'view_departments')->first();


        // Admin - everything
        $admin->permissions()->sync([
            $viewProducts->id,
            $createProducts->id,
            $editProducts->id,
            $deleteProducts->id,

            $viewPurchases->id,
            $createPurchases->id,
            $editPurchases->id,
            $deletePurchases->id,

            $viewSales->id,
            $createSales->id,
            $editSales->id,
            $deleteSales->id,

            $viewUsers->id,
$viewRoles->id,
$viewDepartments->id,
        ]);

        // Purchase User
        $purchaseUser->permissions()->sync([
            $viewPurchases->id,
            $createPurchases->id,
        ]);

        // Purchase Officer
        $purchaseOfficer->permissions()->sync([
            $viewPurchases->id,
            $createPurchases->id,
            $editPurchases->id,
        ]);

        // Purchase Head
        $purchaseHead->permissions()->sync([
            $viewPurchases->id,
            $createPurchases->id,
            $editPurchases->id,
            $deletePurchases->id,
        ]);

        // Sales User
        $salesUser->permissions()->sync([
            $viewSales->id,
            $createSales->id,
        ]);

        // Sales Officer
        $salesOfficer->permissions()->sync([
            $viewSales->id,
            $createSales->id,
            $editSales->id,
        ]);

        // Sales Head
        $salesHead->permissions()->sync([
            $viewSales->id,
            $createSales->id,
            $editSales->id,
            $deleteSales->id,
        ]);
    }
}