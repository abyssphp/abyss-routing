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

class RouteCompiler implements RouteCompilerInterface
{
    public const VARIABLE_MAXIMUM_LENGTH = 32;
    public const VARIABLE_REGEX = '/{([a-zA-Z_][a-zA-Z0-9_]{0,31})(?::([^}]+))?}/';
    public const DEFAULT_VARIABLE_REGEX = '[^/]+';

    /**
     * {@inheritDoc}
     */
    public static function compile(string $pattern): CompiledRoute {
        $variables = [];

        $regex = \preg_replace_callback(self::VARIABLE_REGEX, function ($matches) use (&$variables) {
            $variable = $matches[1];

            if (\preg_match('/^\d/', $variable) > 0) {
                throw new \DomainException(\sprintf(
                    "Variable name '%s' cannot start with a digit in route pattern.",
                    $variable,
                ));
            }

            if (\in_array($variable, $variables, true)) {
                throw new \LogicException(
                    \sprintf(
                        "Variable '%s' is already defined in route pattern.",
                        $variable
                    )
                );
            }

            if (\strlen($variable) > self::VARIABLE_MAXIMUM_LENGTH) {
                throw new \DomainException(
                    \sprintf(
                        "Variable name '%s' cannot be longer than %d characters in route pattern.",
                        $variable,
                        self::VARIABLE_MAXIMUM_LENGTH,
                    ),
                );
            }

            $variables[] = $variable;

            return \sprintf(
                '(?P<%s>%s)',
                $variable,
                $matches[2] ?? self::DEFAULT_VARIABLE_REGEX
            );
        }, $pattern);

        return new CompiledRoute(
            '#^' . $regex . '$#sD',
            $variables
        );
    }
}
