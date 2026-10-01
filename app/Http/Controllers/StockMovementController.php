<?php

namespace App\Http\Controllers;

use App\Models\StockMovement;
use App\Models\Product;
use App\Models\Department;
use Illuminate\Http\Request;

class StockMovementController extends Controller
{
    public function index(Request $request)
    {
        $query = StockMovement::with(['product', 'department']);

        if ($request->movement_type) {
            $query->where('movement_type', $request->movement_type);
        }

        if ($request->product_id) {
            $query->where('product_id', $request->product_id);
        }

        if ($request->department_id) {
            $query->where('department_id', $request->department_id);
        }

        if ($request->from_date) {
    $query->whereDate('created_at', '>=', $request->from_date);
}

if ($request->to_date) {
    $query->whereDate('created_at', '<=', $request->to_date);
}

        $movements = $query->latest()->get();

        $totalInQuantity = (clone $query)
    ->where('movement_type', 'IN')
    ->sum('quantity');

$totalOutQuantity = (clone $query)
    ->where('movement_type', 'OUT')
    ->sum('quantity');

$totalInAmount = (clone $query)
    ->where('movement_type', 'IN')
    ->sum('amount');

$totalOutAmount = (clone $query)
    ->where('movement_type', 'OUT')
    ->sum('amount');

    $netQuantity = $totalInQuantity - $totalOutQuantity;

$netAmount = $totalInAmount - $totalOutAmount;

        $products = Product::orderBy('name')->get();

        $departments = Department::orderBy('name')->get();

        
return view('stock_movements.index', compact(
    'movements',
    'products',
    'departments',
    'totalInQuantity',
    'totalOutQuantity',
    'totalInAmount',
    'totalOutAmount',
    'netQuantity',
    'netAmount'
));
    }
}