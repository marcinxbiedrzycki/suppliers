<?php

declare(strict_types=1);

namespace App\Parser;

use App\Supplier\Supplier2;

final class XmlParser implements ParserInterface
{
    public static function getType(): string
    {
        return Supplier2::getResponseType();
    }

    public function parse(string $content): array
    {
        $xmlList = simplexml_load_string($content);

        $json = json_encode($xmlList, JSON_THROW_ON_ERROR);

        return json_decode($json, TRUE, 512, JSON_THROW_ON_ERROR);

    }
}
