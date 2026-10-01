<?php

namespace App\Models;
use App\Models\PurchaseItem;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public function items()
    {
        return $this->hasMany(PurchaseItem::class);
    }
}