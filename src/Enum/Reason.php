<?php
declare(strict_types=1);

namespace Ilex\Validation\HkidValidation\Enum;

enum Reason
{

    case Ok;

    case PattenError;

    case DigitError;

    public function isValid(): bool
    {
        return match ($this) {
            self::Ok => true,
            default => false,
        };
    }

    public function isPattenError(): bool
    {
        return match ($this) {
            self::PattenError => true,
            default => false,
        };
    }

    public function isDigitError(): bool
    {
        return match ($this) {
            self::DigitError => true,
            default => false,
        };
    }
}
