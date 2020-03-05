<?php
/**
 * Created by Bogdan Tereshchenko <development.sites@gmail.com>
 * Copyright: 2006-2019 Bogdan Tereshchenko
 * Link: https://zelliengroup.com/
 * Date: 05.03.2020 17:44
 */

declare(strict_types=1);

namespace Zellien\QueryDispatcher;

use Psr\Container\ContainerInterface;

/**
 * Class QueryDispatcherFactory
 * @package Zellien\QueryDispatcher
 */
final class QueryDispatcherFactory {

    /**
     * @param ContainerInterface $container
     * @return QueryDispatcherInterface
     */
    public function __invoke(ContainerInterface $container): QueryDispatcherInterface {
        $config = $container->get('config');
        $factories = $config['query_dispatcher']['factories'] ?? [];
        $resolver = new HandlerResolver();
        foreach ($factories as $queryName => $factory) {
            // If invokable factory
            if ($factory instanceof HandlerFactoryInterface) {
                $factory = new $factory();
            }
            // Attach handler
            if (is_callable($factory)) {
                $handler = call_user_func($factory, $container);
                $resolver->attach($queryName, $handler);
            }
        }
        return new QueryDispatcher($resolver);
    }

}
