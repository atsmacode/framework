<?php

namespace Atsmacode\Framework\Models;

use Atsmacode\Framework\Database\ConnectionInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class ModelFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $connection = $container->get(ConnectionInterface::class);

        return new $requestedName($connection);
    }
}
