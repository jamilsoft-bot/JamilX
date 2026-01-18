# Database Seeders

Seeder files should return a callable or an array of SQL statements.

Callable example:

```php
<?php
return function (mysqli $db, JX_ConsoleOutput $output) {
    $db->query("INSERT INTO users (name) VALUES ('Demo')");
};
```

Array example:

```php
<?php
return [
    "INSERT INTO users (name) VALUES ('Demo')",
];
```

Run seeders with:

```bash
php jamilx db:seed
```
