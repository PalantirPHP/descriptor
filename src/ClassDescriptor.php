<?php

namespace Palantir\Descriptor;

use DateTime;
use Palantir\Descriptor\Collections\MethodCollection;
use ReflectionClass;
use ReflectionMethod;

final class ClassDescriptor
{
    private readonly ReflectionClass $reflectionClass;

    private MethodCollection $methods;

    public static function for(string|object $class): self
    {
        if (! ($class instanceof ReflectionClass)) {
            $class = new ReflectionClass($class);
        }

        return new self($class);
    }

    public function __construct(ReflectionClass $class)
    {
        $this->reflectionClass = $class;
    }

    public function name(): string
    {
        return $this->reflectionClass->getName();
    }

    public function methods(): MethodCollection
    {
        return $this->methods ??= new MethodCollection(
            array_map(
                fn (ReflectionMethod $method) => new MethodDescriptor($this, $method),
                $this->reflectionClass->getMethods()
            )
        );
    }

    public function isFinal(): bool
    {
        return $this->reflectionClass->isFinal();
    }

    public function isReadonly(): bool
    {
        return $this->reflectionClass->isReadOnly();
    }

    public function isSubclassOf(ClassDescriptor|ReflectionClass|string $class): bool
    {
        if ($class instanceof ClassDescriptor) {
            $class = $class->reflectionClass;
        }

        return $this->reflectionClass->isSubclassOf($class);
    }
}