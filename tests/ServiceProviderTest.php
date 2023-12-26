<?php

namespace OpenSoutheners\CarboneSdk\Tests;

use OpenSoutheners\CarboneSdk\Carbone;

/**
 * @group integration
 * @group serviceProvider
 * @group needsLaravel
 */
class ServiceProviderTest extends TestCase
{
    public function testCarboneIsBoundWithCarboneInstance()
    {
        $this->assertTrue($this->app->bound(Carbone::class));
        $this->assertTrue($this->app->bound('carbone'));
        $this->assertInstanceOf(Carbone::class, $this->app->get('carbone'));
    }
}
