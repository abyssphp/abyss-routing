<?php

/*
 * This file is part of the charonlab/charon-routing.
 *
 * Copyright (C) 2023-2024 Charon Lab Development Team
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE.md file for details.
 */

namespace Charon\Routing;

interface RouterInterface
{
    /**
     * Register a new GET route.
     *
     * @param string $uri
     * @param callable|string $callback
     *
     * @return \Charon\Routing\RouteInterface
     */
    public function get(string $uri, callable|string $callback): RouteInterface;

    /**
     * Register a new POST route.
     *
     * @param string $uri
     * @param callable|string $callback
     *
     * @return \Charon\Routing\RouteInterface
     */
    public function post(string $uri, callable|string $callback): RouteInterface;

    /**
     * Register a new PUT route.
     *
     * @param string $uri
     * @param callable|string $callback
     *
     * @return \Charon\Routing\RouteInterface
     */
    public function put(string $uri, callable|string $callback): RouteInterface;

    /**
     * Register a new PATCH route.
     *
     * @param string $uri
     * @param callable|string $callback
     *
     * @return \Charon\Routing\RouteInterface
     */
    public function patch(string $uri, callable|string $callback): RouteInterface;

    /**
     * Register a new DELETE route.
     *
     * @param string $uri
     * @param callable|string $callback
     *
     * @return \Charon\Routing\RouteInterface
     */
    public function delete(string $uri, callable|string $callback): RouteInterface;

    /**
     * Register a new HEAD route.
     *
     * @param string $uri
     * @param callable|string $callback
     *
     * @return \Charon\Routing\RouteInterface
     */
    public function head(string $uri, callable|string $callback): RouteInterface;

    /**
     * Register a new OPTIONS route.
     *
     * @param string $uri
     * @param callable|string $callback
     *
     * @return \Charon\Routing\RouteInterface
     */
    public function options(string $uri, callable|string $callback): RouteInterface;

    /**
     * Register a new ANY route.
     *
     * @param string $uri
     * @param callable|string $callback
     *
     * @return \Charon\Routing\RouteInterface
     */
    public function any(string $uri, callable|string $callback): RouteInterface;

    /**
     * Adds a new route to the collection.
     *
     * @param string[] $methods
     * @param string $uri
     * @param callable|string $callback
     *
     * @return \Charon\Routing\RouteInterface
     */
    public function addRoute(array $methods, string $uri, callable|string $callback): RouteInterface;

    /**
     * Finds a matching route for provided URI and HTTP Method.
     *
     * @param string $uri
     * @param string $httpMethod
     *
     * @return \Charon\Routing\RouteInterface
     */
    public function dispatch(string $uri, string $httpMethod): RouteInterface;
}
