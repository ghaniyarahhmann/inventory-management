<?php

namespace App\Actions\Purchases;

use App\Models\Purchase;
use App\Models\Product;
use App\Models\Stock;
use App\Models\StockMovement;

class DeletePurchaseAction
{
    public function execute(Purchase $purchase)
    {
        $item = $purchase->items->first();

        if ($item) {

            // Restore product stock
            $product = Product::findOrFail($item->product_id);

            $product->stock -= $item->quantity;
            $product->save();

            // Restore stock table quantity
            $stock = Stock::where('product_id', $item->product_id)->first();

            if ($stock) {
                $stock->quantity -= $item->quantity;
                $stock->save();
            }

            // Delete stock movement
            StockMovement::where('reference_type', 'purchase')
                ->where('reference_id', $purchase->id)
                ->delete();

            // Delete purchase item
            $item->delete();
        }

        // Delete purchase
        $purchase->delete();
    }
}