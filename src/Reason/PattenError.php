<?php

declare(strict_types=1);

namespace Ilex\Validation\HkidValidation\Reason;

final class PattenError implements ReasonInterface
{
    public function isValid(): bool
    {
        return false;
    }

    public function isPattenError(): bool
    {
        return true;
    }

    public function isDigitError(): bool
    {
        return false;
    }

    public function getKey(): string
    {
        return ReasonInterface::PATTEN_ERROR;
    }
}
