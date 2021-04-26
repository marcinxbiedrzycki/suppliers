<?php

declare(strict_types=1);

namespace App\Supplier;

use App\Exception\FileNotFoundException;
use App\Supplier\DTO\SupplierDTO;

final class Supplier1 extends SupplierAbstract
{
    private const NAME = 'supplier1';
    private const TYPE = 'xml';
    private const URL = 'http://nginx/suppliers/supplier1.xml';

    public static function getName(): string
    {
        return self::NAME;
    }

    public static function getResponseType(): string
    {
        return self::TYPE;
    }

    protected function parseResponse(): array
    {
        $data = $this->parser->parse($this->getResponse());

        return $this->createDto($data);
    }

    protected function createDto(array $data): array
    {
        $tmp = [];
        foreach ($data['product'] as $value) {
            $sup = new SupplierDTO($value['id'], $value['name'], $value['description'] ?? 'no description available');
            $tmp[] = [$sup->getId(), $sup->getName(), $sup->getDescription()];
        }

        return $tmp;
    }

    protected function getResponse(): string|bool
    {
        return file_get_contents(self::URL) ?? throw new FileNotFoundException(self::URL);
    }
}
