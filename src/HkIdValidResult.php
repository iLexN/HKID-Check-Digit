<?php

declare(strict_types=1);

namespace Ilex\Validation\HkidValidation;

final class HkIdValidResult
{
    private bool $isValid;

    /**
     * @var \Ilex\Validation\HkidValidation\Hkid
     */
    private Hkid $hkid;

    public function __construct(
        Hkid $hkid,
        bool $isValid
    ) {
        $this->hkid = $hkid;
        $this->isValid = $isValid;
    }

    public function isValid(): bool
    {
        return $this->isValid;
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
