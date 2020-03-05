<?php
/**
 * Created by Bogdan Tereshchenko <development.sites@gmail.com>
 * Copyright: 2006-2019 Bogdan Tereshchenko
 * Link: https://zelliengroup.com/
 * Date: 05.03.2020 16:37
 */

declare(strict_types=1);

namespace Zellien\QueryDispatcher;

/**
 * Interface HandlerResolverInterface
 * @package Zellien\QueryDispatcher
 */
interface HandlerResolverInterface {

    /**
     * Returns a handler that is bound to a query
     * @param QueryInterface $query
     * @return HandlerInterface
     */
    public function resolve(QueryInterface $query): HandlerInterface;

}
