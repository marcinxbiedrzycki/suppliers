<?php

declare(strict_types=1);

namespace App\Supplier;

use App\Exception\InvalidParserException;
use App\Supplier\DTO\SupplierDTO;

final class Supplier3 extends SupplierAbstract
{
    private const NAME = 'supplier3';
    private const TYPE = 'json';
    private const URL = 'http://nginx/suppliers/supplier3.json';

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
        try {
            $data = $this->parser->parse($this->getResponse());
        } catch (InvalidParserException $e) {
            return [$e->getMessage()];
        }

        return $this->createDto($data);
    }

    protected function getResponse(): string|bool
    {
        return file_get_contents(self::URL);
    }

    protected function createDto(array $data): array
    {
        $tmp = [];
        foreach ($data['list'] as $item) {
            $sup = new SupplierDTO($item['id'], $item['name'], $item['description'] ?? 'no description available');
            $tmp[] = [$sup->getId(), $sup->getName(), $sup->getDescription()];
        }

        return $tmp;
    }
}
