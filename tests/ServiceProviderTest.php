<?php

namespace OpenSoutheners\CarboneSdk\Tests;

use OpenSoutheners\CarboneSdk\Carbone;
use OpenSoutheners\CarboneSdk\ServiceProvider;
use Orchestra\Testbench\TestCase;

/**
 * @group integration
 * @group serviceProvider
 * @group needsLaravel
 */
class ServiceProviderTest extends TestCase
{
    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array<int, class-string>
     */
    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
        ];
    }

    public function testCarboneIsBoundWithCarboneInstance()
    {
        $this->assertTrue($this->app->bound(Carbone::class));
        $this->assertTrue($this->app->bound('carbone'));
        $this->assertInstanceOf(Carbone::class, $this->app->get('carbone'));
    }
}
