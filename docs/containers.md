# Containers

## What it is
A Container is a view template (HTML/PHP) that renders UI. Services and Actions include Containers.

## Where it lives (folder)
`containers/`

## Minimal example
```php
<div>
  <h1>Dashboard</h1>
</div>
```

## How to run / test
Include the Container from a Service or Action:
```php
include "containers/dashboard/index.php";
```

Source: console/stubs/container.stub, containers/.

---

## Common Pattern in Containers

Some Containers expect an Action object and call `getAction()` inside the template.

Source: containers/dashboard/dashboard.php.
