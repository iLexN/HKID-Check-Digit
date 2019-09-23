<?php

declare(strict_types=1);

namespace Ilex\Validation\HkidValidation;

final class HkId
{
    /**
     * @var string
     */
    private string  $part1;

    /**
     * @var string
     */
    private string $part2;

    /**
     * @var string
     */
    private string $part3;

    private bool $isValid;

    public function __construct(
        string $part1,
        string $part2,
        string $part3,
        bool $isValid
    ) {
        $this->part1 = $part1;
        $this->part2 = $part2;
        $this->part3 = $part3;
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
        return "{$this->getPart1()}{$this->getPart2()}({$this->getPart3()})";
    }

    public function __toString(): string
    {
        return $this->format();
    }
}
