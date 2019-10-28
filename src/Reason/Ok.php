<?php

declare(strict_types=1);

namespace Ilex\Validation\HkidValidation\Reason;

final class Ok implements ReasonInterface
{
    public function isValid(): bool
    {
        return true;
    }

    public function isPattenError(): bool
    {
        return false;
    }

    public function isDigitError(): bool
    {
        return false;
    }

    public function getKey(): string
    {
        return ReasonInterface::OK;
    }
}
