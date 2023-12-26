<?php

namespace OpenSoutheners\CarboneSdk\Tests;

use OpenSoutheners\CarboneSdk\Carbone;
use OpenSoutheners\CarboneSdk\Requests\Status;
use PHPUnit\Framework\TestCase;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

/**
 * @group unit
 */
class StatusTest extends TestCase
{
    private Carbone $carbone;

    protected function setUp(): void
    {
        parent::setUp();

        $this->carbone = new Carbone('jwt_carbone_token');
    }

    public function testFetchStatus()
    {
        $mockClient = new MockClient([
            Status\FetchTheApiStatusAndVersion::class => MockResponse::make([
                'success' => true,
                'code' => 200,
                'message' => 'OK',
                'version' => '4.6.7',
            ]),
        ]);

        $this->carbone->withMockClient($mockClient);

        $response = $this->carbone->status()->fetch();

        $mockClient->assertSent(Status\FetchTheApiStatusAndVersion::class);

        $this->assertTrue($response->ok());
        $this->assertEquals('OK', $response->json('message'));
        $this->assertEquals('4.6.7', $response->json('version'));
    }
}
