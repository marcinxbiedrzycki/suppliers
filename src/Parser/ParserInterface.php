<?php

declare(strict_types=1);

namespace App\Parser;

use App\Exception\InvalidParserException;

interface ParserInterface
{
    public function parse(string $content): array|InvalidParserException;

    public static function getType(): string;

}
