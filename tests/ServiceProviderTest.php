<?php

namespace OpenSoutheners\CarboneSdk\Tests;

use OpenSoutheners\CarboneSdk\Carbone;

class ServiceProviderTest extends TestCase
{
    public function testCarboneIsBoundWithCarboneInstance()
    {
        $this->assertTrue($this->app->bound(Carbone::class));
        $this->assertTrue($this->app->bound('carbone'));
    }
}
