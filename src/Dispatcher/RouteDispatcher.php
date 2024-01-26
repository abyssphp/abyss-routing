<?php

/*
 * This file is part of the charonlab/charon-routing.
 *
 * Copyright (C) 2023-2024 Charon Lab Development Team
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE.md file for details.
 */

namespace Charon\Routing\Dispatcher;

use Charon\Routing\Exception\MethodNotAllowedException;
use Charon\Routing\Exception\RouteNotFoundException;
use Charon\Routing\Matcher\MethodMatcher;
use Charon\Routing\Matcher\UriMatcher;
use Charon\Routing\RouteCollectorInterface;
use Charon\Routing\RouteInterface;

class RouteDispatcher implements RouteDispatcherInterface
{
    /**
     * An array of allowed HTTP methods for route.
     *
     * @var string[] $allow
     */
    private array $allow = [];

    public function __construct(
        private readonly RouteCollectorInterface $routes
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function dispatch(string $uri, string $httpMethod): RouteInterface {
        $uri = \rtrim($uri, '/') ?: '/';

        if ($httpMethod === 'HEAD') {
            $httpMethod = 'GET';
        }

        if (($route = $this->findMatchingRoute($uri, $httpMethod)) !== null) {
            \preg_match($route->compile()->getRegex(), $uri, $matches);

            foreach ($matches as $key => $match) {
                if (\is_numeric($key)) {
                    continue;
                }

                $route->setParameter($key, $match);
            }

            return $route;
        }

        $this->allow = \array_unique($this->allow);

        if (\count($this->allow) > 0) {
            $reason = \sprintf(
                'The %s method is not supported for route %s. Supported methods: %s.',
                $httpMethod,
                $uri,
                \implode(',', \array_map('strtoupper', $this->allow)),
            );

            throw new MethodNotAllowedException($reason);
        }

        throw new RouteNotFoundException(
            \sprintf(
                'The route %s could not be found.',
                $uri,
            ),
        );
    }


    /**
     * Tries to find a matching route with a set routes.
     *
     * @param string $uri
     * @param string $httpMethod
     *
     * @return \Charon\Routing\RouteInterface|null
     *
     * @throws \Exception
     */
    private function findMatchingRoute(string $uri, string $httpMethod): ?RouteInterface {
        foreach ($this->routes->getIterator() as $route) {
            if ($this->matchRoute($route, $uri, $httpMethod) === true) {
                return $route;
            }
        }

        return null;
    }

    /**
     * Determines whether the specified route matches the passed parameters
     *
     * @param \Charon\Routing\RouteInterface $route
     * @param string $uri
     * @param string $httpMethod
     *
     * @return bool
     */
    private function matchRoute(RouteInterface $route, string $uri, string $httpMethod): bool {
        $matchers = [
            new UriMatcher($uri),
            new MethodMatcher($httpMethod),
        ];

        foreach ($matchers as $matcher) {
            if ($matcher->match($route) === false) {
                if ($matcher instanceof MethodMatcher) {
                    $this->allow[] = $httpMethod;
                }

                return false;
            }
        }

        return true;
    }
}
