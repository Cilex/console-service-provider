Console Service Provider
========================

Provides [Console][symfony/console] as a service to [Pimple][pimple] applications.


Requirements
------------

 * PHP 5.3+
 * Symfony Console ~2.1



Installation
------------
 
Through [Composer][composer] as [cilex/console-service-provider][cilex/console-service-provider].


Usage
-----

### Pimple

```php
<?php

use Cilex\Pimple\Provider\Console\ConsoleServiceProvider;

$app = new Pimple;

$consoleServiceProvider = new ConsoleServiceProvider;
$consoleServiceProvider->register($app);

$app['console']->run();
```

### Silex

Until Pimple and Silex both support Pimple Service Providers, Silex requires
a proxy Silex Service Provider to use the Console Service Provider.

```php
<?php

use Cilex\Pimple\Provider\Console\Bridge\Silex\ConsoleServiceProvider;
use Silex\Application;

$app = new Application;

$app->register(new ConsoleServiceProvider(array(
    'console.name' => 'MyApp',
    'console.version' => '1.0.5',
)));

$app['console']->run();
```

### Cilex

Until Pimple and Cilex both support Pimple Service Providers, Cilex requires
a proxy Cilex Service Provider to use the Console Service Provider.

Cilex is a special case. The Console Service Provider is baked into the Cilex
Application itself so there is no need to register it manually.

```php
<?php
use Cilex\Application;

$app = new Application('MyApp', '1.0.5');

$app->run();
```


Configuration
-------------

### Parameters

 * **console.name**:
   Name for the console application.
 * **console.version**:
   Version for the console application.
 * **console.class**:
   Class for the console application to be created.

### Services

 * **console**:
   Console Application, instance `Symfony\Component\Console\Application`.


License
-------

MIT, see LICENSE.


[symfony/console]: http://symfony.com/doc/current/components/console/introduction.html
[pimple]: http://pimple.sensiolabs.org
[composer]: http://getcomposer.org
[cilex/console-service-provider]: https://packagist.org/packages/cilex/console-service-provider
