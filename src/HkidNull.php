<?php

declare(strict_types=1);

namespace Ilex\Validation\HkidValidation;

final class HkidNull implements HkidValueInterface
{
    /**
     * @var string
     */
    private string $hkid;

    public function __construct(string $hkid)
    {
        $this->hkid = $hkid;
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
