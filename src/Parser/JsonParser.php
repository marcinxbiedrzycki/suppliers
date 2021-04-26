<?php

declare(strict_types=1);

namespace App\Parser;

final class JsonParser implements ParserInterface
{
    private const TYPE = 'json';

    public static function getType(): string
    {
        return self::TYPE;
    }

    public function parse(string $content): array
    {
        return json_decode($content, true, 512, JSON_THROW_ON_ERROR);
    }
}
