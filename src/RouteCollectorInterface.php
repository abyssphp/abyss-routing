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

/**
 * @extends \IteratorAggregate<string, \Abyss\Routing\RouteInterface>
 */
interface RouteCollectorInterface extends \IteratorAggregate, \Countable
{
    /**
     * Adds a new route to the collection.
     *
     * @param string[] $methods
     * @param string $uri
     * @param callable|string $callback
     *
     * @return \Abyss\Routing\RouteInterface
     */
    public function addRoute(array $methods, string $uri, callable|string $callback): RouteInterface;

    /**
     * Gets all the route from the collection.
     *
     * @return \Abyss\Routing\RouteInterface[]
     */
    public function getRoutes(): array;
}
