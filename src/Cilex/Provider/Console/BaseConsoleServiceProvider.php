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

/**
 * Pimple Console Service Provider
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class BaseConsoleServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register(\Pimple $container)
    {
        foreach ($this->getDefaults() as $key => $value) {
            if (!isset($container[$key])) {
                $container[$key] = $value;
            }
        }

        $container['console'] = $container->share(function() use ($container) {
            $args = array();
            if (isset($container['console.name'])) {
                $args[] = $container['console.name'];
                if (isset($container['console.version'])) {
                    $args[] = $container['console.version'];
                }
            }

            $class = new \ReflectionClass($container['console.class']);
            $instance = $class->newInstanceArgs($args);
            if ($class instanceof ContainerAwareApplication) {
                $class->setContainer($container);
            }

            return $instance;
        });
    }

    protected function getDefaults()
    {
        return array(
            'console.name' => 'Cilex Application',
            'console.class' => 'Cilex\Provider\Console\Application',
        );
    }
}
