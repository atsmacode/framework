<?php

namespace Atsmacode\Framework\Models;

use Atsmacode\Framework\Database\ConnectionInterface;
use Atsmacode\Framework\Dbal\Model;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use ReflectionClass;

class ModelFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): Model
    {
        $connection = $container->get(ConnectionInterface::class);

        return new $requestedName($connection, new ReflectionClass($requestedName));
    }
}
