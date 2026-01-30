# Services

## What it is
A Service is the controller-like class for a route (URL entry). The router instantiates it and calls `main()`.

## Where it lives (folder)
`services/`

## Minimal example
```php
class Billing extends JX_Serivce implements JX_service
{
    public function main()
    {
        include "containers/billing/index.php";
    }
}
```

## How to run / test
1. Place the file in `services/billing.php`.
2. Visit `/billing` in the browser.

Source: core/base/core-classes.php, console/stubs/service.stub, route/http.php.

---

## Common Pattern

Services often:
- read the `action` query param
- instantiate an Action class
- include a Container

Example (from Dashboard service):
```php
$action = is_null($Url->get('action')) ? 'home' : $Url->get('action');
include('containers/dashboard/dashboard.php');
```

Source: services/dashboard.php, core/classes/url-class.php.
