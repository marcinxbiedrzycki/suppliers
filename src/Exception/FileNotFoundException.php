<?php

declare(strict_types=1);

namespace App\Exception;

use SebastianBergmann\CodeCoverage\RuntimeException;

final class FileNotFoundException extends RuntimeException
{
    public function __construct(string $fileName)
    {
        parent::__construct(sprintf("Cannot find  %s", $fileName));
    }
}
