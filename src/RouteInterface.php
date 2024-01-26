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

use Charon\Routing\Compiler\CompiledRoute;

interface RouteInterface
{
    /**
     * Gets the HTTP verb assigned to the route.
     *
     * @return string[]
     */
    public function methods(): array;

    /**
     * Gets the URI assign with the route.
     *
     * @return string
     */
    public function uri(): string;

    /**
     * Gets the callback of the route.
     *
     * @return callable|string
     */
    public function callback(): callable|string;

    /**
     * Gets a route parameters.
     *
     * @return array<string, mixed>
     */
    public function getParameters(): array;

    /**
     * Gets a given parameter from the route.
     *
     * @param string $key
     * @return mixed
     */
    public function getParameter(string $key): mixed;

    /**
     * Adds a new route parameter.
     *
     * @param string $key
     * @param mixed $value
     *
     * @return self
     */
    public function setParameter(string $key, mixed $value): self;

    /**
     * Determines a given parameter exists from the route.
     *
     * @param string $key
     * @return bool
     */
    public function hasParameter(string $key): bool;

    /**
     * Gets a compiled uri pattern.
     *
     * @return CompiledRoute
     */
    public function compile(): CompiledRoute;
}
