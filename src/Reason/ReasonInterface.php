<?php

declare(strict_types=1);

namespace Ilex\Validation\HkidValidation\Reason;

interface ReasonInterface
{
    public const OK = 'Ok';
    public const PATTEN_ERROR = 'Patten error';
    public const DIGIT_ERROR = 'Digit error';

    public function isValid(): bool;

    public function isPattenError(): bool;

    public function isDigitError(): bool;

    public function getKey(): string;
}
