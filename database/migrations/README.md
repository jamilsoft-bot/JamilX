# Database Migrations

Create migration files in this directory with the following format:

```php
<?php
return [
    'up' => [
        "CREATE TABLE example (id INT AUTO_INCREMENT PRIMARY KEY)",
    ],
    'down' => [
        "DROP TABLE example",
    ],
];
```

Run migrations with:

```bash
php jamilx db:migrate
```
