<?php

namespace Palantir\Descriptor\Filters\Methods;

use Palantir\Descriptor\MethodDescriptor;

final readonly class MethodNameFilter
{
    public function __construct(private string $name)
    {}

    public function __invoke(MethodDescriptor $method): bool
    {
        return $method->name() === $this->name;
    }
}