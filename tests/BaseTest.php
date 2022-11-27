<?php

namespace Atsmacode\Orm\Tests;

use PHPUnit\Framework\TestCase;

abstract class BaseTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $GLOBALS['THE_ROOT'] = '';
        $GLOBALS['dev'] = true;
    }
}
