<?php

namespace App\Services\Purchases;

use App\Actions\Purchases\CreatePurchaseAction;
use App\Actions\Purchases\UpdatePurchaseAction;
use App\Actions\Purchases\DeletePurchaseAction;
use App\Models\Purchase;

class PurchaseService
{
    public function create($productId, $quantity, $price)
    {
        return (new CreatePurchaseAction())->execute(
            $productId,
            $quantity,
            $price
        );
    }

    public function update(Purchase $purchase, $productId, $quantity, $price)
    {
        return (new UpdatePurchaseAction())->execute(
            $purchase,
            $productId,
            $quantity,
            $price
        );
    }

    public function delete(Purchase $purchase)
    {
        return (new DeletePurchaseAction())->execute($purchase);
    }
}