<?php
/**
 * Created by Bogdan Tereshchenko <development.sites@gmail.com>
 * Copyright: 2006-2019 Bogdan Tereshchenko
 * Link: https://zelliengroup.com/
 * Date: 05.03.2020 16:47
 */

declare(strict_types=1);

namespace Zellien\QueryDispatcher;

/**
 * Interface QueryDispatcherInterface
 * @package Zellien\QueryDispatcher
 */
interface QueryDispatcherInterface {

    /**
     * Handles a query using a handler
     * @param QueryInterface $query
     * @return mixed
     */
    public function dispatch(QueryInterface $query);

}
