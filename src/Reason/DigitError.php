<?php

declare(strict_types=1);

namespace Ilex\Validation\HkidValidation\Reason;

final class DigitError implements ReasonInterface
{
    public function isValid(): bool
    {
        return false;
    }

    public function isPattenError(): bool
    {
        return false;
    }

    public function isDigitError(): bool
    {
        return true;
    }

    public function getKey(): string
    {
        return ReasonInterface::DIGIT_ERROR;
    }
}
