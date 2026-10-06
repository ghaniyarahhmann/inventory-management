<?php

namespace App\Actions\Purchases;

use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Product;
use App\Models\Stock;
use App\Models\StockMovement;
use App\Models\Department;

class CreatePurchaseAction
{



    public function execute($productId, $quantity, $price)
    {
        // Create purchase
        $purchase = new Purchase();
        $purchase->save();

        // Create purchase item
        $item = new PurchaseItem();

        $item->purchase_id = $purchase->id;
        $item->product_id = $productId;
        $item->quantity = $quantity;
        $item->price = $price;

        $item->save();

        // Update product stock
        $product = Product::findOrFail($productId);

        $product->stock += $quantity;
        $product->save();

        // Update stock table
        $stock = Stock::firstOrCreate(
            ['product_id' => $productId],
            ['quantity' => 0]
        );

        $stock->quantity += $quantity;
        $stock->save();

        // Create stock movement
        $purchaseDepartment = Department::where('name', 'Purchase')->first();

        StockMovement::create([
            'product_id' => $productId,
            'department_id' => $purchaseDepartment->id,
            'movement_type' => 'IN',
            'quantity' => $quantity,
            'rate' => $price,
            'amount' => $quantity * $price,
            'unit' => 'pcs',
            'reference_type' => 'purchase',
            'reference_id' => $purchase->id,
        ]);

        return $purchase;
    }
}