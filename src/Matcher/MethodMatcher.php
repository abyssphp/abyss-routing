<?php

/*
 * This file is part of the abyss/abyss-routing.
 *
 * Copyright (C) 2023-2024 Abyss Development Team
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE.md file for details.
 */

namespace Abyss\Routing\Matcher;

use Abyss\Routing\RouteInterface;

final readonly class MethodMatcher
{
    public function __construct(
        private string $httpMethod
    ) {
    }

    public function match(RouteInterface $route): bool {
        return \in_array($this->httpMethod, $route->methods());
    }
}
