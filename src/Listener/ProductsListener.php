<?php

declare(strict_types=1);

namespace App\Listener;

use App\Event\GetProductsEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Contracts\EventDispatcher\Event;

final class ProductsListener implements EventSubscriberInterface
{
    public function __construct(
        protected LoggerInterface $logger
    ){}

    public function logProducts(Event $event): bool
    {
        if ($event instanceof GetProductsEvent) {
            foreach ($event->getProducts() as $product) {
                $productKeys = array_keys($product);
                $this->logger->info(
                    'Product added: ' . $product[$productKeys[0]],
                    ['supplier' => $event->getSupplierName()]
                );
            }
        }
        return true;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            GetProductsEvent::class => 'logProducts'
        ];
    }
}
