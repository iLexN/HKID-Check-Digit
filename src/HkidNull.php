<?php

declare(strict_types=1);

namespace Ilex\Validation\HkidValidation;

final class HkidNull implements HkidValueInterface
{
    public function __construct(
        private string $hkid
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function getPart1(): string
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public function getPart2(): string
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public function getPart3(): string
    {
        return '';
    }

    public function format(): string
    {
        return $this->hkid;
    }
}
