<?php

/*
 * This file is part of the abyss/abyss-routing.
 *
 * Copyright (C) 2023-2024 Abyss Development Team
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE.md file for details.
 */

namespace Abyss\Routing\Compiler;

interface RouteCompilerInterface
{
    /**
     * Parses given pattern.
     *
     * @param string $pattern
     * @return \Abyss\Routing\Compiler\CompiledRoute
     */
    public static function compile(string $pattern): CompiledRoute;
}
