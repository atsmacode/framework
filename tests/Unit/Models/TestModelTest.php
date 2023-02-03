<?php

namespace Atsmacode\Framework\Tests;

use Atsmacode\Framework\Tests\BaseTest;
use Atsmacode\Framework\Models\Test;

class TestModelTest extends BaseTest
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->testModel = $this->container->get(Test::class);
    }
    
    /** @test */
    public function itCanCreateAndFindRecord()
    {
        $test = $this->testModel->create(['name' => 'Test Name', 'test_desc' => 'Test Description.']);

        $this->assertEquals($test->id, $this->testModel->find(['id' => $test->id])->id);
    }
}
