<?php

declare(strict_types=1);

namespace Ilex\Validation\HkidValidation;

/**
 * @see \Ilex\Validation\HkidValidation\Tests\HkidTest
 */
final readonly class Hkid implements HkidValueInterface
{

    public function __construct(
        private string $part1,
        private string $part2,
        private string $part3,
    ) {
    }

    #[\Override]
    public function getPart1(): string
    {
        return $this->part1;
    }

    #[\Override]
    public function getPart2(): string
    {
        return $this->part2;
    }

    #[\Override]
    public function getPart3(): string
    {
        return $this->part3;
    }

    #[\Override]
    public function format(): string
    {
        return \sprintf('%s%s(%s)', $this->getPart1(), $this->getPart2(), $this->getPart3());
    }
}
