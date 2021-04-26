<?php

namespace App\Supplier;

use App\Exception\InvalidParserException;
use App\Parser\ParserInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

interface SupplierInterface
{
    public function __construct(ParserInterface $parser, EventDispatcher $eventDispatcher);

    public static function getName(): string;

    public static function getResponseType(): string;

    public function getProducts(): array|InvalidParserException;
}
