<?php

namespace App\Interfaces;

interface HurtowniaRepositoryInterface
{
    public function getAllProducts();

    public function updateProductAmountInHurtownia($productId);
}
