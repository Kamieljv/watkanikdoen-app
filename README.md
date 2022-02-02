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

## Site Analytics
For site analytics, we use [Umami](https://umami.is/), which is an open-source and self-hosted framework that enables simple analytics (pageviews, devices used and referrers).
The analytics server is hosted on [http://watkanikdoen-analytics.herokuapp.com/](http://watkanikdoen-analytics.herokuapp.com/).

## To Do (prioritized)
- [ ] Images: find a way to delete unused images
- [x] Allow users to view aanmeldingen
- [ ] Refactor aanmelding -> report
- [ ] Add filler for when search fields have no results (Organizers.vue and ActieAgenda.vue)
- [ ] Fill dashboard with useful widgets
- [ ] Styling/content of existing emails
- [ ] Static pages (About, Privacy policy, etc.)
- [ ] Add user notifications/emails (e.g. when action approved, when account verified etc.)
- [ ] Page analytics (e.g. Open Web Analytics, Umami or Plausible)
- [ ] Organize translation (front end)
- [x] Set proper (and working) toast messages throughout app
- [ ] Configure user roles (admin, moderator, user) and permissions in admin backend
- [ ] Credits to Studio Mes (Designadvies door: '')
- [x] List of Organizations
- [ ] Get the Blog working
- [ ] Add date filter to action page
- [ ] Make acties sortable
- [ ] Cookiemelding
- [x] Localize Voyager
- [x] Localize js messages

### Useful links
- Compiling multiple JS environments (public site/admin) with Laravel Mix: https://github.com/omnichronous/multimix
- Localization in Laravel routes https://github.com/mcamara/laravel-localization

### Package notes
- For Date localizations: [jenssegers/date](https://github.com/jenssegers/date)
- For icons: [Blade Icons](https://github.com/blade-ui-kit/blade-icons) with the Ant Design package
- For Search: [Algolia](https://algolia.com) (Potential free credits for NGOs via [this form](https://www.algolia.com/for-open-source/)).
- For Dutch Cities: [PDOK API](https://www.pdok.nl/restful-api/-/article/pdok-locatieserver-1#/paths/~1lookup/get)

