<?php

namespace App\Services\Sales;

use App\Actions\Sales\CreateSaleAction;
use App\Actions\Sales\UpdateSaleAction;
use App\Actions\Sales\DeleteSaleAction;
use App\Models\Sale;

class SaleService
{
   public function create($productId, $quantity, $price, $totalAmount)
{
    return (new CreateSaleAction())->execute(
        $productId,
        $quantity,
        $price,
        $totalAmount
    );
}

   public function update(Sale $sale, $productId, $quantity, $price, $totalAmount)
{
    return (new UpdateSaleAction())->execute(
        $sale,
        $productId,
        $quantity,
        $price,
        $totalAmount
    );
}
    public function delete(Sale $sale)
    {
        return (new DeleteSaleAction())->execute($sale);
    }
}