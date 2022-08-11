<?php

declare(strict_types=1);

namespace Ilex\Validation\HkidValidation;

use Ilex\ResultOption\Option\Option;
use Ilex\Validation\HkidValidation\Enum\Reason;

final class HkIdValidResult implements \Stringable
{

    /**
     * HkIdValidResult constructor.
     *
     * @param \Ilex\ResultOption\Option\Option<\Ilex\Validation\HkidValidation\Hkid> $hkid
     */
    public function __construct(
        private readonly Option $hkid,
        private readonly Reason $reason,
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
     * @return string
     * @throws \Ilex\ResultOption\Error\OptionException
     */
    public function getPart1(): string
    {
        return $this->hkid->unwrap()->getPart1();
    }

    /**
     * @return string
     * @throws \Ilex\ResultOption\Error\OptionException
     */
    public function getPart2(): string
    {
        return $this->hkid->unwrap()->getPart2();
    }

    /**
     * @return string
     * @throws \Ilex\ResultOption\Error\OptionException
     */
    public function getPart3(): string
    {
        return $this->hkid->unwrap()->getPart3();
    }

    /**
     * @throws \Ilex\ResultOption\Error\OptionException
     */
    public function format(): string
    {
        return $this->hkid->unwrap()->format();
    }

    /**
     * @throws \Ilex\ResultOption\Error\OptionException
     */
    public function __toString(): string
    {
        return $this->format();
    }
}
