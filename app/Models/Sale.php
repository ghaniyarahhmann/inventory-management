<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SaleItem;

class Sale extends Model
{
    public function items()
{
    return $this->hasMany(SaleItem::class);
}
    
}