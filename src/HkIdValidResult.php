<?php

declare(strict_types=1);

namespace Ilex\Validation\HkidValidation;

use Ilex\Validation\HkidValidation\Reason\ReasonInterface;

final class HkIdValidResult
{
    private ReasonInterface $reason;

    /**
     * @var HkidValueInterface
     */
    private HkidValueInterface $hkid;

    public function __construct(
        HkidValueInterface $hkid,
        ReasonInterface $reason
    ) {
        $this->hkid = $hkid;
        $this->reason = $reason;
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

    public function getReason(): string
    {
        return $this->reason->getKey();
    }

    /**
     * @return string
     */
    public function getPart1(): string
    {
        return $this->hkid->getPart1();
    }

    /**
     * @return string
     */
    public function getPart2(): string
    {
        return $this->hkid->getPart2();
    }

    /**
     * @return string
     */
    public function getPart3(): string
    {
        return $this->hkid->getPart3();
    }

    public function format(): string
    {
        return $this->hkid->format();
    }

    public function __toString(): string
    {
        return $this->format();
    }
}
