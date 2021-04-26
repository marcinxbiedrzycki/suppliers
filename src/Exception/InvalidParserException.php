<?php

declare(strict_types=1);

namespace App\Exception;

final class InvalidParserException extends \RuntimeException
{
    public function __construct(string $parser)
    {
        parent::__construct(sprintf('Parser %s not found', $parser));
    }
}
