<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Product Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Department Routes
    Route::resource('departments', DepartmentController::class)
        ->middleware(['auth', 'permission:view_departments']);

    // User Routes
    Route::resource('users', UserController::class)
        ->middleware(['auth', 'permission:view_users']);

    // Role Routes
    Route::resource('roles', RoleController::class)
        ->middleware(['auth', 'permission:view_roles']);

    // Product Routes
    Route::get('/products', [ProductController::class, 'index'])
        ->middleware('permission:view_products')
        ->name('products.index');

    Route::get('/products/create', [ProductController::class, 'create'])
        ->middleware('permission:create_products')
        ->name('products.create');

    Route::post('/products', [ProductController::class, 'store'])
        ->middleware('permission:create_products')
        ->name('products.store');

    Route::get('/products/{product}', [ProductController::class, 'show'])
        ->middleware('permission:view_products')
        ->name('products.show');

    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
        ->middleware('permission:edit_products')
        ->name('products.edit');

    Route::put('/products/{product}', [ProductController::class, 'update'])
        ->middleware('permission:edit_products')
        ->name('products.update');

    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
        ->middleware('permission:delete_products')
        ->name('products.destroy');


    /*
    |--------------------------------------------------------------------------
    | Purchase Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/purchases', [PurchaseController::class, 'index'])
        ->middleware('permission:view_purchases')
        ->name('purchases.index');

    Route::get('/purchases/create', [PurchaseController::class, 'create'])
        ->middleware('permission:create_purchases')
        ->name('purchases.create');

    Route::post('/purchases', [PurchaseController::class, 'store'])
        ->middleware('permission:create_purchases')
        ->name('purchases.store');

    Route::get('/purchases/{purchase}', [PurchaseController::class, 'show'])
        ->middleware('permission:view_purchases')
        ->name('purchases.show');

        Route::get('/purchases/{purchase}/edit', [PurchaseController::class, 'edit'])
    ->middleware('permission:edit_purchases')
    ->name('purchases.edit');

Route::put('/purchases/{purchase}', [PurchaseController::class, 'update'])
    ->middleware('permission:edit_purchases')
    ->name('purchases.update');

    Route::delete('/purchases/{purchase}', [PurchaseController::class, 'destroy'])
    ->middleware('permission:delete_purchases')
    ->name('purchases.destroy');


    /*
    |--------------------------------------------------------------------------
    | Sales Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/sales', [SaleController::class, 'index'])
        ->middleware('permission:view_sales')
        ->name('sales.index');

    Route::get('/sales/create', [SaleController::class, 'create'])
        ->middleware('permission:create_sales')
        ->name('sales.create');

    Route::get('/sales/{sale}', [SaleController::class, 'show'])
        ->middleware('permission:view_sales')
        ->name('sales.show');

    Route::post('/sales', [SaleController::class, 'store'])
        ->middleware('permission:create_sales')
        ->name('sales.store');

    Route::get('/sales/{sale}/edit', [SaleController::class, 'edit'])
        ->middleware('permission:edit_sales')
        ->name('sales.edit');

    Route::put('/sales/{sale}', [SaleController::class, 'update'])
        ->middleware('permission:edit_sales')
        ->name('sales.update');

    Route::delete('/sales/{sale}', [SaleController::class, 'destroy'])
        ->middleware('permission:delete_sales')
        ->name('sales.destroy');

        Route::resource('sales', SaleController::class);

Route::get('/reports/stock', [ReportController::class, 'stockReport'])
    ->name('reports.stock');
});


/*
|--------------------------------------------------------------------------
| Stock Report
|--------------------------------------------------------------------------
*/

Route::get('/stock-report', [StockMovementController::class, 'index'])
    ->middleware('auth')
    ->name('stock.report');


/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


require __DIR__.'/auth.php';
