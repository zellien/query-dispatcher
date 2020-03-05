<?php
/**
 * Created by Bogdan Tereshchenko <development.sites@gmail.com>
 * Copyright: 2006-2019 Bogdan Tereshchenko
 * Link: https://zelliengroup.com/
 * Date: 05.03.2020 16:50
 */

declare(strict_types=1);

namespace Zellien\QueryDispatcher;

use Zellien\QueryDispatcher\Exception\AlreadyExistsException;
use Zellien\QueryDispatcher\Exception\NotResolvedException;

/**
 * Class HandlerResolver
 * @package Zellien\QueryDispatcher
 */
final class HandlerResolver implements HandlerResolverInterface {

    /**
     * @var array
     */
    private $map = [];

    /**
     * HandlerResolver constructor.
     * @param array $map
     */
    public function __construct(array $map = []) {
        foreach ($map as $queryName => $handler) {
            $this->attach($queryName, $handler);
        }
    }

    /**
     * Resolves a handler for a query
     * @param QueryInterface $query
     * @return HandlerInterface
     */
    public function resolve(QueryInterface $query): HandlerInterface {
        $queryName = get_class($query);
        if (!$this->exists($queryName)) {
            throw new NotResolvedException(sprintf('Query handler for %s not resolved', $queryName));
        }
        return $this->map[$queryName];
    }

    /**
     * Checks if a handler is attached to a query
     * @param string $queryName
     * @return bool
     */
    public function exists(string $queryName): bool {
        return isset($this->map[$queryName]);
    }

    /**
     * Attach a handler to the query
     * @param string           $queryName
     * @param HandlerInterface $handler
     * @return $this
     */
    public function attach(string $queryName, HandlerInterface $handler): self {
        if ($this->exists($queryName)) {
            throw new AlreadyExistsException(sprintf('Query handler for %s is already attached', $queryName));
        }
        $this->map[$queryName] = $handler;
        return $this;
    }

}
