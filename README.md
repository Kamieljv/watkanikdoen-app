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

## Web Traffic Analytics
For traffic analytics, we use [Umami](https://umami.is/), which is an open-source and self-hosted framework that enables simple analytics (pageviews, devices used and referrers).
The analytics server is hosted on [http://analytics.watkanikdoen.nl/](http://analytics.watkanikdoen.nl/).

### See also
- [https://overflow.no/blog/2020/9/26/setting-umami-analytics-linux-using-docker/](https://overflow.no/blog/2020/9/26/setting-umami-analytics-linux-using-docker/)
- [https://github.com/mikecao/umami](https://github.com/mikecao/umami)

## Search Engine Optimization (SEO)
SEO tags are generated by [artesoas/seotools](https://github.com/artesaos/seotools). Config can be found in `config/seotools.php`. It is good practice to keep the `sitemap.xml` up to date. Update it with: 
```
\Spatie\Sitemap\SitemapGenerator::create('<domain>')->writeToFile('public/sitemap.xml');
```

## Cookie notice
Cookie notice is created with [this package](https://github.com/manucaralmo/GlowCookies/) and only enables the umami site analytics once accepted.

### Useful links
- Compiling multiple JS environments (public site/admin) with Laravel Mix: https://github.com/omnichronous/multimix
- Localization in Laravel routes https://github.com/mcamara/laravel-localization

### Package notes
- For Date localizations: [jenssegers/date](https://github.com/jenssegers/date)
- For icons: [Blade Icons](https://github.com/blade-ui-kit/blade-icons) with the Ant Design package
- For Search: [Algolia](https://algolia.com) (Potential free credits for NGOs via [this form](https://www.algolia.com/for-open-source/)).
- For Dutch Cities: [PDOK API](https://api.pdok.nl/bzk/locatieserver/search/v3_1/ui/)

## Embedding
You can embed a part of the Watkanikdoen.nl website into your own webpage, using our 'widget'.
The following exaxmple shows an example of an embedding.

```html
<html>
    <iframe width="100%" height="500" src="https://watkanikdoen.nl/widget?limit=100&show_past=false" style="border: none" sandbox="allow-scripts allow-same-origin allow-popups" allowfullscreen >
    </iframe>
</html>
```

You can use the following parameters (all optional) to filter the results of the acties api:

- **q**: The query string to search in title and description
- **keywords**: A comma-separated list of keywords to filter
- **themes**: an array of themes to filter by, e.g. `...&themes[]=16&themes[]=28&...`
- **categories**: an array of categories to filter by, same syntax as **themes**
- **organizer**: the organizer id
- **coordinates**: comma-separated latitude and longitude required for distance filter, e.g. `...&coordinates=52.04603756,5.68489658&...`
- **distance**: the maximum distance (in km) from **coordinates** an action have
- **show_past**: boolean, whether to show past actions
- **limit**: maximum number of actions to return
