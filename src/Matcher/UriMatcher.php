<?php

/*
 * This file is part of the charonlab/charon-routing.
 *
 * Copyright (C) 2023-2024 Charon Lab Development Team
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE.md file for details.
 */

namespace Charon\Routing\Matcher;

use Charon\Routing\RouteInterface;

final readonly class UriMatcher
{
    public function __construct(
        private string $uri
    ) {
    }

    public function match(RouteInterface $route): bool {
        return (bool) \preg_match($route->compile()->getRegex(), $this->uri);
    }
}
