<?php

/*
 * This file is part of the charonlab/charon-routing.
 *
 * Copyright (C) 2023-2024 Charon Lab Development Team
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE.md file for details.
 */

namespace Charon\Routing\Compiler;

interface RouteCompilerInterface
{
    /**
     * Parses given pattern.
     *
     * @param string $pattern
     * @return \Charon\Routing\Compiler\CompiledRoute
     */
    public static function compile(string $pattern): CompiledRoute;
}
