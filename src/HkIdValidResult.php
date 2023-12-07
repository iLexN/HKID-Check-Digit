<?php

declare(strict_types=1);

namespace Ilex\Validation\HkidValidation;

use Ilex\ResultOption\Error\OptionException;
use Ilex\ResultOption\Option\Option;
use Ilex\Validation\HkidValidation\Enum\Reason;

final readonly class HkIdValidResult implements \Stringable
{

    /**
     * HkIdValidResult constructor.
     *
     * @param Option<Hkid> $hkid
     */
    public function __construct(
        private Option $hkid,
        private Reason $reason,
    ) {
    }

    public function isValid(): bool
    {
        return $this->reason->isValid();
    }

    public function isPattenError(): bool
    {
        return $this->reason->isPattenError();
    }

    public function isDigitError(): bool
    {
        return $this->reason->isDigitError();
    }

    public function getReason(): Reason
    {
        return $this->reason;
    }

    /**
     * @throws OptionException
     */
    public function getPart1(): string
    {
        return $this->hkid->unwrap()->getPart1();
    }

    /**
     * @throws OptionException
     */
    public function getPart2(): string
    {
        return $this->hkid->unwrap()->getPart2();
    }

    /**
     * @throws OptionException
     */
    public function getPart3(): string
    {
        return $this->hkid->unwrap()->getPart3();
    }

    /**
     * @throws OptionException
     */
    public function format(): string
    {
        return $this->hkid->unwrap()->format();
    }

    /**
     * @throws OptionException
     */
    public function __toString(): string
    {
        return $this->format();
    }
}
