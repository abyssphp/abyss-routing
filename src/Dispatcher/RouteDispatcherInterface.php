<?php

/*
 * This file is part of the abyss/abyss-routing.
 *
 * Copyright (C) 2023-2024 Abyss Development Team
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE.md file for details.
 */

namespace Abyss\Routing\Dispatcher;

use Abyss\Routing\RouteInterface;

interface RouteDispatcherInterface
{
    /**
     *
     *
     * @param string $uri
     * @param string $httpMethod
     *
     * @return \Abyss\Routing\RouteInterface
     *
     * @throws \Exception
     * @throws \Abyss\Routing\Exception\MethodNotAllowedException
     * @throws \Abyss\Routing\Exception\RouteNotFoundException
     */
    public function dispatch(string $uri, string $httpMethod): RouteInterface;
}
