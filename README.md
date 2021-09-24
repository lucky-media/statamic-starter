# Statamic Starter

An opinionated Statamic Starter for usage in our projects at Lucky Media.

## Features

-   Preconfigured Pages Collection.
-   Preconfigured Bard Fieldtype with few default sets such as Image, Gallery, and Video.
-   Two components added to encourage composable Components such as a Button and Typography.
-   Global Theme settings such as Sitename, Social Media and Footer settings.
-   Responsive Image added based on the great partial from Statamic Peak.
-   Full blown Cookie Management with support for Google Analytics straight from CP.
-   SEO Management with the Seotamic Addon, dynamic OG Image ViewModel is included.
-   Favicons and Sitemap Generation
-   Tailwind CSS with some included plugins like:
    -   Tailwind Typography
    -   Tailwind Forms
    -   Debug Screens
    -   Bootstrap Grid is used for convenience
    -   Custom Flex Gap plugin is used for gap functionality for older browsers / Safari.
-   Alpine JS is used for small interactions

## Installation instructions

-   `composer install`
-   `php please make:user`
-   `npm install` && `npm run watch`

## NGINX config

Add the following to your NGINX config **inside the server block** enable static resource caching:

```
expires $expires;
```

And this **outside the server block**:

```
map $sent_http_content_type $expires {
    default    off;
    text/css    max;
    ~image/    max;
    application/javascript    max;
    application/octet-stream    max;
}
```

## Deploying on Forge

```bash
if [[ $FORGE_DEPLOY_MESSAGE =~ "[BOT]" ]]; then
    echo "Automatically committed on production. Nothing to deploy."
    exit 0
fi

cd $FORGE_SITE_PATH
git pull origin main
$FORGE_COMPOSER install --no-interaction --prefer-dist --optimize-autoloader

npm i
npm run production
$FORGE_PHP artisan cache:clear
$FORGE_PHP artisan route:cache
$FORGE_PHP artisan statamic:stache:warm
$FORGE_PHP artisan queue:restart
$FORGE_PHP artisan statamic:search:update --all
$FORGE_PHP artisan statamic:static:clear
$FORGE_PHP artisan statamic:static:warm
$FORGE_PHP artisan statamic:assets:generate-presets --queue

( flock -w 10 9 || exit 1
    echo 'Restarting FPM...'; sudo -S service $FORGE_PHP_FPM reload ) 9>/tmp/fpmlock
```

Credits to [Statamic Peak](https://github.com/studio1902/statamic-peak) for the README inspiration.
