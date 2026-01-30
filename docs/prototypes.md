# Prototypes

## What it is
A Prototype is a data helper or DB helper. This can be a simple function library or use the `JX_Prototype` class.

## Where it lives (folder)
`prototypes/`

## Minimal example
```php
function blog_get_categories()
{
    return blog_db()->query("SELECT * FROM blog_categories");
}
```

## How to run / test
Call the helper from a Service or Action:
```php
$categories = blog_get_categories();
```

Source: core/base/core-classes.php, prototypes/blog.php.
