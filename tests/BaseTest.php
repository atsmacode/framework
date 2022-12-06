<?php

namespace Atsmacode\FRamework\Tests;

use Atsmacode\Framework\Database\DbalTestFactory;
use Atsmacode\Framework\DatabaseProvider;
use Atsmacode\Framework\FrameworkConfigProvider;
use Laminas\ServiceManager\ServiceManager;
use PHPUnit\Framework\TestCase;

abstract class BaseTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $GLOBALS['THE_ROOT'] = '';
        $GLOBALS['dev']      = true;
        $config              = (new FrameworkConfigProvider)->get();
        $env                 = 'test';

        $GLOBALS['connection'] = DatabaseProvider::getConnection($config, $env);

        $pokerGameDependencyMap  = require('config/dependencies.php');

        $this->container = new ServiceManager($pokerGameDependencyMap);

        $this->container->setFactory(ConnectionInterface::class, new DbalTestFactory());
    }
}
