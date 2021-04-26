<?php

declare(strict_types=1);

namespace App\Parser\Factory;

use App\Exception\InvalidParserException;
use App\Parser\JsonParser;
use App\Parser\ParserInterface;
use App\Parser\XmlParser;

final class ParserFactory implements ParserFactoryInterface
{
    private const XML_TYPE = 'xml';
    private const JSON_TYPE = 'json';

    public function getParser(string $type): ParserInterface
    {
        return match ($type) {
            self::XML_TYPE => new XmlParser(),
            self::JSON_TYPE => new JsonParser(),
            default => throw new InvalidParserException($type),
        };
    }
}
