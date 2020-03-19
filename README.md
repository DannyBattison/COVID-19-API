# COVID-19 API

Exposes a RESTful API of the [Johns Hopkins COVID-19 data](https://github.com/CSSEGISandData/COVID-19), retrieved via a git submodule.

### Bootstrap
Composer install, run migrations, and import data:

````bash
composer install
php bin/console doctrine:migrations:migrate
php bin/console app:import-data
````

### Self Hosting
Add a cron entry to run `cron.sh` once every 24 hours.  You'll need `git` installed on the server in order to pull the latest data.
