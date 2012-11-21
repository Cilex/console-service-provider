<?php

/*
 * This file is part of the Cilex framework.
 *
 * (c) Mike van Riel <mike.vanriel@naenius.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cilex\Pimple\Provider\Console;

use Symfony\Component\Console\Application as BaseApplication;

/**
 * Cilex Pimple Console Application
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class Application extends BaseApplication
{
    /**
     * Constructor
     *
     * @param \Pimple $container Pimple container
     * @param string  $name      The name of the application
     * @param string  $version   The version of the application
     */
    public function __construct(\Pimple $container, $name = 'UNKNOWN', $version = 'UNKNOWN')
    {
        parent::__construct($name, $version);
        $this->container = $container;
    }

    /**
     * Get the Container
     *
     * @return \Pimple
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Returns a service contained in the application container or null if none
     * is found with that name.
     *
     * This is a convenience method used to retrieve an element from the
     * Application container without having to assign the results of the
     * getContainer() method in every call.
     *
     * @param string $name Name of the service
     *
     * @see self::getContainer()
     *
     * @api
     *
     * @return \stdClass|null
     */
    public function getService($name)
    {
        return isset($this->container[$name]) ? $this->container[$name] : null;
    }
}
