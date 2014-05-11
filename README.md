Console Service Provider
========================

Provides [Console][symfony/console] as a service to [Pimple][pimple] applications.


Requirements
------------

 * PHP 5.3+
 * Pimple ~2.1
 * Symfony Console ~2.4

Installation
------------
 
Through [Composer][composer] as [cilex/console-service-provider][cilex/console-service-provider].

Usage
-----

### Pimple

```php
<?php
use Cilex\Provider\Console\ConsoleServiceProvider;

$app = new Pimple\Container;

$app['console.name'] = 'MyApp';
$app['console.version'] = '1.0.5';

$consoleServiceProvider = new ConsoleServiceProvider;
$consoleServiceProvider->register($app);

$app['console']->run();
```

### Silex

```php
<?php
use Acme\Console\Command;
use Cilex\Provider\Console\ConsoleServiceProvider;
use Silex\Application;

$app = new Application;

$app->register(new ConsoleServiceProvider(), array(
    'console.name' => 'MyApp',
    'console.version' => '1.0.5',
));

$app['console']->add(new Command\XyzInfoCommand());
$app['console']->add(new Command\XyzSnapshotCommand());

$app['console']->run();
```

### Cilex

The Console Service Provider is baked into the Cilex Application itself so
there is no need to register it manually.

```php
<?php
use Cilex\Application;

$app = new Application('MyApp', '1.0.5');

$app->command(new Command\XyzInfoCommand());

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


The Console Service Provider Application Class
----------------------------------------------

By default Console Service Provider will instantiate an instance of
`\Cilex\Provider\Console\ContainerAwareApplication`.

### Methods

#### getContainer() : \Pimple\Container

Returns the Pimple container.

#### getService($name) : mixed|null

Returns a service contained in the application container or null if none
is found with that name. Convenience method to avoid repeated calls to
`getContainer()` or having to assign the container.

Accessing the Container and Services from Commands
--------------------------------------------------

Here are some examples of accessing the Container and Services from a Command:

```php
<?php

use Symfony\Component\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SomeCommand extends Command
{
    protected function configure()
    {
        // configure the command
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Direct access to the Container.
        $container = $this->getApplication()->getContainer();

        // Direct access to a service.
        $service = $this->getApplication->getService('some.service');
    }
}
```

License
-------

MIT, see LICENSE.

[symfony/console]: http://symfony.com/doc/current/components/console/introduction.html
[pimple]: http://pimple.sensiolabs.org
[composer]: http://getcomposer.org
[cilex/console-service-provider]: https://packagist.org/packages/cilex/console-service-provider
