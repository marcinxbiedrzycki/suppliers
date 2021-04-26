<?php

declare(strict_types=1);

namespace App\Supplier;

use App\Event\GetProductsEvent;
use App\Exception\InvalidParserException;
use App\Parser\ParserInterface;
use App\Supplier\DTO\SupplierDTO;
use Psr\EventDispatcher\EventDispatcherInterface;

abstract class SupplierAbstract implements SupplierInterface
{
    public function __construct(
        protected ParserInterface $parser,
        protected EventDispatcherInterface $eventDispatcher
    ){}

    abstract protected function parseResponse(): array|InvalidParserException;

    /**
     * @return SupplierDTO[]
     */
    abstract protected function createDto(array $data): array;

    public function getProducts(): array
    {
        $products = $this->parseResponse();
        $this->eventDispatcher->dispatch(new GetProductsEvent($products, static::getName()));

        return $products;
    }
}
