<?php

declare(strict_types=1);

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

final class GetProductsEvent extends Event
{
    public function __construct(
     protected array $products,
     protected string $supplierName,
    ){}

    public function getProducts(): array
    {
        return $this->products;
    }

    public function getSupplierName(): string
    {
        return $this->supplierName;
    }
}
