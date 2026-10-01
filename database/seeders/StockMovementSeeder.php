<?php

namespace Database\Seeders;

use App\Models\PurchaseItem;
use App\Models\SaleItem;
use App\Models\Department;
use App\Models\StockMovement;
use Illuminate\Database\Seeder;

class StockMovementSeeder extends Seeder
{
    public function run(): void
    {
        $purchaseDepartment = Department::where('name', 'Purchase')->firstOrFail();
        $salesDepartment = Department::where('name', 'Sales')->firstOrFail();

        // Convert existing purchases into stock movements
        PurchaseItem::with('purchase')
            ->orderBy('id')
            ->get()
            ->each(function ($item) use ($purchaseDepartment) {

                StockMovement::updateOrCreate(
                    [
                        'reference_type' => 'purchase',
                        'reference_id' => $item->purchase_id,
                        'product_id' => $item->product_id,
                        'movement_type' => 'IN',
                    ],
                    [
                        'department_id' => $purchaseDepartment->id,
                        'quantity' => $item->quantity,
                        'rate' => $item->price,
                        'amount' => $item->quantity * $item->price,
                        'unit' => 'pcs',
                        'created_at' => $item->purchase->created_at,
                        'updated_at' => $item->purchase->updated_at,
                    ]
                );
            });

        // Convert existing sales into stock movements
        SaleItem::with('sale')
            ->orderBy('id')
            ->get()
            ->each(function ($item) use ($salesDepartment) {

                StockMovement::updateOrCreate(
                    [
                        'reference_type' => 'sale',
                        'reference_id' => $item->sale_id,
                        'product_id' => $item->product_id,
                        'movement_type' => 'OUT',
                    ],
                    [
                        'department_id' => $salesDepartment->id,
                        'quantity' => $item->quantity,
                        'rate' => $item->price,
                        'amount' => $item->quantity * $item->price,
                        'unit' => 'pcs',
                        'created_at' => $item->sale->created_at,
                        'updated_at' => $item->sale->updated_at,
                    ]
                );
            });
    }
}