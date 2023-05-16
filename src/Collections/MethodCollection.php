<?php

namespace Palantir\Descriptor\Collections;

use ArrayIterator;
use FilterIterator;
use Palantir\Descriptor\Filters\Methods\MethodAnyOfFilter;
use Palantir\Descriptor\Filters\Methods\MethodIsPublicFilter;
use Palantir\Descriptor\Filters\Methods\MethodIsStaticFilter;
use Palantir\Descriptor\Filters\Methods\MethodNameFilter;
use Palantir\Descriptor\MethodDescriptor;

final class MethodCollection extends FilterIterator
{
    private ArrayIterator $methods;

    private array $filters = [];

    public function __construct(iterable $methods = [])
    {
        parent::__construct(new ArrayIterator);

        foreach ($methods as $method) {
            $this->add($method);
        }
    }

    public function add(MethodDescriptor $method): self
    {
        $this->getInnerIterator()[] = $method;

        return $this;
    }

    public function anyOf(MethodCollection ...$conditions): self
    {
        $filters = [];

        foreach ($conditions as $condition) {
            $filters = array_merge($filters, $condition->filters);
        }

        return $this->filter(
            new MethodAnyOfFilter($filters)
        );
    }

    public function filter(callable $filter): self
    {
        $result = new MethodCollection($this->getInnerIterator());

        $result->filters = $this->filters;
        $result->filters[] = $filter;

        return $result;
    }

    public function name(string $name): self
    {
        return $this->filter(
            new MethodNameFilter($name)
        );
    }

    public function public(): self
    {
        return $this->filter(new MethodIsPublicFilter);
    }

    public function static(): self
    {
        return $this->filter(new MethodIsStaticFilter);
    }

    public function count(): int
    {
        return iterator_count($this);
    }

    /**
     * @internal
     */
    public function accept(): bool
    {
        foreach ($this->filters as $filter) {
            if (! $filter(parent::current())) {
                return false;
            }
        }

        return true;
    }
}