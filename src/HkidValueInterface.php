<?php

declare(strict_types=1);

namespace Ilex\Validation\HkidValidation;

interface HkidValueInterface
{
    public function getPart1(): string;

    public function getPart2(): string;

    public function getPart3(): string;

    public function format(): string;
}
