<?php

namespace App\Supplier\Factory;

use App\Exception\SupplierNotFoundException;
use App\Supplier\SupplierInterface;

interface SupplierFactoryInterface
{
    public function getSupplier(string $supplierName): SupplierInterface|SupplierNotFoundException;
}
