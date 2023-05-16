<?php

namespace Palantir\Descriptor;

use ReflectionMethod;

final class MethodDescriptor
{
    private readonly ClassDescriptor $class;

    private readonly ReflectionMethod $reflectionMethod;

    public static function for(string|ReflectionMethod $class, string $method): self
    {
        //
    }

    public function __construct(ClassDescriptor $class, ReflectionMethod $method)
    {
        $this->class = $class;
        $this->reflectionMethod = $method;
    }

    public function name(): string
    {
        return $this->reflectionMethod->getName();
    }

    public function isPublic(): bool
    {
        return $this->reflectionMethod->isPublic();
    }

    public function isStatic(): bool
    {
        return $this->reflectionMethod->isStatic();
    }
}