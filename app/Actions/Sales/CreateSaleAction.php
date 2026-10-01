<?php

namespace App\Actions\Sales;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use App\Models\Stock;
use App\Models\StockMovement;
use App\Models\Department;

class CreateSaleAction
{
    public function execute($productId, $quantity, $price)
    {
        // Create sale
        $sale = new Sale();
        $sale->save();

        // Create sale item
        $item = new SaleItem();

        $item->sale_id = $sale->id;
        $item->product_id = $productId;
        $item->quantity = $quantity;
        $item->price = $price;
        $item->total_amount = $quantity * $price;

        $item->save();

        // Reduce product stock
        $product = Product::findOrFail($productId);

        $product->stock -= $quantity;
        $product->save();

        // Reduce stock table quantity
        $stock = Stock::firstOrCreate(
            ['product_id' => $productId],
            ['quantity' => 0]
        );

        $stock->quantity -= $quantity;
        $stock->save();

        // Create stock movement
        $saleDepartment = Department::where('name', 'Sales')->first();

        StockMovement::create([
            'product_id' => $productId,
            'department_id' => $saleDepartment->id,
            'movement_type' => 'OUT',
            'quantity' => $quantity,
            'rate' => $price,
            'amount' => $quantity * $price,
            'unit' => 'pcs',
            'reference_type' => 'sale',
            'reference_id' => $sale->id,
        ]);

        return $sale;
    }
}