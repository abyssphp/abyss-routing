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
use Charon\Routing\Compiler\RouteCompiler;

class Route implements RouteInterface
{
    /**
     * @var string[] $methods
     */
    protected array $methods;

    /**
     * @var string $uri
     */
    protected string $uri;

    /**
     * @var callable|string $callback
     */
    protected $callback;

    /**
     * @var array<string, mixed> $parameters;
     */
    protected array $parameters = [];
    /**
     * @var CompiledRoute|null $compiled
     */
    protected ?CompiledRoute $compiled = null;

    /**
     * @param string[] $methods
     * @param string $uri
     * @param callable|string $callback
     */
    public function __construct(array $methods, string $uri, callable|string $callback) {
        $this->setUri($uri);
        $this->setMethods($methods);
        $this->setCallback($callback);
    }

    /**
     * {@inheritDoc}
     */
    public function methods(): array {
        return $this->methods;
    }

    /**
     * Sets a route HTTP methods.
     *
     * @param string[] $methods
     * @return $this
     */
    public function setMethods(array $methods): self {
        $this->methods = [];

        foreach ($methods as $method) {
            $this->methods[] = \strtoupper($method);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function uri(): string {
        return $this->uri;
    }

    /**
     * Sets a route uri.
     *
     * @param string $uri
     * @return $this
     */
    public function setUri(string $uri): self {
        $this->uri = '/' . \ltrim(\trim($uri), '/');
        $this->compiled = null;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function callback(): callable|string {
        return $this->callback;
    }

    /**
     * Sets a route callback.
     *
     * @param callable|string $callback
     * @return $this
     */
    public function setCallback(callable|string $callback): self {
        $this->callback = $callback;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getParameters(): array {
        return $this->parameters;
    }

    /**
     * {@inheritDoc}
     */
    public function getParameter(string $key): mixed {
        return $this->parameters[$key];
    }

    /**
     * {@inheritDoc}
     */
    public function setParameter(string $key, mixed $value): RouteInterface {
        $this->parameters[$key] = $value;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function hasParameter(string $key): bool {
        return \array_key_exists($key, $this->parameters);
    }

    /**
     * {@inheritDoc}
     */
    public function compile(): CompiledRoute {
        if ($this->compiled === null) {
            $this->compiled = RouteCompiler::compile($this->uri());
        }

        return $this->compiled;
    }
}
