<?php

declare(strict_types=1);

namespace App\Supplier\Factory;

use App\Event\IntegrationEvents;
use App\Exception\SupplierNotFoundException;
use App\Listener\ProductsListener;
use App\Parser\Factory\ParserFactoryInterface;
use App\Supplier\Supplier1;
use App\Supplier\Supplier2;
use App\Supplier\Supplier3;
use App\Supplier\SupplierInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;

final class SupplierFactory implements SupplierFactoryInterface
{
    private const SUPPLIER_1 = 'supplier1';
    private const SUPPLIER_2 = 'supplier2';
    private const SUPPLIER_3 = 'supplier3';

    public function __construct(
        private EventDispatcherInterface $eventDispatcher,
        private LoggerInterface $suppliersLogger,
        private ParserFactoryInterface $parserFactory
    ) {
        $this->eventDispatcher->addListener(
            IntegrationEvents::SUPPLIER_GET_PRODUCTS,
            [new ProductsListener($this->suppliersLogger), 'logProducts']
        );
    }

    public function getSupplier(string $supplierName): SupplierInterface|SupplierNotFoundException
    {
        return match ($supplierName) {
            self::SUPPLIER_1 => new Supplier1($this->parserFactory->getParser(Supplier1::getResponseType()), $this->eventDispatcher),
            self::SUPPLIER_2 => new Supplier2($this->parserFactory->getParser(Supplier2::getResponseType()), $this->eventDispatcher),
            self::SUPPLIER_3 => new Supplier3($this->parserFactory->getParser(Supplier3::getResponseType()), $this->eventDispatcher),
            default => throw new SupplierNotFoundException($supplierName),
        };
    }
}
