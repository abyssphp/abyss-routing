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

use Charon\Routing\Dispatcher\RouteDispatcher;

class Router implements RouterInterface
{
    public function __construct(
        protected RouteCollectorInterface $routes = new RouteCollector()
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $uri, callable|string $callback): RouteInterface {
        return $this->addRoute(['GET'], $uri, $callback);
    }

    /**
     * {@inheritDoc}
     */
    public function post(string $uri, callable|string $callback): RouteInterface {
        return $this->addRoute(['POST'], $uri, $callback);
    }

    /**
     * {@inheritDoc}
     */
    public function put(string $uri, callable|string $callback): RouteInterface {
        return $this->addRoute(['PUT'], $uri, $callback);
    }

    /**
     * {@inheritDoc}
     */
    public function patch(string $uri, callable|string $callback): RouteInterface {
        return $this->addRoute(['PUT'], $uri, $callback);
    }

    /**
     * {@inheritDoc}
     */
    public function delete(string $uri, callable|string $callback): RouteInterface {
        return $this->addRoute(['DELETE'], $uri, $callback);
    }

    /**
     * {@inheritDoc}
     */
    public function head(string $uri, callable|string $callback): RouteInterface {
        return $this->addRoute(['HEAD'], $uri, $callback);
    }

    /**
     * {@inheritDoc}
     */
    public function options(string $uri, callable|string $callback): RouteInterface {
        return $this->addRoute(['OPTIONS'], $uri, $callback);
    }

    /**
     * {@inheritDoc}
     */
    public function any(string $uri, callable|string $callback): RouteInterface {
        return $this->addRoute(['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'], $uri, $callback);
    }

    /**
     * {@inheritDoc}
     */
    public function addRoute(array $methods, string $uri, callable|string $callback): RouteInterface {
        return $this->routes->addRoute($methods, $uri, $callback);
    }

    /**
     * {@inheritDoc}
     */
    public function dispatch(string $uri, string $httpMethod): RouteInterface {
        return (
            new RouteDispatcher($this->routes)
        )->dispatch($uri, $httpMethod);
    }
}
