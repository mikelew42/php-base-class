Base
====

Usage is similar to jQuery:  chainable with get/set combo methods.

```php
$obj->prop(5); // set $obj->prop = 5;
$obj->prop(); // return 5;

$obj->a('a')->b('b')->some_method(); // setters always return $this, so you can chain any existing methods
```
