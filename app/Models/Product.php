<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PurchaseItem;
use App\Models\SaleItem;
use App\Models\StockMovement;
use App\Models\Stock;

class Product extends Model
{
    use HasFactory;

    public function stockRecord()
{
    return $this->hasOne(Stock::class);
}

    protected $fillable = [
        'name',
        'price',
        'stock',
    ];

    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function stockMovements()
{
    return $this->hasMany(StockMovement::class);
}
}