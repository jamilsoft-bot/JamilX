# Actions

## What it is
An Action is a handler class (or function) that performs work and usually renders a Container.

## Where it lives (folder)
`actions/`

## Minimal example
```php
class apihome extends JX_Action implements JX_ActionI
{
    public function getAction()
    {
        include "containers/api/api.php";
    }
}
```

## How to run / test
1. Place the class in `actions/apihome.php`.
2. Call it from a Service or container:
   ```php
   $action = new apihome();
   $action->getAction();
   ```

Source: core/base/core-classes.php, actions/apihome.php.

---

## Action Styles in This Repo

- **Class-based** actions (most common): `class Something extends JX_Action`.
- **Function-based** actions: Some files define helper functions directly (example: blog handlers).

Source: actions/apihome.php, actions/blog.php.
