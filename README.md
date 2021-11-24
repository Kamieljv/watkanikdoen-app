# Wat Kan Ik Doen webapp

## Deployment Instructions

### 1. Set up the database

- Create a database and add the connection details to `.env`
- Run migrations with `php artisan migrate`
- Run seeders with `php artisan db:seed`

### 2. Run the server

- Run the server with `php artisan serve`

## Modifying BREAD
Configuration of the Voyager admin panel are saved in database tables. The defaults are seeded by files in `database/seeders`. Any changes need to be kept up to date in these seeders, to ensure easy deployment. 

Reference for which seeder file (all in `database/seeders`) contains what:

- `MenuItemsTableSeeder.php` -> Create new menu entries here
- `DataTypesTableSeeder.php` -> Register BREAD for new tables here
- `DataRowsTableSeeder.php` -> Configure the details for every field in said tables
- `PermissionsTableSeeder.php` -> Add the BREAD permissions to table

For new tables: 

- Create a new seeder file for the table (see below on how to generate this)
- Register the seeder file in `DatabaseSeeder.php`.

## Modifying settings
This can be done at `/admin/settings`. It reads and writes to the `settings` table in the database. So, in order to preserve the settings for future deployments, make sure to update its seed with `php artisan iseed settings`.

### Generate migrations and seeders
- Generate migrations for all tables

`php artisan migrate:generate`

- Or for one

`php artisan migrate:generate --tables="my_table"`

- Generate seeders

`php artisan iseed my_table`

## Updating Wave

Download a copy of the latest version (e.g. on GitHub). In the root folder you should see another folder named `wave`, you can simply replace this folder with the `wave` folder in your project. Carefull! Modifications in this folder might not be preserved.

You will then need to re-autoload your dependencies by running:

`composer dump-autoload`

You may also need to clear the cache by running:

`php artisan cache:clear`

And you should be updated to the latest version :)