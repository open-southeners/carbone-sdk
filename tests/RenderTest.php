<?php

namespace OpenSoutheners\CarboneSdk\Tests;

use OpenSoutheners\CarboneSdk\Carbone;
use OpenSoutheners\CarboneSdk\RenderFormat;
use OpenSoutheners\CarboneSdk\Requests\Render;
use PHPUnit\Framework\TestCase;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

class RenderTest extends TestCase
{
    private Carbone $carbone;

    protected function setUp(): void
    {
        parent::setUp();

        $this->carbone = new Carbone('jwt_carbone_token');
    }

    public function testGenerateRender()
    {
        $mockClient = new MockClient([
            Render\GenerateDocumentUsingTemplate::class => MockResponse::make([
                'success' => true,
                'data' => [
                    'renderId' => 'ai9PAfUoDV1mfbjQsGzDtjCJMTNk2N7FDFb8fTwwgnYqFdfgvcWryniPQnkUTke4',
                ],
            ]),
        ]);

        $this->carbone->withMockClient($mockClient);

        $data = new \OpenSoutheners\CarboneSdk\Data\Render(
            data: [
                'foo' => 'bar',
                'hello' => 'world',
            ],
            convertTo: RenderFormat::Pdf
        );

        $response = $this->carbone->render()->generate(
            'qjaRALD5xIdNdwaXrbLZbuWuZfrGPPT1kdoh82mULevAv904gWNtba9kkAwU5Uef',
            $data
        );

        $mockClient->assertSent(Render\GenerateDocumentUsingTemplate::class);

        $this->assertTrue($response->ok());
        $this->assertEquals('ai9PAfUoDV1mfbjQsGzDtjCJMTNk2N7FDFb8fTwwgnYqFdfgvcWryniPQnkUTke4', $response->getRenderId());
    }

    public function testGenerateRenderConvertToAcceptsString()
    {
        $mockClient = new MockClient([
            Render\GenerateDocumentUsingTemplate::class => MockResponse::make([
                'success' => true,
                'data' => [
                    'renderId' => 'ai9PAfUoDV1mfbjQsGzDtjCJMTNk2N7FDFb8fTwwgnYqFdfgvcWryniPQnkUTke4',
                ],
            ]),
        ]);

        $this->carbone->withMockClient($mockClient);

        $data = new \OpenSoutheners\CarboneSdk\Data\Render(
            data: [
                'foo' => 'bar',
                'hello' => 'world',
            ],
            convertTo: 'pdf'
        );

        $response = $this->carbone->render()->generate(
            'qjaRALD5xIdNdwaXrbLZbuWuZfrGPPT1kdoh82mULevAv904gWNtba9kkAwU5Uef',
            $data
        );

        $mockClient->assertSent(Render\GenerateDocumentUsingTemplate::class);

        $this->assertTrue($response->ok());
        $this->assertEquals('ai9PAfUoDV1mfbjQsGzDtjCJMTNk2N7FDFb8fTwwgnYqFdfgvcWryniPQnkUTke4', $response->getRenderId());
    }

    public function testGenerateRenderGetRenderIdAsNullWhenFailure()
    {
        $mockClient = new MockClient([
            Render\GenerateDocumentUsingTemplate::class => MockResponse::make([
                'success' => false,
                'error' => 'Invalid templateId',
            ], 400),
        ]);

        $this->carbone->withMockClient($mockClient);

        $data = new \OpenSoutheners\CarboneSdk\Data\Render(
            data: [
                'foo' => 'bar',
                'hello' => 'world',
            ],
            convertTo: RenderFormat::Pdf
        );

        $response = $this->carbone->render()->generate('dunno', $data);

        $mockClient->assertSent(Render\GenerateDocumentUsingTemplate::class);

        $this->assertTrue($response->failed());
        $this->assertNull($response->getRenderId());
    }

    public function testRetrieveRender()
    {
        $content = file_get_contents(__DIR__.'/fixtures/my_template.xlsx');

        $mockClient = new MockClient([
            Render\RetrieveGeneratedDocument::class => MockResponse::make($content),
        ]);

        $this->carbone->withMockClient($mockClient);

        $renderId = 'ai9PAfUoDV1mfbjQsGzDtjCJMTNk2N7FDFb8fTwwgnYqFdfgvcWryniPQnkUTke4';

        $response = $this->carbone->render()->retrieve($renderId);

        $mockClient->assertSent(Render\RetrieveGeneratedDocument::class);

        $this->assertTrue($response->ok());
        $this->assertEquals($content, $response->body());
    }
}
