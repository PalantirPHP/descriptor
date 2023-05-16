<?php

namespace Palantir\Descriptor\Collections;

use ArrayAccess;

final class ClassCollection implements ArrayAccess
{
    private array $classes = [];

    public function __construct(ArrayAccess $classes)
    {
        //
    }

    public function filter(callable $filter): ClassCollection
    {
        //
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->classes[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->classes[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->classes[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->classes[$offset]);
    }
}