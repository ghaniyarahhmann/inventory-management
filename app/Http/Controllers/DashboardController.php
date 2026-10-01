<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\PurchaseItem;
use App\Models\SaleItem;

class DashboardController extends Controller
{
public function index()
{
    $totalProducts = Product::count();

    $totalStock = Product::sum('stock');

    $lowStockProducts = Product::where('stock', '<=', 5)->get();

    $totalPurchases = Purchase::count();

    $totalSales = Sale::count();

   $totalPurchaseAmount = PurchaseItem::selectRaw('SUM(quantity * price) as total')->value('total');

   $totalSaleAmount = SaleItem::sum('total_amount');
   $recentSales = SaleItem::with('product')
    ->latest()
    ->take(5)
    ->get();

$stockOverview = Product::orderBy('stock', 'asc')
    ->take(5)
    ->get();

    return view('dashboard', [
        'lowStockProducts' => $lowStockProducts,
        'totalProducts' => $totalProducts,
        'totalStock' => $totalStock,
        'totalPurchases' => $totalPurchases,
        'totalSales' => $totalSales,
        'totalPurchaseAmount' => $totalPurchaseAmount,
        'totalSaleAmount' => $totalSaleAmount,
        'recentSales' => $recentSales,
        'stockOverview' => $stockOverview,
    ]);
}
   
}
