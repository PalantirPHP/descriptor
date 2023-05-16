<?php

namespace Palantir\Descriptor\Filters\Methods;

use Palantir\Descriptor\MethodDescriptor;

final class MethodIsPublicFilter
{
    public function __invoke(MethodDescriptor $method): bool
    {
        return $method->isPublic();
    }
}