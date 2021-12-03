<?php
declare(strict_types=1);

namespace Ilex\Validation\HkidValidation\Enum;

enum Reason
{

    case OK;

    case PATTEN_ERROR;

    case DIGIT_ERROR;

    public function isValid(): bool
    {
        return match ($this) {
            self::OK => true,
            default => false,
        };
    }

    public function isPattenError(): bool
    {
        return match ($this) {
            self::PATTEN_ERROR => true,
            default => false,
        };
    }

    public function isDigitError(): bool
    {
        return match ($this) {
            self::DIGIT_ERROR => true,
            default => false,
        };
    }
}
