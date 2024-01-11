<?php

/*
 * This file is part of the abyss/abyss-routing.
 *
 * Copyright (C) 2023-2024 Abyss Development Team
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE.md file for details.
 */

namespace Abyss\Routing;

class RouteCollector implements RouteCollectorInterface
{
    /**
     * @var \Abyss\Routing\RouteInterface[] $routes
     */
    protected array $routes;

    public function __construct() {
        $this->routes = [];
    }

    /**
     * {@inheritDoc}
     */
    public function addRoute(array $methods, string $uri, callable|string $callback): RouteInterface {
        $route = new Route(
            $methods,
            $uri,
            $callback,
        );

        $this->routes[] = $route;

        return $route;
    }

    /**
     * {@inheritDoc}
     */
    public function getRoutes(): array {
        return $this->routes;
    }


    /**
     * {@inheritDoc}
     */
    public function getIterator(): \ArrayIterator {
        return new \ArrayIterator($this->routes);
    }

    /**
     * {@inheritDoc}
     */
    public function count(): int {
        return \count($this->getRoutes());
    }
}
