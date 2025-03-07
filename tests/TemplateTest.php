<?php

namespace OpenSoutheners\CarboneSdk\Tests;

use OpenSoutheners\CarboneSdk\Carbone;
use OpenSoutheners\CarboneSdk\Requests\Template;
use PHPUnit\Framework\TestCase;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

/**
 * @group unit
 */
class TemplateTest extends TestCase
{
    private Carbone $carbone;

    protected function setUp(): void
    {
        parent::setUp();

        $this->carbone = new Carbone('jwt_carbone_token');
    }

    public function testUploadTemplate()
    {
        $mockClient = new MockClient([
            Template\UploadTemplate::class => MockResponse::make(['status' => 200, 'data' => [
                'templateId' => 'qjaRALD5xIdNdwaXrbLZbuWuZfrGPPT1kdoh82mULevAv904gWNtba9kkAwU5Uef',
            ]]),
        ]);

        $this->carbone->withMockClient($mockClient);

        $templateContent = '';

        $response = $this->carbone->template()->upload($templateContent);

        $mockClient->assertSent(Template\UploadTemplate::class);

        $this->assertTrue($response->ok());
        $this->assertEquals('qjaRALD5xIdNdwaXrbLZbuWuZfrGPPT1kdoh82mULevAv904gWNtba9kkAwU5Uef', $response->getTemplateId());
    }

    public function testUploadTemplateThatFails()
    {
        $mockClient = new MockClient([
            Template\UploadTemplate::class => MockResponse::make([
                'success' => false,
                'error' => 'Cannot store template',
            ], 400),
        ]);

        $this->carbone->withMockClient($mockClient);

        $templateContent = '';

        $response = $this->carbone->template()->upload($templateContent);

        $mockClient->assertSent(Template\UploadTemplate::class);

        $this->assertTrue($response->failed());
        $this->assertNull($response->getTemplateId());
    }

    public function testBase64UploadTemplate()
    {
        $mockClient = new MockClient([
            Template\UploadTemplateAsBase64::class => MockResponse::make(['status' => 200, 'data' => [
                'templateId' => 'qjaRALD5xIdNdwaXrbLZbuWuZfrGPPT1kdoh82mULevAv904gWNtba9kkAwU5Uef',
            ]]),
        ]);

        $this->carbone->withMockClient($mockClient);

        $templateContent = '';

        $response = $this->carbone->template()->base64Upload($templateContent);

        $mockClient->assertSent(Template\UploadTemplateAsBase64::class);

        $this->assertTrue($response->ok());
        $this->assertEquals('qjaRALD5xIdNdwaXrbLZbuWuZfrGPPT1kdoh82mULevAv904gWNtba9kkAwU5Uef', $response->getTemplateId());
    }

    public function testDeleteTemplate()
    {
        $mockClient = new MockClient([
            Template\DeleteTemplateFromTemplateId::class => MockResponse::make([
                'status' => 200,
                'success' => true,
            ]),
        ]);

        $this->carbone->withMockClient($mockClient);

        $templateId = 'qjaRALD5xIdNdwaXrbLZbuWuZfrGPPT1kdoh82mULevAv904gWNtba9kkAwU5Uef';

        $response = $this->carbone->template()->delete($templateId);

        $mockClient->assertSent(Template\DeleteTemplateFromTemplateId::class);

        $this->assertTrue($response->ok());
        $this->assertEquals(true, $response->json('success'));
    }

    public function testDownloadTemplate()
    {
        $content = file_get_contents(__DIR__.'/fixtures/my_template.xlsx');

        $mockClient = new MockClient([
            Template\DownloadTemplateFromTemplateId::class => MockResponse::make($content, 200, [
                'content-type' => 'application/vnd.ms-excel',
                'content-disposition' => 'filename="qjaRALD5xIdNdwaXrbLZbuWuZfrGPPT1kdoh82mULevAv904gWNtba9kkAwU5Uef.xlsx"',
            ]),
        ]);

        $this->carbone->withMockClient($mockClient);

        $templateId = 'qjaRALD5xIdNdwaXrbLZbuWuZfrGPPT1kdoh82mULevAv904gWNtba9kkAwU5Uef';

        $response = $this->carbone->template()->download($templateId);

        $mockClient->assertSent(Template\DownloadTemplateFromTemplateId::class);

        $this->assertTrue($response->ok());
        $this->assertEquals($content, $response->body());
        $this->assertEquals(
            'qjaRALD5xIdNdwaXrbLZbuWuZfrGPPT1kdoh82mULevAv904gWNtba9kkAwU5Uef.xlsx',
            $response->getFileName()
        );
        $this->assertEquals('xlsx', $response->getFileExtension());
        $this->assertEquals('application/vnd.ms-excel', $response->getFileMimeType());
    }
}
