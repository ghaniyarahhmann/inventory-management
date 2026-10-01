<?php

namespace App\Actions\Sales;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Stock;
use App\Models\StockMovement;
use App\Models\Department;

class UpdateSaleAction
{
    public function execute(Sale $sale, $productId, $quantity, $price)
    {
        $item = $sale->items->first();

        // Restore the old product stock
        $oldProduct = Product::findOrFail($item->product_id);

        $oldProduct->stock += $item->quantity;
        $oldProduct->save();

        // Restore old stock table quantity
        $oldStock = Stock::firstOrCreate(
            ['product_id' => $item->product_id],
            ['quantity' => 0]
        );

        $oldStock->quantity += $item->quantity;
        $oldStock->save();

        // Update sale item
        $item->product_id = $productId;
        $item->quantity = $quantity;
        $item->price = $price;
        $item->total_amount = $quantity * $price;
        $item->save();

        // Reduce new product stock
        $newProduct = Product::findOrFail($productId);

        $newProduct->stock -= $quantity;
        $newProduct->save();

        // Reduce new stock table quantity
        $newStock = Stock::firstOrCreate(
            ['product_id' => $productId],
            ['quantity' => 0]
        );

        $newStock->quantity -= $quantity;
        $newStock->save();

        // Update stock movement
        $stockMovement = StockMovement::where('reference_type', 'sale')
            ->where('reference_id', $sale->id)
            ->first();

        if ($stockMovement) {

            $saleDepartment = Department::where('name', 'Sales')->first();

            $stockMovement->product_id = $productId;
            $stockMovement->department_id = $saleDepartment->id;
            $stockMovement->movement_type = 'OUT';
            $stockMovement->quantity = $quantity;
            $stockMovement->rate = $price;
            $stockMovement->amount = $quantity * $price;
            $stockMovement->unit = 'pcs';
            $stockMovement->reference_type = 'sale';
            $stockMovement->reference_id = $sale->id;

            $stockMovement->save();
        }

        return $sale;
    }
}