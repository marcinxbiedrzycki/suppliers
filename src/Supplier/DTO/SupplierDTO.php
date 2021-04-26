<?php

declare(strict_types=1);

namespace App\Supplier\DTO;

final class SupplierDTO
{
    public function __construct(
      private string $id,
      private string $name,
      private ?string $desc,
    ){}

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->desc;
    }
}
