Base
====

Usage is similar to jQuery:  chainable with get/set combo methods.

```php
$obj->prop(5); // set $obj->prop = 5;
$obj->prop(); // return $obj->prop; // which === 5;

$obj->a('a')->b('b')->some_method(); // setters always return $this, so you can chain any existing methods

// some 'magic' helper functionality:
$obj->prop();
    // 1.  Does $obj->get_prop() exist?  If so, return $obj->get_prop() value
    // 2.  If not, return $obj->prop;

// This is nice so you can implement getters and setters in the future, when they're needed.
```



Its best practice to define your properties with `protected $prop_name;`, and this still works

The internal methods check for the existence of `get_prop_name()` and `set_prop_name()` methods before getting/setting the property directly.  This is nice, so that you can add these methods later.  For example, `$obj->prop()` will check for the existence of `$obj->get_prop()`.  Initially you don't have a special getter/setter, and so you're just accessing the protected `$obj->prop` with `$obj->prop()`.  Then when you decide you need some special functionality, you can define the `get_prop()` method, and all of your existing code will automatically use this getter.  The same goes for setter methods.

It also works the other way.  `$obj->get_prop()` will return the value of `$obj->prop`, so you don't actually need to define the get method, yet.  I needed this for some reason that isn't occuring to me at the moment.

**The Alternative**

First, you'd have to define all your getters and setters:

```php
class YourClass {
    
    protected $prop;
    
    public function get_prop(){
        return $this->prop;
    }
    
    public function set_prop($value){
        $this->prop = $value;
        return $this; // optionally return $this for chainability
    }
}
```

Without chainability:

```php
$obj->set_title('My Post Title');
$obj->set_content('This is the <body> of my post');
$obj->save();
```

With chainability and auto get/set, you don't have to define your get/set functions, they just work, and you can define them later, and everything will still work.  And then you can chain:

```php
$obj->title('My Post Title')->content('This is the <body> of my post')->save();
```

Minor conveniences, but a time saver.
