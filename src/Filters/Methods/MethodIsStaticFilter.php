<?php

namespace Palantir\Descriptor\Filters\Methods;

use Palantir\Descriptor\MethodDescriptor;

final class MethodIsStaticFilter
{
    public function __invoke(MethodDescriptor $method): bool
    {
        return $method->isStatic();
    }
}