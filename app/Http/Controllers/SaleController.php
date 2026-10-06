<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\Sales\SaleService;

class SaleController extends Controller
{
    public function __construct(
        protected SaleService $saleService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with('items.product')
            ->latest()
            ->get();

        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();

        return view('sales.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $this->saleService->create(
    $request->product_id,
    $request->quantity,
    $request->price,
    $request->total_amount
);

        return redirect()
            ->route('sales.index')
            ->with('success', 'Sale created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        $sale->load('items.product');

        return view('sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        $sale->load('items.product');

        $products = Product::all();

        return view('sales.edit', compact('sale', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Sale $sale)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'price' => 'required|numeric|min:0',
        'total_amount' => 'required|numeric|min:0',
    ]);

    $this->saleService->update(
        $sale,
        $request->product_id,
        $request->quantity,
        $request->price,
        $request->total_amount
    );

    return redirect()
        ->route('sales.index')
        ->with('success', 'Sale updated successfully.');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $this->saleService->delete($sale);

        return redirect()
            ->route('sales.index')
            ->with('success', 'Sale deleted successfully.');
    }
}