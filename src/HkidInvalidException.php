<?php

declare(strict_types=1);

namespace Ilex\Validation\HkidValidation;

use Exception;

final class HkidInvalidException extends Exception
{
    public static function create(string $string): self
    {
        $msg = 'HKID Validate fail for: ' . $string;
        return new static($msg);
    }
}
