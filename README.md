# Deployment Instructions

## Migrating
- Generate migrations for all tables

`php artisan migrate:generate`

- Or for one

`php artisan migrate:generate --tables="my_table"`


## Seeding
- Generate seeders

`php artisan iseed my_table`

- Run seeders

`php artisan db:seed`
