<?php

declare(strict_types=1);

namespace Ilex\Validation\HkidValidation;

interface HkidValueInterface
{
    /**
     * @return string
     */
    public function getPart1(): string;

    /**
     * @return string
     */
    public function getPart2(): string;

    /**
     * @return string
     */
    public function getPart3(): string;

    public function format(): string;
}
