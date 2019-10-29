<?php

declare(strict_types=1);

namespace Ilex\Validation\HkidValidation\Benchmark;

use Ilex\Validation\HkidValidation\Helper;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

final class HkidBenchmark
{

    /**
     * @Revs(1000)
     * @Iterations(5)
     */
    public function benchCheckString(): void
    {
        $result = Helper::checkByString('B111111(1)');
        $result->format();
        $result->isValid();
    }

    /**
     * @Revs(1000)
     * @Iterations(5)
     */
    public function benchCheckParts(): void
    {
        $result = Helper::checkByParts('B', '111111', '1');
        $result->format();
        $result->isValid();
    }
}
