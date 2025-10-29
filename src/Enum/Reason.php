<?php
declare(strict_types=1);

namespace Ilex\Validation\HkidValidation\Enum;

enum Reason
{

    case Ok;

    case PatternError;

    case DigitError;

    public function isValid(): bool
    {
        return match ($this) {
            self::Ok => true,
            default => false,
        };
    }

    public function isPatternError(): bool
    {
        return match ($this) {
            self::PatternError => true,
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
