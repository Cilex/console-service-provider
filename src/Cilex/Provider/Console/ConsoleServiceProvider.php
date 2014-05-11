<?php

/*
 * This file is part of the Cilex framework.
 *
 * (c) Mike van Riel <mike.vanriel@naenius.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cilex\Provider\Console;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Cilex Console Service Provider
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class ConsoleServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $container)
    {
        foreach ($this->getDefaults() as $key => $value) {
            if (!isset($container[$key])) {
                $container[$key] = $value;
            }
        }

        $container['console'] = function() use ($container) {
            $class    = $container['console.class'];
            $instance = new $class(
                isset($container['console.name']) ? $container['console.name'] : '',
                isset($container['console.version']) ? $container['console.version'] : null
            );

            if ($instance instanceof ContainerAwareApplication) {
                $instance->setContainer($container);
            }

            return $instance;
        };
    }

    protected function getDefaults()
    {
        return array(
            'console.name'    => 'Cilex Application',
            'console.class'   => 'Cilex\Provider\Console\ContainerAwareApplication',
            'console.version' => null,
        );
    }
}
