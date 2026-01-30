# Glossary

## What it is
Simple definitions for key JamilX terms.

## Where it lives (folder)
Core terminology is implemented across `services/`, `actions/`, `containers/`, `prototypes/`, and `core/`.

## Minimal example
```text
Service → services/
Action → actions/
Container → containers/
Prototype → prototypes/
```

## How to run / test
Use these terms to navigate the folder structure.

Source: core/base/core-classes.php, services/, actions/, containers/, prototypes/.

---

### Action
A handler class (or function) invoked by a Service.

Source: core/base/core-classes.php, actions/.

### Container
A view template rendered by a Service or Action.

Source: containers/.

### Prototype
A data/DB helper.

Source: core/base/core-classes.php, prototypes/.

### Service
Controller-like class that owns a route.

Source: core/base/core-classes.php, services/.

### Route
A URL path mapped to a Service.

Source: .htaccess, route/http.php.

### MODE
Environment setting in `.env` that chooses the bootstrap class.

Source: core/hooks/init.php, bootstrap/*.php.
