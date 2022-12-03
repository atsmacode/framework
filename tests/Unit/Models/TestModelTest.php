<?php

namespace Atsmacode\Framework\Tests;

use Atsmacode\Framework\Tests\BaseTest;
use Atsmacode\Framework\Models\Test;

class TestModelTest extends BaseTest
{
    /** @test */
    public function itCanCreateAndFindRecord()
    {
        $test = Test::create(['name' => 'Testing...']);

        $this->assertEquals($test->id, Test::find(['id' => $test->id])->id);
    }
}
