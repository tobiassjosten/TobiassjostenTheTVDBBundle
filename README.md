# TobiassjostenTheTVDBBundle

This bundle wraps [the TheTVDB API client](https://github.com/tobiassjosten/php-thetvdb-api) in [a Symfony2 service](http://symfony.com/doc/current/book/service_container.html), making it easy to with integrate the excellent [TheTVDB.com](http://thetvdb.com/) database in your Symfony application.

TheTVDB.com is an open database with a lot of TV related data and graphics, added by its members. Like a niche Wikipedia with an API! You need to [register for an API key](http://thetvdb.com/?tab=apiregister) before you can use the service.

TobiassjostenTheTVDBBundle was initially developed for use in [Smartburk.se](http://www.smartburk.se/).

[![Build Status](https://secure.travis-ci.org/tobiassjosten/TobiassjostenTheTVDBBundle.png?branch=master)](http://travis-ci.org/tobiassjosten/TobiassjostenTheTVDBBundle)

## Usage

### 1. Download the bundle [using Composer](http://getcomposer.org/)

Add TobiassjostenTheTVDBBundle in your `composer.json`:

    {
        "require": {
            "tobiassjosten/thetvdb-bundle": "*"
        }
    }

Now tell Composer to download the bundle by running the command:

    $ php composer.phar update tobiassjosten/thetvdb-bundle

Composer will install the bundle to your project's `vendor/tobiassjosten` directory.

### 2. Enable the bundle

Enable the bundle in the kernel (`app/AppKernel.php`):

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Tobiassjosten\TheTVDBBundle\TobiassjostenTheTVDBBundle(),
        );
    }

### 3. Configure the API client

Add your API key to your application's parameters (`app/config/parameters.yml`):

    parameters:
        # ...
        thetvdb_api_key: ABCDEF123456

### 4. Fetch the service

Use the dependency injection container to retrieve the service:

    $api = $container->get('thetvdb');

See [the library](https://github.com/tobiassjosten/php-thetvdb-api) for how to use the actual API.

## License

This bundle is under the MIT license. See the complete license in the bundle:

    Resources/meta/LICENSE
