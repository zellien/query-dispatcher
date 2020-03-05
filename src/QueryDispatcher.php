<?php
/**
 * Created by Bogdan Tereshchenko <development.sites@gmail.com>
 * Copyright: 2006-2019 Bogdan Tereshchenko
 * Link: https://zelliengroup.com/
 * Date: 05.03.2020 17:22
 */

declare(strict_types=1);

namespace Zellien\QueryDispatcher;

/**
 * Class QueryDispatcher
 * @package Zellien\QueryDispatcher
 */
final class QueryDispatcher implements QueryDispatcherInterface {

    /**
     * @var HandlerResolverInterface
     */
    private $resolver;

    /**
     * QueryDispatcher constructor.
     * @param HandlerResolverInterface $resolver
     */
    public function __construct(HandlerResolverInterface $resolver) {
        $this->resolver = $resolver;
    }

    /**
     * @inheritDoc
     */
    public function dispatch(QueryInterface $query) {
        $handler = $this->resolver->resolve($query);
        return $handler->handle($query);
    }

}
