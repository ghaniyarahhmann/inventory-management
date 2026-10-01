<?php

namespace App\Actions\Sales;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Stock;
use App\Models\StockMovement;

class DeleteSaleAction
{
    public function execute(Sale $sale)
    {
        $item = $sale->items->first();

        if ($item) {

            // Restore product stock
            $product = Product::findOrFail($item->product_id);

            $product->stock += $item->quantity;
            $product->save();

            // Restore stock table quantity
            $stock = Stock::where('product_id', $item->product_id)->first();

            if ($stock) {
                $stock->quantity += $item->quantity;
                $stock->save();
            }

            // Delete stock movement
            StockMovement::where('reference_type', 'sale')
                ->where('reference_id', $sale->id)
                ->delete();

            // Delete sale item
            $item->delete();
        }

        // Delete sale
        $sale->delete();
    }
}