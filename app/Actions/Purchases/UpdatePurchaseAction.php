<?php

namespace App\Actions\Purchases;

use App\Models\Purchase;
use App\Models\Product;
use App\Models\Stock;
use App\Models\StockMovement;
use App\Models\Department;

class UpdatePurchaseAction
{
    public function execute(Purchase $purchase, $productId, $quantity, $price)
    {
        $item = $purchase->items->first();

        // Restore the old product stock
        $oldProduct = Product::findOrFail($item->product_id);

        $oldProduct->stock -= $item->quantity;
        $oldProduct->save();

        // Restore old stock table quantity
        $oldStock = Stock::firstOrCreate(
            ['product_id' => $item->product_id],
            ['quantity' => 0]
        );

        $oldStock->quantity -= $item->quantity;
        $oldStock->save();

        // Update purchase item
        $item->product_id = $productId;
        $item->quantity = $quantity;
        $item->price = $price;
        $item->save();

        // Add new product stock
        $newProduct = Product::findOrFail($productId);

        $newProduct->stock += $quantity;
        $newProduct->save();

        // Add new stock table quantity
        $newStock = Stock::firstOrCreate(
            ['product_id' => $productId],
            ['quantity' => 0]
        );

        $newStock->quantity += $quantity;
        $newStock->save();

        // Update stock movement
        $stockMovement = StockMovement::where('reference_type', 'purchase')
            ->where('reference_id', $purchase->id)
            ->first();

        if ($stockMovement) {

            $purchaseDepartment = Department::where('name', 'Purchase')->first();

            $stockMovement->product_id = $productId;
            $stockMovement->department_id = $purchaseDepartment->id;
            $stockMovement->movement_type = 'IN';
            $stockMovement->quantity = $quantity;
            $stockMovement->rate = $price;
            $stockMovement->amount = $quantity * $price;
            $stockMovement->unit = 'pcs';
            $stockMovement->reference_type = 'purchase';
            $stockMovement->reference_id = $purchase->id;

            $stockMovement->save();
        }

        return $purchase;
    }
}