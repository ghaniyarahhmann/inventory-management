<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function stockReport()
{
    $products = Product::withSum('purchaseItems', 'quantity')
        ->withSum('saleItems', 'quantity')
        ->orderBy('name')
        ->get();

    return view('reports.stock', compact('products'));
}
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $products = Product::withSum('purchaseItems', 'quantity')
        ->withSum('saleItems', 'quantity')
        ->get();

    return view('products.index', compact('products'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
           return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|unique:products,name',
        'price' => 'required|numeric',
    ]);

    $product = new Product();

    $product->name = $request->name;
    $product->price = $request->price;
    $product->stock = 0;

    $product->save();

    return redirect()->route('products.index');
}
    /**
     * Display the specified resource.
     */
   public function show(Product $product)
{
    $movements = $product->stockMovements()
        ->with('department')
        ->latest()
        ->get();

    $totalInQuantity = $product->stockMovements()
        ->where('movement_type', 'IN')
        ->sum('quantity');

    $totalOutQuantity = $product->stockMovements()
        ->where('movement_type', 'OUT')
        ->sum('quantity');

        $totalInAmount = $product->stockMovements()
    ->where('movement_type', 'IN')
    ->sum('amount');

$totalOutAmount = $product->stockMovements()
    ->where('movement_type', 'OUT')
    ->sum('amount');

    return view('products.show', compact(
    'product',
    'movements',
    'totalInQuantity',
    'totalOutQuantity',
    'totalInAmount',
    'totalOutAmount'
));
}

    /**
     * Show the form for editing the specified resource.
     */
  public function edit(Product $product)
{
    return view('products.edit', compact('product'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
{
  $request->validate([
    'name' => [
        'required',
        Rule::unique('products', 'name')->ignore($product->id),
    ],
    'price' => 'required|numeric',
]);

    $product->name = $request->name;
$product->price = $request->price;
$product->save();

    return redirect()->route('products.index');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
{
    if ($product->purchaseItems()->exists() || $product->saleItems()->exists()) {
        return redirect()
            ->route('products.index')
            ->with('error', 'This product cannot be deleted because it has transaction history.');
    }

    $product->delete();

    return redirect()
        ->route('products.index')
        ->with('success', 'Product deleted successfully.');
}
}
