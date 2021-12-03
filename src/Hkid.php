<?php

declare(strict_types=1);

namespace Ilex\Validation\HkidValidation;

/**
 * @see \Ilex\Validation\HkidValidation\Tests\HkidTest
 */
final class Hkid implements HkidValueInterface
{

    public function __construct(
        private readonly string $part1,
        private readonly string $part2,
        private readonly string $part3,
    ) {
    }

    /**
     * @return string
     */
    public function getPart1(): string
    {
        return $this->part1;
    }

    /**
     * @return string
     */
    public function getPart2(): string
    {
        return $this->part2;
    }

    /**
     * @return string
     */
    public function getPart3(): string
    {
        return $this->part3;
    }

    public function format(): string
    {
        return \sprintf('%s%s(%s)', $this->getPart1(), $this->getPart2(), $this->getPart3());
    }
}
