<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;

class ReportController extends Controller
{
    public function stockReport()
    {
        $products = Product::withSum('purchaseItems', 'quantity')
            ->withSum('saleItems', 'quantity')
            ->get();

        $stockMovements = StockMovement::with('product')
            ->latest()
            ->get();

        return view('reports.stock', compact(
            'products',
            'stockMovements'
        ));
    }
}