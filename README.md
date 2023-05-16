# Palantir Descriptor
Palantir is a fluent API built over top of Reflection Classes. Its aim is to provide a robust and easy-to-use method to drill down for certain conditions (parameters, etc.).

## Experimental API
This is just something I have messed with... who knows whether it's a good idea (for performance and/or DX reasons). Under the hood, a combination of new collection objects and `FilterIterator` are being used.

```php
// Retrieves all methods for the `ClassDescriptor` class.
$methods = ClassDescriptor::for(ClassDescriptor::class)->methods();

// Retrieves _only_ methods which are public and named "isFinal."
$namedFinal = $methods->public()->name('isFinal');

// Retrieves all methods which are static or named "isFinal" (this leaves the original `$methods` variable alone).
$staticOrNamedFinal = $methods
    ->anyOf(
        $methods
            ->static()
            ->name('isFinal')
    );

// Outputs "7"
echo $methods->count(), PHP_EOL;

// Outputs "1"
echo $methods->count(), PHP_EOL;

// Outputs "2"
echo $staticOrNamedFinal->count(), PHP_EOL;

// Results in 7 method names
foreach ($methods as $method) {
    echo $method->name(), PHP_EOL;
}

// Results in 1 method name
foreach ($namedFinal as $method) {
    echo $method->name(), PHP_EOL;
}

// Results in 2 method names
foreach ($staticOrNamedFinal as $method) {
    echo $method->name(), PHP_EOL;
}
```