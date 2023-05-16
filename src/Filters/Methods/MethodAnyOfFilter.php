<?php

namespace Palantir\Descriptor\Filters\Methods;

use Palantir\Descriptor\MethodDescriptor;

class MethodAnyOfFilter
{
    public function __construct(private array $filters)
    {}

    public function __invoke(MethodDescriptor $method): bool
    {
        foreach ($this->filters as $filter) {
            if ($filter($method)) {
                return true;
            }
        }

        return false;
    }
}