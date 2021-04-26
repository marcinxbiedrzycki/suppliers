<?php

declare(strict_types=1);

namespace App\Parser\Factory;

use App\Exception\InvalidParserException;
use App\Parser\ParserInterface;

interface ParserFactoryInterface
{
    public function getParser(string $type): ParserInterface|InvalidParserException;
}
