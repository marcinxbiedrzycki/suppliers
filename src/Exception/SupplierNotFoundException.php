<?php

declare(strict_types=1);

namespace App\Exception;

final class SupplierNotFoundException extends \RuntimeException
{
    public function __construct(string $name)
    {
        parent::__construct(sprintf("wrong supplier name %s", $name));
    }
}
