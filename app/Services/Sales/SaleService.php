<?php

namespace App\Services\Sales;

use App\Actions\Sales\CreateSaleAction;
use App\Actions\Sales\UpdateSaleAction;
use App\Actions\Sales\DeleteSaleAction;
use App\Models\Sale;

class SaleService
{
    public function create($productId, $quantity, $price)
    {
        return (new CreateSaleAction())->execute(
            $productId,
            $quantity,
            $price
        );
    }

    public function update(Sale $sale, $productId, $quantity, $price)
    {
        return (new UpdateSaleAction())->execute(
            $sale,
            $productId,
            $quantity,
            $price
        );
    }

    public function delete(Sale $sale)
    {
        return (new DeleteSaleAction())->execute($sale);
    }
}