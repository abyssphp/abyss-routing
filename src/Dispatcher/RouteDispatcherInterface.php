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

use Charon\Routing\RouteInterface;

interface RouteDispatcherInterface
{
    /**
     *
     *
     * @param string $uri
     * @param string $httpMethod
     *
     * @return \Charon\Routing\RouteInterface
     *
     * @throws \Exception
     * @throws \Charon\Routing\Exception\MethodNotAllowedException
     * @throws \Charon\Routing\Exception\RouteNotFoundException
     */
    public function dispatch(string $uri, string $httpMethod): RouteInterface;
}
